<?php

namespace App\Http\Controllers;

use App\Models\FamilyDetail;
use App\Models\Employee;
use App\Models\EmployeeEducation;
use Illuminate\Http\Request;

class EmployeeEducationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeEducations = EmployeeEducation::with([
            'employees' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
       ->get();
        //dd($childDetails->toArray());
        return view('employeeEducations.index', compact('employeeEducations'));
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
        return view('employeeEducations.create', compact('employeesName'));
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
        $employeeEducations = EmployeeEducation::create($data);
        if ($employeeEducations) {
            $message = "You have successfully created";
            return redirect()->route('employeeEducations.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('employeeEducations.create', [])
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
        $employeeEducations = EmployeeEducation::findOrFail($id);
        $employeesName = Employee::pluck('name','id');
        //dd($employees->toArray());
        return view('employeeEducations.edit', compact('employeeEducations','employeesName'));
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
        $employeeEducations = EmployeeEducation::whereKey($id)->update($data);
        if ($employeeEducations) {
            $message = "You have successfully updated";
            return redirect()->route('employeeEducations.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('employeeEducations.index', [])
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
        $employeeEducations = EmployeeEducation::destroy($id);
        if ($employeeEducations) {
            $message = "You have successfully deleted";
            return redirect()->route('employeeEducations.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('employeeEducations.index', [])
                ->with('flash_danger', $message);
        }
    }
}
