<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Employee;
use App\Models\EmployeeTransferHistory;
use App\Models\EmployeePromotionHistory;
use App\Models\Department;
use App\Models\OfficeLocation;
use App\Models\Designation;
use App\Exports\EmployeeTransferListExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeTransferHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = \App\Models\User::find(auth()->id());

        $Organization_id = $user->organization_id;

        $employees = EmployeeTransferHistory::with([
            'employee:id,name,polar_id',
            'previous_department:id,name',
            'new_department:id,name',
            'previous_office_location:id,name',
            'new_office_location:id,name',
            'previousReportingTo:id,name,polar_id',
            'newReportingTo:id,name,polar_id',
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
        | Calculate Transfer Duration
        |--------------------------------------------------------------------------
        */

        foreach ($employees as $employeeId => $employeeHistories) {

            $employeeHistories = $employeeHistories->values();

            foreach ($employeeHistories as $index => $data) {

                $nextTransfer = $employeeHistories->get($index + 1);

                $startDate = \Carbon\Carbon::parse($data->effective_date);

                if ($nextTransfer) {
                    $endDate = \Carbon\Carbon::parse(
                        $nextTransfer->effective_date
                    );
                } else {
                    $endDate = \Carbon\Carbon::now();
                }

                $duration = $startDate->diff($endDate);

                $data->transfer_duration = $duration;
            }

            $employees[$employeeId] = $employeeHistories;
        }

        return view(
            'promotion_details.transfer',
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
            'employee_id' => 'required|exists:employees,id',

            'previous_department_id' => 'nullable|exists:departments,id',
            'previous_office_location_id' => 'nullable|exists:office_locations,id',
            'previous_reporting_to' => 'nullable|exists:employees,id',

            'transfer_type' => 'required|string|max:100',
            'effective_date' => 'required|date',

            'new_department_id' => 'nullable|exists:departments,id',
            'new_office_location_id' => 'nullable|exists:office_locations,id',
            'new_reporting_to' => 'nullable|exists:employees,id',

            'transfer_reason' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Get Employee
            |--------------------------------------------------------------------------
            */

            $employee = Employee::findOrFail($request->employee_id);


            /*
            |--------------------------------------------------------------------------
            | Store Transfer History
            |--------------------------------------------------------------------------
            */

            $transfer = EmployeeTransferHistory::create([

                'employee_id' => $employee->id,

                // Previous Information
                'previous_department_id' =>
                    $employee->dept_id,

                'previous_office_location_id' =>
                    $employee->office_loc_id,

                'previous_reporting_to' =>
                    $employee->reporting_to,

                // Transfer Information
                'transfer_type' =>
                    $request->transfer_type,

                'effective_date' =>
                    $request->effective_date,

                // New Information
                'new_department_id' =>
                    $request->new_department_id,

                'new_office_location_id' =>
                    $request->new_office_location_id,

                'new_reporting_to' =>
                    $request->new_reporting_to,

                // Remarks
                'transfer_reason' =>
                    $request->transfer_reason,

                'remarks' =>
                    $request->remarks,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Update Employee Master Information
            |--------------------------------------------------------------------------
            */

            if ($request->filled('new_department_id')) {

                $employee->dept_id =
                    $request->new_department_id;
            }

            if ($request->filled('new_office_location_id')) {

                $employee->office_loc_id =
                    $request->new_office_location_id;
            }

            if ($request->filled('new_reporting_to')) {

                $employee->reporting_to =
                    $request->new_reporting_to;
            }


            /*
            |--------------------------------------------------------------------------
            | Save Employee
            |--------------------------------------------------------------------------
            */

            $employee->save();


            /*
            |--------------------------------------------------------------------------
            | Commit Transaction
            |--------------------------------------------------------------------------
            */

            DB::commit();


            return redirect()
                ->route('employee-transfer-history.create')
                ->with(
                    'success',
                    'Employee transfer details saved successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Failed to save employee transfer details. '
                    . $e->getMessage()
                );
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

    public function TransferListDownload()
    {
        return Excel::download(
            new EmployeeTransferListExport(),
            'EmployeeTransferList.xlsx'
        );
    }
}
