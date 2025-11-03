<?php

namespace App\Http\Controllers;

use App\FamilyDetail;
use App\Employee;
use App\ChildDetail;
use App\Relationship;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;


class RelationshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childDetails = ChildDetail::with([
            'employees' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
       ->get();
        //dd($childDetails->toArray());
       $organizations = Organization::pluck('organization','id');
        return view('childDetails.index', compact('childDetails','organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('komol');
        //$departments = Department::pluck('name','id');
        $employeesName = Employee::pluck('name','id');
        $organizations = Organization::pluck('organization','id');
        //dd($officelocations->toArray());
        return view('childDetails.create', compact('employeesName','organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $user = \App\User::find(auth()->id());
        $Emp_id['employee_id'] = $user['employee_id'];

        $rules = array(
            'name' => 'required',
            'organization_id' => 'required',
            'relationship' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) 
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = array(
            'name' => $request->name,
            'organization_id' => $request->organization_id,
            'relationship' => $request->relationship,
            'employee_id' => $Emp_id['employee_id']

        );
        //dd($form_data);
        //JobExperiance::create($form_data);
        $relativesDetails = Relationship::create($form_data);
        if ($relativesDetails) {
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

       /*
        $data = $request->all();
        //dd($data);
        $childDetails = ChildDetail::create($data);
        if ($childDetails) {
            $message = "You have successfully created";
            return redirect()->route('childDetails.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('childDetails.create', [])
                ->with('flash_danger', $message);
        }
        */
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
        $childDetails = ChildDetail::findOrFail($id);
        $employeesName = Employee::pluck('name','id');
        //dd($employees->toArray());
        return view('childDetails.edit', compact('childDetails','employeesName'));
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

        $user = \App\User::find(auth()->id());
        $Emp_id['employee_id'] = $user['employee_id'];
        
        $childDetails = ChildDetail::where('id', $id)->update($data);
        if ($childDetails) {
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
        $childDetails = ChildDetail::destroy($id);
        if ($childDetails) {
            $message = "You have successfully deleted";
            return redirect()->route('dashboards.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('dashboards.index', [])
                ->with('flash_danger', $message);
        }
    }
}
