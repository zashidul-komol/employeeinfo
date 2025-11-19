<?php

namespace App\Http\Controllers;

use App\Models\FamilyDetail;
use App\Models\Employee;
use App\Models\User;
use App\Models\JobExperiance;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class JobExperiancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobExperiances = JobExperiance::with([
            'employees' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
       ->get();
        //dd($childDetails->toArray());
        return view('jobExperiances.index', compact('jobExperiances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$departments = Department::pluck('name','id');
        $employeesName = Employee::select('name')
        ->whereIn('id',auth()->user('id'))
        ->get();
        //$Empname          = $employeesName['name'];
        //$id            = $employeesName['id'];
        //dd ($employeesName);
        //dd($employeesName->toArray());
        $EmployeeDetails    = $employeesName .'-'.$employeesName;
        //dd($EmployeeDetails);
        return view('jobExperiances.create', compact('employeesName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \App\Models\User::find(auth()->id());
        $Emp_id['employee_id'] = $user['employee_id'];

        $rules = array(
            'name_company' => 'required',
            'position' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) 
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = array(
            'name_company' => $request->name_company,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'employee_id' => $Emp_id['employee_id']

        );
        //JobExperiance::create($form_data);
        $jobExperiances = JobExperiance::create($form_data);
        if ($jobExperiances) {
            $updated_at = Carbon::now();
            Employee::where('id',$Emp_id['employee_id'])->update(['updated_at' => $updated_at]);
            $message = "You have successfully created";
            return redirect()->route('dashboards.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('dashboards.index', [])
                ->with('flash_danger', $message);
        }
        
        return response()->json(['success' => 'Data Added Successfully.']);

    }

    /*{
        //dd($request);
        if($request->ajax())
        {
            $rules = array(
                'employee_id.*' => 'required',
                'name_company.*'=> 'required',
                'position.*'=> 'required',
                'start_date.*'=> 'required',
                'end_date.*'=> 'required'



            );
            $error = validate::make($request->all(),$rules);
            if($error->fails())
            {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }
            $employee_id    = $request->employee_id;
            $name_company    = $request->name_company;
            $position    = $request->position;
            $start_date    = $request->start_date;
            $end_date    = $request->end_date;
            for($count = 0; $count < count($employee_id); $count++)
            {
                $data = array(
                    'employee_id' =>$employee_id[$count],
                    'name_company' =>$name_company[$count],
                    'position' =>$position[$count],
                    'start_date' =>$start_date[$count],
                    'end_date' =>$end_date[$count],
                );
                $insert_data[] = $data;

            }
            //dd($data);
            JobExperiance::insert($insert_data);
            return response()->json([
                'success' => 'Data Added Successfully.'
            ]);


        }
        
        /*
        $data = $request->all();
        //dd($data);
        $jobExperiances = JobExperiance::create($data);
        if ($jobExperiances) {
            $message = "You have successfully created";
            return redirect()->route('jobExperiances.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('jobExperiances.create', [])
                ->with('flash_danger', $message);
        }
        */


    

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
        $jobExperiances = JobExperiance::findOrFail($id);
        $employeesName = Employee::pluck('name','id');
        //dd($employees->toArray());
        return view('jobExperiances.edit', compact('jobExperiances','employeesName'));
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
        $jobExperiances = JobExperiance::whereKey($id)->update($data);

        $user = \App\Models\User::find(auth()->id());
        $Emp_id['employee_id'] = $user['employee_id'];

        if ($jobExperiances) {
            $updated_at = Carbon::now();
            Employee::where('id',$Emp_id['employee_id'])->update(['updated_at' => $updated_at]);
            $message = "You have successfully updated";
            return redirect()->route('dashboards.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('dashboards.index', [])
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
        $jobExperiances = JobExperiance::destroy($id);
        if ($jobExperiances) {
            $message = "You have successfully deleted";
            return redirect()->route('dashboards.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('dashboards.index', [])
                ->with('flash_danger', $message);
        }
    }

    public function download() {
        return (new EmployeeExport())->download('employee.xlsx');
    }
    
}
