<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ChildDetail;
use App\Models\FamilyDetail;
use App\Models\Location;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Organization;
use App\Models\Participation;
use App\Models\BusinessMeet;
use App\Models\OfficeLocation;
use App\Models\Region;
use App\Exports\EmployeeExport;
use App\Exports\ParticipantExport;
use App\Exports\ChildParticipantExport;
use App\Exports\FamilyDetailsExport;
use App\Traits\PhpExcelFormater;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    use PhpExcelFormater;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\Models\User::find(auth()->id());
        //dd($user->toArray());
        $Organization_id = $user['organization_id'];
        //dd($Organization_id);
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
       
        $employees = Employee::with([
            'designation' => function ($q) {
                return $q->select('id', 'title');
            },
            'organization' => function ($q) {
                return $q->select('id', 'short_name');
            },
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'family_details' => function ($q) {
                return $q->select('*');
            },
            'employee_educations'=>function($q){
                return $q->select('*');
            },
            'child_details'=>function($q){
                return $q->select('*');
            },
            'certification_courses'=>function($q){
                return $q->select('*');
            },
            'job_experiances'=>function($q){
                return $q->select('*');
            },
            'office_location'=>function($q){
                return $q->select('id', 'name');
            },
            'prof_degrees'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
        ])
        ->where('status','active')
        ->where('organization_id',$Organization_id) 
        ->get();
        //dd($employees->toArray());
        //$departments = Department::with(['id' => function ($q) {
           // return $q->select('name', 'id');
       // }])
        //    ->whereIn('dept_id', $this->idemployees())
        //    ->get();
        //dd($employees->toArray());

        //->where('id',7)
        //->get();
        //dd ($employee->polar_id);
        

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd('Zashidul');
        
       // dd(str_plural('child'));
        $departments = Department::pluck('name','id');
        $designations = Designation::pluck('title','id');
        $officelocations = OfficeLocation::pluck('name','id');
        $regions = Region::pluck('name','id');
        $organizations = Organization::pluck('organization','id');
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        //dd($divisions);
        //$districtss = Location::with(['id' => function ($q)->pluck('name', 'id');
        //dd($divisions->toArray());
        return view('employees.create', compact('departments','designations','officelocations','regions', 'divisions', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        //$BirthDate['birthdate'] = $data['birthdate'];
        //$data['birthdate'] = Carbon::createFromFormat('d-m-Y', $data['birthdate'])
                   // ->format('Y-m-d');
        //$data['hiredate'] = Carbon::createFromFormat('d-m-Y', $data['hiredate'])
                   // ->format('Y-m-d');
        //$data['jobstartdate'] = Carbon::createFromFormat('d-m-Y', $data['jobstartdate'])
                   // ->format('Y-m-d');
//dd($data);
        
      
        //$data['birthdate'] = Carbon::createFromFormat(config('app.date_format'), $data['birthdate'])->format('yyyy-mm-dd');
        //$BirthDate['birthdate'] = $data['birthdate'];
        //$transaction = Transaction::create($data);
        //dd($BirthDate);
        $request->validate([
            'name' => 'required|unique:employees',
        ]);

        $employees = Employee::create($data);
        if ($employees) {
            $message = "You have successfully created";
            return redirect()->route('employees.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('employees.create', [])
                ->with('flash_danger', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function view($id)
    {
        return view('employees.view');
    }


    public function edit($id)
    {
        $employees[0] = Employee::findOrFail($id);
        //$employees = $employees[0];
        //dd($employees->toArray());
        //$employees = $employees->child_details[0];
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        //dd($divisions->toArray());
        $districts = Location::where('parent_id', $employees[0]->division_id[0])->pluck('name', 'id');
        //dd($districts);
        $thanas = Location::where('parent_id', $employees[0]->district_id[0])->pluck('name', 'id');
        //dd($thanas);
        $departments = Department::pluck('name','id');
        $designations = Designation::pluck('title','id');
        $officelocations = OfficeLocation::pluck('name','id');
        $regions = Region::pluck('name','id');
        $organizations = Organization::pluck('organization','id');
        //dd($officelocations->toArray());
        //return view('employees.create', compact('departments','designations','officelocations','regions'));
        return view('employees.edit', compact('employees','departments','designations','officelocations','regions', 'divisions',  'organizations','districts', 'thanas'));
    }

    public function viewEmployee($id)
    {
        $employees = Employee::with([
            'designation' => function ($q) {
                return $q->select('id', 'title');
            },
            'organization' => function ($q) {
                return $q->select('id', 'organization');
            },
            'office_location' => function ($q) {
                return $q->select('id', 'name');
            },
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'family_details' => function ($q) {
                return $q->select('*');
            },
            'employee_educations'=>function($q){
                return $q->select('*');
            },
            'job_experiances'=>function($q){
                return $q->select('*');
            },
            'child_details'=>function($q){
                return $q->select('*');
            },
            'division'=>function($q){
                return $q->select('*');
            },
            'district'=>function($q){
                return $q->select('*');
            },
            'thana'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
            
            

        ])
        ->where('id',$id)
        ->where('status','active')
        ->get();
        $employees = $employees[0];
        //$employees = $employees->child_details[0];
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
        //dd($divisions);
        $districts = Location::where('parent_id', $employees->division_id)->pluck('name', 'id');
        //dd($districts);
        $thanas = Location::where('parent_id', $employees->district_id)->pluck('name', 'id');
        
        //dd($employees->toArray());
        //------------------Test End Zashidul------------------

        return view('employees.employeeview', compact('employees'));

        //dd($id);
        
    }

    public function viewEmployeeDowload($id)
    {
        $employees = Employee::with([
            'designation' => function ($q) {
                return $q->select('id', 'title');
            },
            'organization' => function ($q) {
                return $q->select('id', 'organization');
            },
            'office_location' => function ($q) {
                return $q->select('id', 'name');
            },
            'department'=>function($q){
                return $q->select('id', 'name');
            },
            'family_details' => function ($q) {
                return $q->select('*');
            },
            'employee_educations'=>function($q){
                return $q->select('*');
            },
            'child_details'=>function($q){
                return $q->select('*');
            },
            'division'=>function($q){
                return $q->select('*');
            },
            'district'=>function($q){
                return $q->select('*');
            },
            'thana'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
            

        ])
        ->where('id',$id)
        ->where('status','active')
        ->get();
        $employees = $employees[0];
        //$avatar = $employees->user->avatar[0];
        //$employeeChild = $employees->child_details[0];
        //dd($id);
        //dd($employees->toArray());  

        //$dateOfBirth = $employees->child_details->date_of_birth[0];
        //$age = Carbon::parse($dateOfBirth)->age;  
        //dd($age->toArray());
        //$family_details = $family_details[0];
         //$user_id = auth()->user('id');
         //$user = User::find($user_id);
         //dd($user_id->toArray());
        //$ChildDOB = $employees->child_details;

        //dd($ChildDOB->toArray());
        //$Childage = Carbon::parse($ChildDOB)->Childage;
        //dd($Childage->toArray());

        //------------------Test End Zashidul------------------

        $pdf = \domPDF::loadView('pdf.employeeView_download', compact('employees'));
            //return view('pdf.employeeView_download', compact('reqisition', 'item'));
            return $pdf->download($employees->name . '.pdf');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_method', '_token');
        //dd($data);
        $validated = $request->validate([
            'name' => 'required|unique:employees,name,' . $id,
            'status' => 'required',
        ]);

        $employees = Employee::whereKey($id)->update($validated);
        if ($employees) {
            $message = "You have successfully updated";
            return redirect()->route('employees.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('employees.index', [])
                ->with('flash_warning', $message);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function transferPromotion(Request $request, $id)
    {
        //dd($id);


        $user = \App\Models\User::find(auth()->id());
        //dd($user->toArray());
        $Organization_id = $user['organization_id'];
        //dd($Organization_id);
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
       
        $employees = ChildDetail::with([
            'employees'=>function($q){
                    return $q->select('*');
            },
            
        ])
        ->where('child_participation', '=', 'Yes')
        ->get();
        //dd($employees->toArray());
        //dd($employees[0]->regions[0]->name);
        
        return view('employees.transfer_promotion', compact('employees'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateEmployee(Request $request, $id)
    {
        //dd($request);
        $data = $request->except('_method', '_token', 'title');
        $request->validate([
            'name' => 'required|unique:employees',
            'maritial_status' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'disclaimer'=> 'required',
        ]);

        $test['emergency_contact_person'] = $data['emergency_contact_person'];
        $test['relationship'] = $data['relationship'];
        $test['emergency_contact_no'] = $data['emergency_contact_no'];
        $test['nid'] = $data['nid'];
        $test['tin'] = $data['tin'];
        $test['passportno'] = $data['passportno'];
        $test['maritial_status'] = $data['maritial_status'];
        $test['present_address'] = $data['present_address'];
        $test['highest_education'] = $data['highest_education'];
        $test['institution'] = $data['institution'];
        $test['height_feet'] = $data['height_feet'];
        $test['height_inch'] = $data['height_inch'];
        $test['division_id'] = $data['division_id'];
        $test['district_id'] = $data['district_id'];
        $test['thana_id'] = $data['thana_id'];
        $test['disclaimer'] = 1;
        $test['permanent_address'] = $data['permanent_address'];
        $test['hobby'] = $data['hobby'];
        $test['birthdate'] = $data['birthdate'];
        $test['updated_at'] = \Carbon\Carbon::now();
        

        $test_family['marriage_date'] = $data['marriage_date'];
        $test_family['father_name'] = $data['father_name'];
        $test_family['father_occupation'] = $data['father_occupation'];
        $test_family['father_live_status'] = $data['father_live_status'];
        $test_family['mother_name'] = $data['mother_name'];
        $test_family['mother_occupation'] = $data['mother_occupation'];
        $test_family['mother_live_status'] = $data['mother_live_status'];

        $test_family['no_of_brothers'] = $data['no_of_brothers'];
        $test_family['brother_position'] = $data['brother_position'];
        $test_family['no_of_sisters'] = $data['no_of_sisters'];
        $test_family['sister_position'] = $data['sister_position'];
        $test_family['overall_position'] = $data['overall_position'];

        $test_family['wife_name'] = $data['wife_name'];
        $test_family['marriage_date'] = $data['marriage_date'];
        $test_family['wife_occupation'] = $data['wife_occupation'];
        $test_family['spouse_education'] = $data['spouse_education'];
        $test_family['spouse_mobile'] = $data['spouse_mobile'];
        $test_family['spouse_nameofcompany'] = $data['spouse_nameofcompany'];
        $test_family['spouse_presentposition'] = $data['spouse_presentposition'];
        $test_family['employee_id'] = $id;
        
        $existFamilyID = FamilyDetail::where('employee_id', $id)
        ->value('id');
        
        if($existFamilyID){

            FamilyDetail::where('employee_id',$id)->update($test_family);

        }else{

           $familyDetailsInsert = FamilyDetail::insert($test_family);
                
        }
        $employees = Employee::where('id', $id)->update($test);
        if ($employees) {
            $message = "You have successfully updated";
            return redirect()->route('dashboards.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "You have successfully updated";
            return redirect()->route('dashboards.index', [])
                ->with('flash_success', $message);
        }
    }

     public function BmParticipation(Request $request, $id)
    {
        
        $data = $request->all();
        //dd($data);
        //$wifename = $data['wife_name'];
        //$childname = $data['child_name'];
        //$ChildParticipation = $data['child_participation'];
        //dd($ChildParticipation);
        //$childID = $request['child_id'];
        //dd($childname);
        $data = $request->except('_method', '_token', 'title');
        $SpouseParticipations = $request['spouse_participation'];
        $EmployeeParticipations = Employee::with([
            'family_details' => function ($q) {
                return $q->select('*');
            },
            'child_details'=>function($q){
                return $q->select('*');
            },
            'business_meets'=>function($q){
                return $q->select('*');
            },
            'user'=>function($q){
                return $q->select('*');
            },
          
        ])
        ->where('id',$id)
        ->get();
        //dd($EmployeeParticipations->toArray());
        $EmployeeParticipant = $EmployeeParticipations[0]->name;
        

        //----------------------Apueba Da------------------------
        /*
            $ChildParticipantxt = '';
            if(!empty($data['child_id'])){
                foreach($EmployeeParticipations[0]->child_details as $ChildParticipant){
                    if($ChildParticipantxt ==''){
                        $ChildParticipantxt   = $ChildParticipant->child_name;
                    }else{
                        $ChildParticipantxt   = $ChildParticipantxt.' & '.$ChildParticipant->child_name;
                    }
                }
            }else{
                $ChildParticipantxt   = Null;
            }
            */
        //----------------------Apueba Da------------------------
       
        //dd($ChildParticipantxt);
        
        //$ChildParticipant    = $EmployeeParticipations[0]->child_details[0]->child_name;

        //$MessageSMS          = $EmployeeParticipant. '-'.$SpouseParticipant.'-'.$ChildParticipant;

        if($EmployeeParticipations[0]->maritial_status == 'Married'){
            if((!empty($EmployeeParticipations[0]->business_meets->employee_nid)) && (!empty($EmployeeParticipations[0]->business_meets->spouse_nid))){
                
                $request->validate([
                    'employee_participation' => 'required',
                    'return_confirmation' => 'required',
                    //'employee_nid' => 'required',
                    'spouse_participation' => 'required',
                    //'spouse_nid' => 'required',
                    'tshirt' => 'required',
                ]);
            }else{
                $request->validate([
                    'employee_participation' => 'required',
                    'return_confirmation' => 'required',
                    'employee_nid' => 'required | mimes:pdf',
                    //'employee_nid' => 'mimes:pdf|max:1024',
                    'spouse_participation' => 'required',
                    //'spouse_nid' => 'required | mimes:pdf',
                    'tshirt' => 'required',
                ]);
            }

            if($request->file('employee_nid')){
                //dd('komol');
                $file = $request->file('employee_nid');
                $extension =$file->getClientOriginalExtension();
                $employee_name = $data['name'];
                $employee_nid = $employee_name.'-'.time().'.'.$extension;
                $file->move('storage/Employee_nid/', $employee_nid);
                $data['employee_nid'] = $employee_nid;
            }else{
                $employee_nid = $EmployeeParticipations[0]->business_meets->employee_nid;
                //dd($employee_nid);
            }
            //dd($employee_name);
            if($request->file('spouse_nid')){
                $file_cert = $request->file('spouse_nid');
                $extension_cert =$file_cert->getClientOriginalExtension();
                $spouseName = $EmployeeParticipations[0]->family_details->wife_name;
                $spouse_nid = $spouseName.'-'.time().'.'.$extension_cert;
                $file_cert->move('storage/Spouse_nid/', $spouse_nid);
                $data['spouse_nid'] = $spouse_nid;
            }else{
                $spouse_nid = $EmployeeParticipations[0]->business_meets->spouse_nid;
                //$spouse_nid = '';
            }
            
            $files = $request->file('child_photo');
            if($files = $request->file('child_photo')){
                foreach($files as $i=>$file){
                    //dd($i);
                    $child_photo = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $child_photo = time().rand(1,100).'.'.$file->extension();
                    $destinationPath = 'storage/Child_nid'.'/';
                    $file->move($destinationPath, $child_photo);
                    if($child_photo){
                        $ChildImage = ChildDetail::where(['id'=> $request['child_id'][$i]])
                        ->update(['child_photo'=>$child_photo]);
                    }else{
                        $child_photo= '';
                    }
                    
                    
                }
                    
            }

            $input = $request->only('child_participation', 'child_id');
            //dd($input);
            if(!empty($input)){
                
                for ($i=0; $i < count($input['child_id']); ++$i) 
                {
                    $ChildInfo = ChildDetail::where('id', $input['child_id'][$i])
                    ->where('employee_id', $id)
                    ->value('id');

                    if($ChildInfo){
                        ChildDetail::where(['id'=> $input['child_id'][$i]])
                        ->update(['child_participation' => $input['child_participation'][$i]
                                  //'child_photo' => $child_photo
                              ]);
                    
                    }
                     
                }
            }
                
                $test['employee_id'] = $id;
                $test['employee_participation'] = $data['employee_participation'];
                $test['return_confirmation'] = $data['return_confirmation'];
                $test['tshirt'] = $data['tshirt'];
                $test['spouse_participation'] = $SpouseParticipations;
                $test['employee_nid'] = $employee_nid;
                $test['spouse_nid'] = $spouse_nid;
                $test['created_at'] = \Carbon\Carbon::now();
                $test['updated_at'] = \Carbon\Carbon::now();

            if($data['spouse_participation'] == 'Yes'){
                $SpouseParticipant   = $data['wife_name'];
            }else{
                $SpouseParticipant   = Null;
            }
           
            $ChildPart = $request->only('child_participation', 'child_id', 'child_name');
            //dd($ChildPart);
            if(!empty($ChildPart)){
                $ChildParticipantxt = '';
                for ($i=0; $i < count($ChildPart['child_id']); ++$i) 
                {                    
                    if($ChildPart['child_participation'][$i] == 'Yes'){
                        if($ChildParticipantxt ==''){
                            $ChildParticipantxt   = $ChildPart['child_name'][$i];
                        }else{
                            $ChildParticipantxt   = $ChildParticipantxt.' & '.$ChildPart['child_name'][$i];
                        }  
                         
                    }elseif($ChildPart['child_participation'][$i] == 'No'){
                        if($ChildParticipantxt ==''){
                            $ChildParticipantxt   = '';
                        }else{
                            $ChildParticipantxt   = $ChildParticipantxt;
                        }
                    }
                        
                     
                }
            }
           
        }elseif ($EmployeeParticipations[0]->maritial_status == 'Unmarried') {
            if(!empty($EmployeeParticipations[0]->business_meets->employee_nid)){
                $request->validate([
                'employee_participation' => 'required',
                'return_confirmation' => 'required',
                //'employee_nid' => 'required',
                'tshirt' => 'required',
                
                ]);  
            }else{
                $request->validate([
                    'employee_participation' => 'required',
                    'return_confirmation' => 'required',
                    'employee_nid' => 'required',
                    'tshirt' => 'required',
                    
                ]); 
            }

            if($request->file('employee_nid')){
                $file = $request->file('employee_nid');
                $extension =$file->getClientOriginalExtension();
                $employee_name = $data['name'];
                $employee_nid = $employee_name.'-'.time().'.'.$extension;
                $file->move('storage/Employee_nid/', $employee_nid);
                $data['employee_nid'] = $employee_nid;
            }else{
                $employee_nid = $EmployeeParticipations[0]->business_meets->employee_nid;
                //dd($employee_nid);
            }
                //dd($spouse_nid);
                $test['employee_id'] = $id;
                $test['employee_participation'] = $data['employee_participation'];
                $test['return_confirmation'] = $data['return_confirmation'];
                $test['tshirt'] = $data['tshirt'];
                //$test['spouse_participation'] = $SpouseParticipations;
                $test['employee_nid'] = $employee_nid;
                //$test['spouse_nid'] = $spouse_nid;
                $test['created_at'] = \Carbon\Carbon::now();
                $test['updated_at'] = \Carbon\Carbon::now();
        }

            

                
        $employees = BusinessMeet::where('employee_id', $id)
        ->value('id');
        
        if($employees){

            if($EmployeeParticipations[0]->maritial_status == 'Married'){

                if(!empty($EmployeeParticipations[0]->child_details[0])){
                    //---------------- SMS Send Start-------------------------------------
                    //dd('komol');
                    $MobileNumber = $EmployeeParticipations[0]->mobile;
                    //$MobileNumber = '01709816106';
                    $Message_one = "Sir, BM-2023 Registration updated for";
                    //$Message_two = $bmparticipants[0]->room_one. ' & ' . $bmparticipants[0]->room_two ;
                    $Message_three = "\nThanks | BM-2023 Execution Team.";
                    $message = $Message_one.' '."\n". $EmployeeParticipant."\n".$SpouseParticipant."\n".$ChildParticipantxt.'  '.$Message_three;
                    $sms = urlencode($message);
                    $number = $MobileNumber;
                    //---------------------------------------------
                        $user = "POLAR"; 
                        $pass = "i@57X322"; 
                        $sid = "PolarIceCream"; 
                        
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
                }else{
                    //---------------- SMS Send Start-------------------------------------
                    $MobileNumber = $EmployeeParticipations[0]->mobile;
                    //$MobileNumber = '01709816106';
                    $Message_one = "Sir, BM-2023 Registration updated for";
                    //$Message_two = $bmparticipants[0]->room_one. ' & ' . $bmparticipants[0]->room_two ;
                    $Message_three = "\nThanks | BM-2023 Execution Team.";
                    $message = $Message_one.' '."\n". $EmployeeParticipant."\n".$SpouseParticipant."\n".$Message_three;
                    $sms = urlencode($message);
                    $number = $MobileNumber;
                    //---------------------------------------------
                        $user = "POLAR"; 
                        $pass = "i@57X322"; 
                        $sid = "PolarIceCream"; 
                        
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

                
            }else{
                //---------------- SMS Send Start-------------------------------------
                $MobileNumber = $EmployeeParticipations[0]->mobile;
                //$MobileNumber = '01709816106';
                $Message_one = "Sir, BM-2023 Registration updated for : ";
                $Message_three = "\nThanks | BM-2023 Execution Team.";
                $message = $Message_one.' '."\n". $EmployeeParticipant.$Message_three;
                $sms = urlencode($message);
                $number = $MobileNumber;
                //---------------------------------------------
                    $user = "POLAR"; 
                    $pass = "i@57X322"; 
                    $sid = "PolarIceCream"; 
                    
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

            $BusinessMeetUp = BusinessMeet::where('employee_id',$id)->update($test);
            
            $message = "You have successfully updated the BM-Registration";
            return redirect()->route('dashboards.bmparticipation', [])
                ->with('flash_success', $message);

        }else{

            if($EmployeeParticipations[0]->maritial_status == 'Married'){

                if(!empty($EmployeeParticipations[0]->child_details[0])){
                    //---------------- SMS Send Start-------------------------------------
                    //dd('komol');
                    $MobileNumber = $EmployeeParticipations[0]->mobile;
                    //$MobileNumber = '01709816106';
                    $Message_one = "Sir, BM-2023 Registration Completed for";
                    //$Message_two = $bmparticipants[0]->room_one. ' & ' . $bmparticipants[0]->room_two ;
                    $Message_three = "\nThanks | BM-2023 Execution Team.";
                    $message = $Message_one.' '."\n". $EmployeeParticipant."\n".$SpouseParticipant."\n".$ChildParticipantxt.'  '.$Message_three;
                    $sms = urlencode($message);
                    $number = $MobileNumber;

                    //---------------------------------------------
                        $user = "POLAR"; 
                        $pass = "i@57X322"; 
                        $sid = "PolarIceCream"; 
                        
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
                }else{
                    //---------------- SMS Send Start-------------------------------------
                    $MobileNumber = $EmployeeParticipations[0]->mobile;
                    //$MobileNumber = '01709816106';
                    $Message_one = "Sir, BM-2023 Registration Completed for";
                    //$Message_two = $bmparticipants[0]->room_one. ' & ' . $bmparticipants[0]->room_two ;
                    $Message_three = "\nThanks | BM-2023 Execution Team.";
                    $message = $Message_one.' '."\n". $EmployeeParticipant."\n".$SpouseParticipant."\n".$Message_three;
                    $sms = urlencode($message);
                    $number = $MobileNumber;
                    //---------------------------------------------
                        $user = "POLAR"; 
                        $pass = "i@57X322"; 
                        $sid = "PolarIceCream"; 
                        
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

                
            }else{
                //---------------- SMS Send Start-------------------------------------
                $MobileNumber = $EmployeeParticipations[0]->mobile;
                //$MobileNumber = '01709816106';
                $Message_one = "Sir, BM-2023 Registration Completed for : ";
                $Message_three = "\nThanks | BM-2023 Execution Team.";
                $message = $Message_one.' '."\n". $EmployeeParticipant.$Message_three;
                $sms = urlencode($message);
                $number = $MobileNumber;
                //---------------------------------------------
                    $user = "POLAR"; 
                    $pass = "i@57X322"; 
                    $sid = "PolarIceCream"; 
                    
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

           $BusinessMeetInsert = BusinessMeet::insert($test);            
           $message = "You have successfully Completed the Registration";
            return redirect()->route('dashboards.bmparticipation', [])
                ->with('flash_success', $message);
                
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function totalparticipantlist()
    {
        $user = \App\Models\User::find(auth()->id());
        //dd($user->toArray());
        $Organization_id = $user['organization_id'];
        //dd($Organization_id);
        $divisions = Location::whereNull('parent_id')->pluck('name', 'id');
       
        $employees = ChildDetail::with([
            'employees'=>function($q){
                    return $q->select('*');
            },
            
        ])
        ->where('child_participation', '=', 'Yes')
        ->get();
        //dd($employees->toArray());
        //dd($employees[0]->regions[0]->name);
        
        return view('employees.totalparticipantlist', compact('employees'));
    }


    public function destroy($id)
    {
        $employees = Employee::destroy($id);
        if ($employees) {
            $message = "You have successfully deleted";
            return redirect()->route('employees.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('employees.index', [])
                ->with('flash_danger', $message);
        }
    }

    public function download() {
        return (new EmployeeExport())->download('employee.xlsx');
    }
    
    public function participantListdownload() {
        //dd('komol');
        return (new ParticipantExport())->download('ParticipantList.xlsx');
    }

    public function childparticipantListdownload() {
        //dd('komol');
        return (new ChildParticipantExport())->download('ChildParticipantList.xlsx');
    }

    public function familyDetailsdownload() {
        //dd('komol');
        return (new FamilyDetailsExport())->download('FamilyDetails.xlsx');
    }


    public function uploadEmployee(Request $request) {
        ini_set('max_execution_time', 60000);
        /*
         file path must be absolute and related to local drive
         */
        
        if ($request->isMethod('post')) {
            $file = $request->file('file');
            
            $request->validate([
                'file' => 'required|mimes:xlsx|max:1024',
            ]);
            //dd($request);
            $filePath = $file->getRealPath();
            $excelDataArray = $this->dumptoarray($filePath);
            //dd('Sarker');
            //dd($excelDataArray);
            $departmentList = Department::pluck('name','id');
            $designationList = Designation::pluck('title','id');
            $organizationList = Organization::pluck('organization','id');
            //$regionList = Region::pluck('name','id');
            $officeLocationList = OfficeLocation::pluck('name','id');
            $divisionList = Location::pluck('name','id');
            $districtList = Location::pluck('name','id');
            $thanaList = Location::pluck('name','id');
            $dataArray = [];

            foreach ($excelDataArray as $key => $value) {
                $mobileNo = str_pad(trim($value['mobile']), 11, 0, STR_PAD_LEFT);
                       
                $data = [];
                $data['polar_id'] = $value['polar_id'];
                $data['name'] = $value['name'];
                $data['email'] = $value['email'];
                $data['mobile'] = $mobileNo;
                $data['dept_id'] = $departmentList->search(trim(html_entity_decode($value['deptartment']))) ?: 0;
                $data['desig_id'] = $designationList->search(trim(html_entity_decode($value['designation']))) ?: 0;
                $data['office_loc_id'] = $officeLocationList->search(trim($value['office_location']));
                $data['hiredate'] =  $value['hire_date'];
                $data['birthdate'] =  $value['birth_date'];
                $data['grade'] =  $value['grade'];
                $data['gender'] = $value['gender'] ;
                $data['bloodgroup'] = $value['blood_group'] ;
                $data['employee_type'] = $value['employee_type'] ;
                $data['nid'] = $value['nid'] ;
                $data['job_status'] = $value['job_status'] ;
                $data['highest_education'] = $value['highest_education'] ;
                $data['maritial_status'] = $value['marital_status'] ;
                $data['present_address'] = html_entity_decode($value['present_address']) ;
                $data['division_id'] = $divisionList->search(trim(html_entity_decode($value['division']))) ?: 0;
                $data['district_id'] = $districtList->search(trim(html_entity_decode($value['district']))) ?: 0;
                $data['thana_id'] = $thanaList->search(trim(html_entity_decode($value['thana']))) ?: 0;
                $data['permanent_address'] = html_entity_decode($value['permanent_address']);
                $data['employee_type'] = $value['employee_type'] ;
                $data['organization_id'] = $organizationList->search(trim(html_entity_decode($value['company'])))?: 0;
                $data['status'] = $value['status'];

                //dd($employees->toArray());
                //dd($data->toArray());
                 
                $existEmployeeId = Employee::where('id', $value['id'])
                ->orWhere('polar_id',$value['polar_id'])
                ->value('id');
                //if employe exist then update
                if($existEmployeeId){
                    Employee::where('id',$existEmployeeId)->update($data);
                }else{
                    $dataArray[$key] = $data;
                    $dataArray[$key]['created_at'] = Carbon::now();
                    $dataArray[$key]['updated_at'] = Carbon::now();
                    
                }
                
            }
            $employees = Employee::insert($dataArray);
            if ($employees) {
                $message = "Successfully Uploaded";
                return redirect()->route('employees.uploads')
                ->with('flash_success', $message);
            } else {
                $message = "Something wrong!! Please try again";
                return redirect()->route('employees.uploads')
                ->with('flash_danger', $message);
            }
            
        } else {
            return view('employees.uploads');
        }
       
    }

    public function birthday()
    {

        //--------------------------------------------------------------------------
            $CurDateTime    = Carbon::today();
            //dd ($CurDateTime);
            list($CurDate, $CurTime)=explode(' ', $CurDateTime);
            list($CurYear, $CurMonth, $CurDay)=explode('-', $CurDate);
            
            $results = Employee::with([
                'designation' => function ($q) {
                    return $q->select('id', 'title');
                },
                'organization' => function ($q) {
                    return $q->select('id', 'organization');
                },
                'office_location' => function ($q) {
                    return $q->select('id', 'name');
                },
                'department'=>function($q){
                    return $q->select('id', 'name');
                },
                'user'=>function($q){
                    return $q->select('*');
                },
                

            ])
            ->whereMonth('birthdate', '=', $CurMonth)
            //->whereDay('birthdate', '=', $CurDay)
            ->where('organization_id', '=', '1')
            ->where('status','active')
            ->get();
         
            //dd($results);
            
            
                foreach($results as $key=>$result)
                {
                    $dob = $result->birthdate;
                    $mobile_list = $result->mobile;
                    $name = $result->name;
                    //$last_name = $result->last_name;
                    //dd($mobile_list);

                   
                $message_text = "Happy Birth Day";

                $authKey = urlencode('Your Auth Key');
                // Message details
                $mobiles = array($mobile_list);
                $sender = urlencode('123456');
                $message = rawurlencode($message_text);
                $route=2;
                $country=5;

                $mobiles = implode(',', $mobiles);
                //dd ($mobiles);

                // Prepare data for POST request
                $data = array('authkey' => $authKey, 'mobiles' => $mobiles, "message" => $message, "sender" => $sender);
                //dd ($data);

                //----------------------------
                $url="http://sms.sslwireless.com/pushapi/dynamic/server.php"; 
                $crl = curl_init(); 
                curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE); 
                curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2); 
                curl_setopt($crl,CURLOPT_URL,$url); 
                curl_setopt($crl,CURLOPT_HEADER,0); 
                curl_setopt($crl,CURLOPT_RETURNTRANSFER,1); 
                curl_setopt($crl,CURLOPT_POST,1); 
                curl_setopt($crl,CURLOPT_POSTFIELDS,$data); 
                $response = curl_exec($crl); 
                curl_close($crl); 
                //----------------------------

                // Send the POST request with cURL
                //$ch = curl_init('your url');
                //curl_setopt($ch, CURLOPT_POST, true);
                //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //$response = curl_exec($ch);
                //curl_close($ch);

                // Process your response here

                }
                //dd($mobile_list);

            // Execute it via performing cronjobs

            

        
        
        return view('employees.birthday', compact('results', 'CurYear', 'CurMonth'));
    }

    public function marriageday()
    {

        //--------------------------------------------------------------------------
            $CurDateTime    = Carbon::today();
            //dd ($CurDateTime);
            list($CurDate, $CurTime)=explode(' ', $CurDateTime);
            list($CurYear, $CurMonth, $CurDay)=explode('-', $CurDate);
            
            $results = FamilyDetail::with([
                'employees'=>function($q){
                    return $q->select('*');
                },
                'employees.designation'=>function($q){
                    return $q->select('*');
                },
                'employees.department'=>function($q){
                    return $q->select('*');
                },
              
            ])
            ->join('employees', 'employees.id' ,'=', 'family_details.employee_id')
            ->whereMonth('marriage_date', '=', $CurMonth)
            //->whereDay('birthdate', '=', $CurDay)
            ->where('employees.organization_id', '=', '1')
            ->where('employees.status','active')
            ->get();
         
            //dd($results->toArray());
            
                
        
        return view('employees.marriageday', compact('results', 'CurYear', 'CurMonth'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
