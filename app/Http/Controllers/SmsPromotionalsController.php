<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\Designation;
use App\Models\OfficeLocation;
use App\Models\SmsPromotional;
use App\Models\User;
use App\Models\Employee;
use App\Traits\SmsTrait;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Participation;

class SmsPromotionalsController extends Controller
{
    use SmsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param = 'sales_team') {
        $SmsPromotionals = SmsPromotional :: pluck('user_id','subject','message');
        return view('sms_promotionals.index',compact('param'), compact('SmsPromotionals') );
        //dd($SmsPromotionals);
    }
    
    private function convertBanglatoUnicode($BanglaText) { 
        $unicodeBanglaTextForSms = strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $BanglaText))); 
        return $unicodeBanglaTextForSms; 
    }
    
    private function depotUsersByDesignation($employeeArr=[],$designationArr=[]){
        $users = Employee::whereIn('employees.id',$employeeArr)
        ->whereIn('employees.designation_id',$designationArr)
        ->whereNotNull('employees.mobile')
        ->groupBy('employees.mobile')
        ->pluck('employees.mobile');
        return $users;
        //dd ($users);
       
    }
    private function shopsOrDistributorsByDepot($depotArr=[],$type,$condArr=[]){
        $shopObj = Shop::whereIn('depot_id',$depotArr)
                        ->whereNotNull('mobile')
                        ->groupBy('mobile');
                       //for distirbutor
                      if($type == 'distributor'){
                          $shopObj->where('status','active')
                          ->where('is_distributor',1);
                      }
                      //for shop
                      if($type == 'shop'){
                          if(count($condArr) > 1){
                              //only active shop
                              $shopObj->where('status','active')
                              ->whereNotNull('distributor_id');
                          }else{
                              if($condArr[0] == 1){
                                  //only currently injected shop
                                  $shopObj->join('settlements','settlements.shop_id','=','shops.id')
                                  ->whereIn('settlements.status',['continue','reserve']);
                              }else{
                                  //only active shop
                                  $shopObj->where('status','active')
                                  ->whereNotNull('distributor_id');
                              }
                          }
                          
                      }
          return $shopObj->pluck('mobile');
    }
     
    private function sendSmsToSalesTeam($request,$param,$from){
        $request->validate([
            'subject' => 'required',
            'employees' => 'required',
            'receiver_group' => 'required',
            'message' => 'required|max:320',
        ]);
        $data = $request->except('_token');
        
        $data['employees'] = json_encode($data['employees']);
        $data['receiver_group'] = json_encode($data['receiver_group']);
        return $this->saveData($data,$param);
         
    }
    private function sendSmsToDistributors($request,$param,$from){
        $request->validate([
            'subject' => 'required',
            'employees' => 'required',
            'message' => 'required|max:320',
        ]);
        $data = $request->except('_token');
        $data['employees'] = json_encode($data['employees']);
        return $this->saveData($data,$param);
    }
    private function sendSmsToOutlets($request,$param,$from){
        $request->validate([
            'subject' => 'required',
            'employees' => 'required',
            'receiver_group' => 'required',
            'message' => 'required|max:320',
        ]);
        $data = $request->except('_token');
          
        $data['employees'] = json_encode($data['employees']);
        $data['receiver_group'] = json_encode($data['receiver_group']);
        return $this->saveData($data,$param,$from);
      
    }
    
    private function saveData($data,$param,$from="send"){
        //$data['user_id'] = auth()->id();
        //$data['type'] = $param;
        $query = SmsPromotional::create($data);
        dd($query);
        if($query){
            $receiverObj = collect([]);
            $depotArr = json_decode($query->employees,true);
            if($param == 'distributors'){
                $receiverObj = $this->shopsOrDistributorsByDepot($depotArr,'distributor');
            }elseif ($param == 'outlets'){
                $receiverObj = $this->shopsOrDistributorsByDepot($depotArr,'shop',json_decode($query->receiver_group,true));
            }elseif($param == 'sales_team'){
                $receiverObj = $this->depotUsersByDesignation($employeeArr,json_decode($query->receiver_group,true));
            }
            if($receiverObj->count()){
                $successCounter = 0;
                $chunkedSmsObj = $receiverObj->chunk(5000);
                $chunkedSmsObjLength = $chunkedSmsObj->count();
                foreach($chunkedSmsObj as $smsObj){
                    $smsObj = (object)['receivers'=>$smsObj];
                    $smsObj->message = $query->message;
                    $messageResponse = $this->sendSms($smsObj);
                    if(is_array($messageResponse)){
                        $successCounter++;
                    }
                }
               
                if($chunkedSmsObjLength == $successCounter){
                    $message = "Message send successfully";
                    $route = 'smsPromotionals.index';
                    $messageTyp = 'flash_success';
                }else{
                    if($successCounter > 0){
                        $message = "Some message could not be send";
                        $route = 'smsPromotionals.index';
                        $messageTyp = 'flash_danger';
                    }else{
                        $message = "Message could not be send";
                        $route = 'smsPromotionals.index';
                        $messageTyp = 'flash_danger';
                    }
                    
                }
            }else{
                $message = "You have no available receiver";
                $route = 'smsPromotionals.index';
                $messageTyp = 'flash_danger';
            }
            
        }else{
            $message = "Something wrong!! Please try again";
            if($from == 'resend'){
                $route = 'smsPromotionals.resend';
            }else{
                $route = 'smsPromotionals.send';
            }
           
            $messageTyp = 'flash_danger';
        }
        return redirect()->route($route, [$param])
        ->with($messageTyp, $message);
    }

    
    public function send(Request $request, $param) {

            if($param == "sales_team"){
                $data = $request->all();
                //dd($data);
            }
            
        return view('sms_promotionals.send',compact('param'));
    }

    public function create(Request $request, $param) {
        //dd($request); 
        $EmployeeParticipations = Participation::with([
            'employees'=>function($q){
                return $q->select('*');
            },
          
        ])
        ->get();
        $KomolMobileNo = $EmployeeParticipations[0]->mobile;
        //dd($KomolMobileNo);
        $stakeholder_id = $request->sms_language;
        if($stakeholder_id == 'BN'){
            $message = $this->convertBanglatoUnicode($request->message);
        }else{
            $message = $request->message;
        }
        $msg = urlencode($message);
        if($stakeholder_id){
            $stakeholder = env('POLAR_SMS_SID_'.$stakeholder_id);
        }else{
            $stakeholder = env('POLAR_SMS_SID_EN');
        }
        $files = $EmployeeParticipations[0]->all();
        
        foreach($files as $file){
                
            //---------------- SMS Send Start-------------------------------------
            $MobileNumber = $file->mobile;
            //$MobileNumber = '01709816106';
            $message = $request->message;
            $sms = urlencode($message);
            $number = $MobileNumber;
            //---------------------------------------------
                $user = "POLAR"; 
                $pass = "i@57X322"; 
                //$sid = "PolarIceCream";
                $sid = $stakeholder; 
                
                $param="user=$user &pass=$pass &sms[0][0]= $number &sms[0][1]=$sms &sms[1][2]=123456790 &sid=$sid";
                
                $url="http://sms.sslwireless.com/pushapi/dynamic/server.php"; 
                $crl = curl_init(); 
                curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE); 
                curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2); 
                curl_setopt($crl,CURLOPT_URL,$url); 
                curl_setopt($crl,CURLOPT_HEADER,0); 
                curl_setopt($crl,CURLOPT_RETURNTRANSFER,1); 
                curl_setopt($crl,CURLOPT_POST,1); 
                curl_setopt($crl,CURLOPT_POSTFIELDS,$param); 
                $response = curl_exec($crl); 
                curl_close($crl); 
            //-----------------SMS Send End--------------------------------------- 
        
        }

              
        return view('sms_promotionals.send',compact('param'));
    }

    public function reSend(Request $request, $id) {
        $smsPromotional = SmsPromotional::findOrFail($id);
        if ($request->isMethod('post')) {
           $method = 'sendSmsTo'.ucwords(studly_case($smsPromotional->type));
            return $this->$method($request,$smsPromotional->type,'resend');
        }
        $employees = Employee :: pluck('name','id');
        $designations = collect([]);
        if($smsPromotional->type == 'sales_team'){
            $designations = Designation::where('status','active')->pluck('short_name','id');
        }
        
        return view('sms_promotionals.resend',compact('smsPromotional','employees','designations'));
    }
}
