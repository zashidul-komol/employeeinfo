<?php

namespace App\Http\Controllers;
use App\Relationship;
use App\Organization;

use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(str_plural('child'));
         $employees = Employee::with([
            'designation' => function ($q) {
                return $q->select('id', 'title');
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
                return $q->select('*');
            },
            'prof_degrees'=>function($q){
                return $q->select('*');
            },
            
        ])
        ->get();
        dd($employees->toArray());
        //dd($employees);
        //$departments = Department::with(['id' => function ($q) {
           // return $q->select('name', 'id');
       // }])
        //    ->whereIn('dept_id', $this->idemployees())
        //    ->get();
        //dd($employees->toArray());

        ->where('id',231)
        ->get();
        //dd ($employee->polar_id);
        

        return view('dashboards.index', compact('employees'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(str_plural('child'));
        $departments = Department::pluck('name','id');
        $designations = Designation::pluck('title','id');
        $officelocations = OfficeLocation::pluck('name','id');
        $regions = Region::pluck('name','id');
        $organizations = Organization::pluck('organization','id');
        //dd($officelocations->toArray());
        return view('dashboards.create', compact('departments','designations','officelocations','regions', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $employees = Employee::findOrFail($id);
        $departments = Department::pluck('name','id');
        $designations = Designation::pluck('title','id');
        $officelocations = OfficeLocation::pluck('name','id');
        $regions = Region::pluck('name','id');
        //dd($officelocations->toArray());
        //return view('employees.create', compact('departments','designations','officelocations','regions'));
        return view('dashboards.edit', compact('employees','departments','designations','officelocations','regions'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
