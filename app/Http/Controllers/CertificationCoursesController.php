<?php

namespace App\Http\Controllers;
use App\FamilyDetail;
use App\Employee;
use App\CertificationCourse;
use Illuminate\Http\Request;

class CertificationCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificationCourses = CertificationCourse::with([
            'employees' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
       ->get();
        //dd($childDetails->toArray());
        return view('certificationCourses.index', compact('certificationCourses'));
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
        return view('certificationCourses.create', compact('employeesName'));
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
        $certificationCourses = CertificationCourse::create($data);
        if ($certificationCourses) {
            $message = "You have successfully created";
            return redirect()->route('certificationCourses.create', [])
                ->with('flash_success', $message);

        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('certificationCourses.create', [])
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
        $certificationCourses = CertificationCourse::findOrFail($id);
        $employeesName = Employee::pluck('name','id');
        //dd($employees->toArray());
        return view('certificationCourses.edit', compact('certificationCourses','employeesName'));
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
        $certificationCourses = CertificationCourse::where('id', $id)->update($data);
        if ($certificationCourses) {
            $message = "You have successfully updated";
            return redirect()->route('certificationCourses.index', [])
                ->with('flash_success', $message);

        } else {
            $message = "Nothing changed!! Please try again";
            return redirect()->route('certificationCourses.index', [])
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
        $certificationCourses = CertificationCourse::destroy($id);
        if ($certificationCourses) {
            $message = "You have successfully deleted";
            return redirect()->route('certificationCourses.index', [])
                ->with('flash_success', $message);
        } else {
            $message = "Something wrong!! Please try again";
            return redirect()->route('certificationCourses.index', [])
                ->with('flash_danger', $message);
        }
    }
}
