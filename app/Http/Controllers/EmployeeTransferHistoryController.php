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
use Carbon\Carbon;
use App\Traits\PhpExcelFormater;


class EmployeeTransferHistoryController extends Controller
{
    use PhpExcelFormater;
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
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'employee_id' => 'required|exists:employees,id',

            'promotion_type' => 'required|string|max:100',

            'effective_date' => 'required|date',

            'new_designation_id' => 'required|exists:designations,id',

            'new_department_id' => 'nullable|exists:departments,id',

            'new_grade' => 'nullable|string|max:50',

            'new_office_location_id' => 'nullable|exists:office_locations,id',

            'new_reporting_to' => 'nullable|exists:employees,id',

            'promotion_reason' => 'nullable|string',

            'transfer_type' => 'nullable|string|max:100',

            'transfer_reason' => 'nullable|string',

            'remarks' => 'nullable|string',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Start Database Transaction
        |--------------------------------------------------------------------------
        */

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
            | Store Previous Employee Information
            |--------------------------------------------------------------------------
            */

            $previousDesignation = $employee->desig_id;
            $previousDepartment  = $employee->dept_id;
            $previousGrade       = $employee->grade;
            $previousOffice      = $employee->office_loc_id;
            $previousReportingTo = $employee->reporting_to;


            /*
            |--------------------------------------------------------------------------
            | Check Promotion Type
            |--------------------------------------------------------------------------
            */

            $isPromotionWithTransfer =
                $request->promotion_type === 'Promotion with Transfer';


            /*
            |--------------------------------------------------------------------------
            | 1. INSERT INTO EMPLOYEE PROMOTION HISTORY
            |--------------------------------------------------------------------------
            */

            EmployeePromotionHistory::create([

                'employee_id' => $employee->id,

                /*
                |--------------------------------------------------------------------------
                | Previous Information
                |--------------------------------------------------------------------------
                */

                'previous_designation_id' =>
                    $previousDesignation,

                'previous_department_id' =>
                    $previousDepartment,

                'previous_grade' =>
                    $previousGrade,

                'previous_office_location_id' =>
                    $previousOffice,


                /*
                |--------------------------------------------------------------------------
                | Promotion Information
                |--------------------------------------------------------------------------
                */

                'promotion_type' =>
                    $request->promotion_type,

                'effective_date' =>
                    $request->effective_date,

                'year' =>
                    \Carbon\Carbon::parse(
                        $request->effective_date
                    )->year,


                /*
                |--------------------------------------------------------------------------
                | New Information
                |--------------------------------------------------------------------------
                */

                'new_designation_id' =>
                    $request->new_designation_id,

                'new_department_id' =>
                    $request->new_department_id,

                'new_grade' =>
                    $request->new_grade,

                'new_office_location_id' =>
                    $request->new_office_location_id,


                /*
                |--------------------------------------------------------------------------
                | Promotion Reason & Remarks
                |--------------------------------------------------------------------------
                */

                'promotion_reason' =>
                    $request->promotion_reason,

                'remarks' =>
                    $request->remarks,
            ]);


            /*
            |--------------------------------------------------------------------------
            | 2. IF PROMOTION WITH TRANSFER
            |    INSERT INTO EMPLOYEE TRANSFER HISTORY
            |--------------------------------------------------------------------------
            */

            if ($isPromotionWithTransfer) {

                EmployeeTransferHistory::create([

                    'employee_id' =>
                        $employee->id,


                    /*
                    |--------------------------------------------------------------------------
                    | Previous Information
                    |--------------------------------------------------------------------------
                    */

                    'previous_department_id' =>
                        $previousDepartment,

                    'previous_office_location_id' =>
                        $previousOffice,

                    'previous_reporting_to' =>
                        $previousReportingTo,


                    /*
                    |--------------------------------------------------------------------------
                    | Transfer Information
                    |--------------------------------------------------------------------------
                    */

                    'transfer_type' =>
                        $request->transfer_type
                        ?? 'Promotion with Transfer',

                    'effective_date' =>
                        $request->effective_date,


                    /*
                    |--------------------------------------------------------------------------
                    | New Information
                    |--------------------------------------------------------------------------
                    */

                    'new_department_id' =>
                        $request->new_department_id,

                    'new_office_location_id' =>
                        $request->new_office_location_id,

                    'new_reporting_to' =>
                        $request->new_reporting_to,


                    /*
                    |--------------------------------------------------------------------------
                    | Transfer Reason & Remarks
                    |--------------------------------------------------------------------------
                    */

                    'transfer_reason' =>
                        $request->transfer_reason
                        ?? $request->promotion_reason,

                    'remarks' =>
                        $request->remarks,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | 3. UPDATE EMPLOYEE MASTER INFORMATION
            |--------------------------------------------------------------------------
            */

            /*
            |--------------------------------------------------------------------------
            | Designation
            |--------------------------------------------------------------------------
            */

            $employee->desig_id =
                $request->new_designation_id;


            /*
            |--------------------------------------------------------------------------
            | Grade
            |--------------------------------------------------------------------------
            */

            $employee->grade =
                $request->new_grade;


            /*
            |--------------------------------------------------------------------------
            | Department
            |--------------------------------------------------------------------------
            */

            if ($request->filled('new_department_id')) {

                $employee->dept_id =
                    $request->new_department_id;
            }


            /*
            |--------------------------------------------------------------------------
            | Office Location
            |--------------------------------------------------------------------------
            */

            if ($request->filled('new_office_location_id')) {

                $employee->office_loc_id =
                    $request->new_office_location_id;
            }


            /*
            |--------------------------------------------------------------------------
            | Reporting To
            |
            | Only Promotion with Transfer হলে update হবে
            |--------------------------------------------------------------------------
            */

            if (
                $isPromotionWithTransfer &&
                $request->filled('new_reporting_to')
            ) {

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


            /*
            |--------------------------------------------------------------------------
            | Success Message
            |--------------------------------------------------------------------------
            */

            if ($isPromotionWithTransfer) {

                return redirect()
                    ->route('employee-promotion-history.create')
                    ->with(
                        'success',
                        'Employee promotion and transfer details saved successfully.'
                    );
            }


            return redirect()
                ->route('employee-promotion-history.create')
                ->with(
                    'success',
                    'Employee promotion details saved successfully.'
                );


        } catch (\Exception $e) {

            /*
            |--------------------------------------------------------------------------
            | Rollback Transaction
            |--------------------------------------------------------------------------
            */

            DB::rollBack();


            /*
            |--------------------------------------------------------------------------
            | Error Message
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Failed to save employee promotion details. '
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

    public function uploadTransfer(Request $request)
    {
        ini_set('max_execution_time', 60000);

        if ($request->isMethod('post')) {

            /*
            |--------------------------------------------------------------------------
            | Validate File
            |--------------------------------------------------------------------------
            */

            $request->validate([
                'file' => 'required|mimes:xlsx|max:1024',
            ]);

            $file = $request->file('file');


            /*
            |--------------------------------------------------------------------------
            | Read Excel
            |--------------------------------------------------------------------------
            */

            $excelSheets = \Maatwebsite\Excel\Facades\Excel::toArray([], $file);

            $rows = $excelSheets[0] ?? [];

            if (empty($rows)) {

                return redirect()
                    ->back()
                    ->with(
                        'flash_danger',
                        'Excel file is empty.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | Header Row
            |--------------------------------------------------------------------------
            */

            $headers = array_map(function ($header) {

                return strtolower(
                    trim(
                        str_replace(' ', '_', $header ?? '')
                    )
                );

            }, array_shift($rows));


            /*
            |--------------------------------------------------------------------------
            | Convert Excel Rows To Associative Array
            |--------------------------------------------------------------------------
            */

            $excelDataArray = [];

            foreach ($rows as $row) {

                if (count(array_filter($row)) === 0) {
                    continue;
                }

                $excelDataArray[] = array_combine(
                    $headers,
                    array_pad(
                        $row,
                        count($headers),
                        null
                    )
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Master Data
            |--------------------------------------------------------------------------
            */

            $departmentList = Department::pluck('name', 'id');

            $officeLocationList = OfficeLocation::pluck('name', 'id');


            /*
            |--------------------------------------------------------------------------
            | Employee List
            |
            | Polar ID => Employee ID
            |--------------------------------------------------------------------------
            */

            $employeeList = Employee::pluck('id', 'polar_id');


            /*
            |--------------------------------------------------------------------------
            | Data Array
            |--------------------------------------------------------------------------
            */

            $dataArray = [];


            /*
            |--------------------------------------------------------------------------
            | Duplicate Tracker
            |--------------------------------------------------------------------------
            */

            $processed = [];


            /*
            |--------------------------------------------------------------------------
            | Counters
            |--------------------------------------------------------------------------
            */

            $duplicateCount = 0;
            $invalidEmployeeCount = 0;
            $insertCount = 0;


            /*
            |--------------------------------------------------------------------------
            | Process Excel Rows
            |--------------------------------------------------------------------------
            */

            foreach ($excelDataArray as $key => $value) {

                /*
                |--------------------------------------------------------------------------
                | Skip Empty Row
                |--------------------------------------------------------------------------
                */

                if (
                    empty($value['polar_id']) &&
                    empty($value['employee_name'])
                ) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Employee
                |--------------------------------------------------------------------------
                */

                $polarId = trim(
                    (string) ($value['polar_id'] ?? '')
                );

                $employeeId = $employeeList->get($polarId);


                /*
                |--------------------------------------------------------------------------
                | Employee Not Found
                |--------------------------------------------------------------------------
                */

                if (!$employeeId) {

                    $invalidEmployeeCount++;

                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Previous Department
                |--------------------------------------------------------------------------
                */

                $previousDepartmentId = null;

                if (!empty($value['previous_department'])) {

                    $previousDepartmentName = trim(
                        html_entity_decode(
                            $value['previous_department']
                        )
                    );

                    $previousDepartmentId = $departmentList->search(
                        $previousDepartmentName
                    );

                    if ($previousDepartmentId === false) {
                        $previousDepartmentId = null;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | New Department
                |--------------------------------------------------------------------------
                */

                $newDepartmentId = null;

                if (!empty($value['new_department'])) {

                    $newDepartmentName = trim(
                        html_entity_decode(
                            $value['new_department']
                        )
                    );

                    $newDepartmentId = $departmentList->search(
                        $newDepartmentName
                    );

                    if ($newDepartmentId === false) {
                        $newDepartmentId = null;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Previous Office Location
                |--------------------------------------------------------------------------
                */

                $previousOfficeLocationId = null;

                if (!empty($value['previous_office_location'])) {

                    $previousOfficeLocationName = trim(
                        html_entity_decode(
                            $value['previous_office_location']
                        )
                    );

                    $previousOfficeLocationId =
                        $officeLocationList->search(
                            $previousOfficeLocationName
                        );

                    if ($previousOfficeLocationId === false) {
                        $previousOfficeLocationId = null;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | New Office Location
                |--------------------------------------------------------------------------
                */

                $newOfficeLocationId = null;

                if (!empty($value['new_office_location'])) {

                    $newOfficeLocationName = trim(
                        html_entity_decode(
                            $value['new_office_location']
                        )
                    );

                    $newOfficeLocationId =
                        $officeLocationList->search(
                            $newOfficeLocationName
                        );

                    if ($newOfficeLocationId === false) {
                        $newOfficeLocationId = null;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Previous Reporting To
                |
                | Excel:
                | Previous Reporting Polar ID
                |
                | After header normalization:
                | previous_reporting_polar_id
                |
                | Database:
                | previous_reporting_to = employee_id
                |--------------------------------------------------------------------------
                */

                $previousReportingToId = null;

                $previousReportingPolarId = trim(
                    (string) (
                        $value['previous_reporting_polar_id']
                        ?? ''
                    )
                );

                if ($previousReportingPolarId !== '') {

                    $previousReportingToId = $employeeList->get(
                        $previousReportingPolarId
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | New Reporting To
                |
                | Excel:
                | New Reporting Polar ID
                |
                | After header normalization:
                | new_reporting_polar_id
                |
                | Database:
                | new_reporting_to = employee_id
                |--------------------------------------------------------------------------
                */

                $newReportingToId = null;

                $newReportingPolarId = trim(
                    (string) (
                        $value['new_reporting_polar_id']
                        ?? ''
                    )
                );

                if ($newReportingPolarId !== '') {

                    $newReportingToId = $employeeList->get(
                        $newReportingPolarId
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Effective Date
                |--------------------------------------------------------------------------
                */

                $effectiveDate = null;

                if (!empty($value['effective_date'])) {

                    try {

                        if (is_numeric($value['effective_date'])) {

                            $effectiveDate =
                                \PhpOffice\PhpSpreadsheet\Shared\Date::
                                excelToDateTimeObject(
                                    $value['effective_date']
                                )->format('Y-m-d');

                        } else {

                            $effectiveDate = Carbon::parse(
                                $value['effective_date']
                            )->format('Y-m-d');
                        }

                    } catch (\Exception $e) {

                        $effectiveDate = null;
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Transfer Type
                |--------------------------------------------------------------------------
                */

                $transferType = trim(
                    $value['transfer_type'] ?? ''
                );


                /*
                |--------------------------------------------------------------------------
                | Duplicate Key
                |
                | Employee + Effective Date + Transfer Type
                |--------------------------------------------------------------------------
                */

                $duplicateKey =
                    $employeeId .
                    '|' .
                    $effectiveDate .
                    '|' .
                    $transferType;


                /*
                |--------------------------------------------------------------------------
                | Duplicate In Same Excel
                |--------------------------------------------------------------------------
                */

                if (isset($processed[$duplicateKey])) {

                    $duplicateCount++;

                    continue;
                }

                $processed[$duplicateKey] = true;


                /*
                |--------------------------------------------------------------------------
                | Duplicate Already In Database
                |--------------------------------------------------------------------------
                */

                $exists = EmployeeTransferHistory::where(
                    'employee_id',
                    $employeeId
                )
                ->where(
                    'effective_date',
                    $effectiveDate
                )
                ->where(
                    'transfer_type',
                    $transferType
                )
                ->exists();


                if ($exists) {

                    $duplicateCount++;

                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Prepare Data
                |--------------------------------------------------------------------------
                */

                $data = [

                    'employee_id' =>
                        $employeeId,

                    'transfer_type' =>
                        $transferType,

                    'effective_date' =>
                        $effectiveDate,

                    'previous_department_id' =>
                        $previousDepartmentId,

                    'new_department_id' =>
                        $newDepartmentId,

                    'previous_reporting_to' =>
                        $previousReportingToId,

                    'new_reporting_to' =>
                        $newReportingToId,

                    'previous_office_location_id' =>
                        $previousOfficeLocationId,

                    'new_office_location_id' =>
                        $newOfficeLocationId,

                    'transfer_reason' =>
                        $value['transfer_reason'] ?? null,

                    'remarks' =>
                        $value['remarks'] ?? null,

                    'created_at' =>
                        Carbon::now(),

                    'updated_at' =>
                        Carbon::now(),
                ];


                /*
                |--------------------------------------------------------------------------
                | Add To Insert Array
                |--------------------------------------------------------------------------
                */

                $dataArray[] = $data;

                $insertCount++;
            }


            /*
            |--------------------------------------------------------------------------
            | Insert Data
            |--------------------------------------------------------------------------
            */

            if (!empty($dataArray)) {

                EmployeeTransferHistory::insert(
                    $dataArray
                );

                $message =
                    $insertCount .
                    " transfer record(s) imported successfully.";

                if ($duplicateCount > 0) {

                    $message .=
                        " " .
                        $duplicateCount .
                        " duplicate record(s) skipped.";
                }

                if ($invalidEmployeeCount > 0) {

                    $message .=
                        " " .
                        $invalidEmployeeCount .
                        " employee record(s) skipped because Polar ID was not found.";
                }

                return redirect()
                    ->route(
                        'employee-transfer-history.index'
                    )
                    ->with(
                        'flash_success',
                        $message
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | No New Data
            |--------------------------------------------------------------------------
            */

            $message =
                "No new transfer data found.";

            if ($duplicateCount > 0) {

                $message .=
                    " " .
                    $duplicateCount .
                    " duplicate record(s) were skipped.";
            }

            if ($invalidEmployeeCount > 0) {

                $message .=
                    " " .
                    $invalidEmployeeCount .
                    " employee record(s) were not found.";
            }

            return redirect()
                ->back()
                ->with(
                    'flash_danger',
                    $message
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GET
        |--------------------------------------------------------------------------
        */

        return view(
            'promotion_details.uploadTransfer'
        );
    }
}
