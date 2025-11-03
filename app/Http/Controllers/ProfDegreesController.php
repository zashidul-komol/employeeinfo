<?php

namespace App\Http\Controllers;

use App\FamilyDetail;
use App\Employee;
use App\ProfDegree;
use Illuminate\Http\Request;

class ProfDegreesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profDegrees = ProfDegree::with([
            'employees' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
       ->get();
        //dd($childDetails->toArray());
        return view('profDegrees.index', compact('profDegrees'));
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
        return view('profDegrees.create', compact('employeesName'));
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
        $profDegrees = ProfDegree::create($data);
        if ($profDegrees) {
            $message = "You have successfully created";
            return redirect()->route('profDegrees.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('profDegrees.create', [])
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
        $profDegrees = ProfDegree::findOrFail($id);
        $employeesName = Employee::pluck('name','id');
        //dd($employees->toArray());
        return view('profDegrees.edit', compact('profDegrees','employeesName'));
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
        $profDegrees = ProfDegree::where('id', $id)->update($data);
        if ($profDegrees) {
            $message = "You have successfully updated";
            return redirect()->route('profDegrees.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('profDegrees.index', [])
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
        $profDegrees = ProfDegree::destroy($id);
        if ($profDegrees) {
            $message = "You have successfully deleted";
            return redirect()->route('profDegrees.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('profDegrees.index', [])
                ->with('flash_danger', $message);
        }
    }
}
