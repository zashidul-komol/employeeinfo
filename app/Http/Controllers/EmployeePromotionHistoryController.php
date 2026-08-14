<?php

namespace App\Http\Controllers;

use App\Traits\PhpExcelFormater;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Designation;
use App\Models\OfficeLocation;
use App\Models\EmployeePromotionHistory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeePromotionListExport;

class EmployeePromotionHistoryController extends Controller
{
    use PhpExcelFormater;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = \App\Models\User::find(auth()->id());

        $Organization_id = $user->organization_id;

        $employees = EmployeePromotionHistory::with([
            'employee:id,name,polar_id',
            'previousDesignation:id,title',
            'newDesignation:id,title',
        ])
        ->whereHas('employee', function ($q) use ($Organization_id) {
            $q->where('organization_id', $Organization_id);
        })
        ->orderBy('employee_id', 'ASC')
        ->orderBy('effective_date', 'ASC')
        ->get()
        ->groupBy('employee_id');

        /*
        |--------------------------------------------------------------------------
        | Calculate Promotion Duration
        |--------------------------------------------------------------------------
        */

        foreach ($employees as $employeeId => $employeeHistories) {

            // Make sure index is 0,1,2,3...
            $employeeHistories = $employeeHistories->values();

            foreach ($employeeHistories as $index => $data) {

                // Get next promotion
                $nextPromotion = $employeeHistories->get($index + 1);

                if ($nextPromotion) {

                    // Current promotion -> Next promotion
                    $endDate = \Carbon\Carbon::parse(
                        $nextPromotion->effective_date
                    );

                } else {

                    // Last promotion -> Today
                    $endDate = \Carbon\Carbon::now();

                }

                $startDate = \Carbon\Carbon::parse(
                    $data->effective_date
                );

                $duration = $startDate->diff($endDate);

                // Add calculated duration to model
                $data->promotion_duration = $duration;
            }

            // Replace original collection with re-indexed collection
            $employees[$employeeId] = $employeeHistories;
        }

        return view(
            'promotion_details.index',
            compact('employees')
        );
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $departments = Department::where('organization_id', 1)
            ->pluck('name', 'id');
        $office_locations = OfficeLocation::where('organization_id', 1)
            ->pluck('name', 'id');

        $employeesName = Employee::with([
            'designation:id,title',
            'department:id,name',
            'office_location:id,name'
        ])
        ->select(
            'id',
            'name',
            'polar_id',
            'dept_id',
            'desig_id',
            'grade',
            'office_loc_id'
        )
        ->where('status', 'active')
        ->where('organization_id', 1)
        ->orderBy('id', 'ASC')
        ->get();
        //dd($employeesName->toArray());
        $designations = Designation::pluck('title', 'id');
        

        return view(
            'promotion_details.create',
            compact(
                'employeesName',
                'departments',
                'designations',
                'office_locations'
            )
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'employee_id'              => 'required|exists:employees,id',
            'promotion_type'           => 'required|string|max:100',
            'effective_date'           => 'required|date',
            'new_designation_id'       => 'required|exists:designations,id',
            'new_department_id'        => 'nullable|exists:departments,id',
            'new_grade'                => 'nullable|string|max:50',
            'new_officelocation_id'    => 'nullable|exists:office_locations,id',
            'promotion_reason'         => 'nullable|string',
            'remarks'                  => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Get Current Employee
            |--------------------------------------------------------------------------
            */

            $employee = Employee::findOrFail($request->employee_id);

            //dd($employee);
            /*
            |--------------------------------------------------------------------------
            | Store Current Information Before Updating Employee
            |--------------------------------------------------------------------------
            */

            $previousDesignation = $employee->desig_id;
            $previousDepartment  = $employee->dept_id;
            $previousGrade       = $employee->grade;
            $previousOffice      = $employee->office_loc_id;

            //dd($previousOffice);
            /*
            |--------------------------------------------------------------------------
            | Create Promotion History
            |--------------------------------------------------------------------------
            */

            EmployeePromotionHistory::create([

                'employee_id' => $employee->id,

                // Previous Information
                'previous_designation_id' => $previousDesignation,
                'previous_department_id'  => $previousDepartment,
                'previous_grade'          => $previousGrade,
                'previous_office_location_id' => $previousOffice,

                // Promotion Information
                'promotion_type' => $request->promotion_type,
                'effective_date' => $request->effective_date,

                // Year from Effective Date
                'year' => \Carbon\Carbon::parse($request->effective_date)->year,

                // New Information
                'new_designation_id' => $request->new_designation_id,
                'new_department_id'  => $request->new_department_id,
                'new_grade'         => $request->new_grade,
                'new_office_location_id' => $request->new_officelocation_id,

                'promotion_reason' => $request->promotion_reason,
                'remarks'          => $request->remarks,

                'created_at' => now(),
                'updated_at' => now(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | Update Employee Current Information
            |--------------------------------------------------------------------------
            */

            $employee->update([

                'desig_id'     => $request->new_designation_id,

                'dept_id'      => $request->new_department_id,

                'grade'        => $request->new_grade,

                'office_loc_id' => $request->new_officelocation_id,

            ]);

            
            /*
            |--------------------------------------------------------------------------
            | Commit Transaction
            |--------------------------------------------------------------------------
            */

            DB::commit();


            return redirect()
                ->route('employee-promotion-history.create')
                ->with('success', 'Employee promotion details saved successfully.');


        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | Rollback If Any Error Occurs
            |--------------------------------------------------------------------------
            */

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Promotion details were not saved.');

        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function PromotionListdownload()
    {
        return Excel::download(
            new EmployeePromotionListExport(),
            'EmployeePromotionList.xlsx'
        );
    }
}
