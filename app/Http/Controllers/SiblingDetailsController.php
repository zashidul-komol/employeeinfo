<?php

namespace App\Http\Controllers;

use App\Models\FamilyDetail;
use App\Models\Employee;
use App\Models\SiblingDetail;
use Illuminate\Http\Request;

class SiblingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siblingDetails = SiblingDetail::with([
            'employees' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
       ->get();
        //dd($siblingDetails->toArray());
        return view('siblingDetails.index', compact('siblingDetails'));
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
        return view('siblingDetails.create', compact('employeesName'));
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
        $siblingDetails = SiblingDetail::create($data);
        if ($siblingDetails) {
            $message = "You have successfully created";
            return redirect()->route('siblingDetails.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('siblingDetails.create', [])
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
        $siblingDetails = SiblingDetail::findOrFail($id);
        $employeesName = Employee::pluck('name','id');
        //dd($employees->toArray());
        return view('siblingDetails.edit', compact('siblingDetails','employeesName'));
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
        $siblingDetails = SiblingDetail::whereKey($id)->update($data);
        if ($siblingDetails) {
            $message = "You have successfully updated";
            return redirect()->route('siblingDetails.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('siblingDetails.index', [])
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
        $siblingDetails = SiblingDetail::destroy($id);
        if ($siblingDetails) {
            $message = "You have successfully deleted";
            return redirect()->route('siblingDetails.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('siblingDetails.index', [])
                ->with('flash_danger', $message);
        }
    }
}
