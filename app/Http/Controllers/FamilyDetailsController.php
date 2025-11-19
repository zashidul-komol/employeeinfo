<?php

namespace App\Http\Controllers;
use App\Models\FamilyDetail;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\FamilyDetailExport;
use App\Traits\PhpExcelFormater;
use Carbon\Carbon;


class FamilyDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familyDetails = FamilyDetail::with([
            'employees' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
       ->get();
        //dd($familyDetails->toArray());
        return view('familyDetails.index', compact('familyDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$departments = Department::pluck('name','id');
        $employeesName = Employee::pluck('name','id');
        //dd($officelocations->toArray());
        return view('familyDetails.create', compact('employeesName'));
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
        //dd($data);
        $familyDetails = FamilyDetail::create($data);
        if ($familyDetails) {
            $message = "You have successfully created";
            return redirect()->route('familyDetails.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('familyDetails.create', [])
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
    public function edit($id)
    {
        $familyDetails = FamilyDetail::findOrFail($id);
        $employeesName = Employee::pluck('name','id');
        //dd($employees->toArray());
        return view('familyDetails.edit', compact('familyDetails','employeesName'));
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
        $familyDetails = FamilyDetail::whereKey($id)->update($data);
        if ($familyDetails) {
            $message = "You have successfully updated";
            return redirect()->route('familyDetails.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('familyDetails.index', [])
                ->with('flash_warning', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $familyDetails = FamilyDetail::destroy($id);
        if ($familyDetails) {
            $message = "You have successfully deleted";
            return redirect()->route('familyDetails.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('familyDetails.index', [])
                ->with('flash_danger', $message);
        }
    }

    public function download() {
        return (new FamilyDetailExport())->download('familyDetails.xlsx');
    }

    public function uploadFamilyDetails(Request $request) {
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
            dd('komol');
            dd($excelDataArray);
            $departmentList = Department::pluck('name','id');
            $designationList = Designation::pluck('title','id');
            $regionList = Region::pluck('name','id');
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
                $data['emergency_contact_no'] = $value['emergency_contact_no'];
                $data['nid'] = $value['nid'];
                $data['passportno'] = $value['passportno'];
                $data['dept_id'] = $departmentList->search(trim(html_entity_decode($value['deptartment']))) ?: 0;
                $data['desig_id'] = $designationList->search(trim(html_entity_decode($value['designation']))) ?: 0;
                $data['office_loc_id'] = $officeLocationList->search(trim($value['office_location']));
                $data['region_id'] =  $regionList->search(trim($value['region'])) ? : 0;
                $data['hiredate'] =  $value['hire_date'];
                $data['birthdate'] =  $value['birth_date'];
                $data['highest_education'] = $value['highest_education'] ;
                $data['grade'] = $value['grade'] ;
                $data['height_feet'] = $value['height_feet'] ;
                $data['bloodgroup'] = $value['blood_group'] ;
                $data['gender'] = $value['gender'] ;
                $data['maritial_status'] = $value['marital_status'] ;
                $data['present_address'] = html_entity_decode($value['present_address']) ;
                $data['division_id'] = $divisionList->search(trim(html_entity_decode($value['division']))) ?: 0;
                $data['district_id'] = $districtList->search(trim(html_entity_decode($value['district']))) ?: 0;
                $data['thana_id'] = $thanaList->search(trim(html_entity_decode($value['thana']))) ?: 0;
                $data['permanent_address'] = html_entity_decode($value['permanent_address']);
                $data['status'] = $value['status'];
                 
                $existEmployeeId = Employee::where('id', $value['id'])
                ->orWhere('mobile',$mobileNo)
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
}
