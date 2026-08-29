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
use App\Models\EmployeeTransferHistory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeePromotionListExport;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
        $user = \App\Models\User::find(auth()->id());

        $Organization_id = $user->organization_id;
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

            'new_office_location_id' =>
                'nullable|exists:office_locations,id',

            'new_reporting_to' =>
                'nullable|exists:employees,id',

            'promotion_reason' =>
                'nullable|string',

            'transfer_type' =>
                'nullable|string|max:100',

            'transfer_reason' =>
                'nullable|string',

            'remarks' =>
                'nullable|string',
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

            $employee = Employee::findOrFail(
                $request->employee_id
            );


            /*
            |--------------------------------------------------------------------------
            | Store Previous Employee Information
            |--------------------------------------------------------------------------
            */

            $previousDesignation =
                $employee->desig_id;

            $previousDepartment =
                $employee->dept_id;

            $previousGrade =
                $employee->grade;

            $previousOffice =
                $employee->office_loc_id;

            $previousReportingTo =
                $employee->reporting_to;

            $previousRegion =
                $employee->region_id;


            /*
            |--------------------------------------------------------------------------
            | Get New Office Location
            |--------------------------------------------------------------------------
            |
            | Office Location থেকে Region ID পাওয়া যাবে।
            |
            */

            $newRegionId = null;

            if ($request->filled('new_office_location_id')) {

                $newOfficeLocation =
                    \App\Models\OfficeLocation::find(
                        $request->new_office_location_id
                    );

                if (!$newOfficeLocation) {

                    throw new \Exception(
                        'Selected office location was not found.'
                    );
                }

                $newRegionId =
                    $newOfficeLocation->region_id;
            }


            /*
            |--------------------------------------------------------------------------
            | Check Promotion Type
            |--------------------------------------------------------------------------
            */

            $isPromotionWithTransfer =
                $request->promotion_type === 'Promotion with Transfer';


            /*
            |--------------------------------------------------------------------------
            | 1. INSERT PROMOTION HISTORY
            |--------------------------------------------------------------------------
            */

            EmployeePromotionHistory::create([

                'employee_id' => $employee->id,

                'previous_designation_id' => $previousDesignation,
                'previous_department_id' => $previousDepartment,
                'previous_grade' => $previousGrade,
                'previous_office_location_id' => $previousOffice,

                // IMPORTANT
                'previous_reporting_to' => $previousReportingTo,

                'promotion_type' => $request->promotion_type,

                'effective_date' => $request->effective_date,

                'year' => \Carbon\Carbon::parse(
                    $request->effective_date
                )->year,

                'new_designation_id' => $request->new_designation_id,

                'new_department_id' => $request->new_department_id,

                'new_grade' => $request->new_grade,

                'new_office_location_id' => $request->new_office_location_id,

                // IMPORTANT
                'new_reporting_to' => $request->new_reporting_to,

                'promotion_reason' => $request->promotion_reason,

                'remarks' => $request->remarks,
            ]);


            /*
            |--------------------------------------------------------------------------
            | 2. IF PROMOTION WITH TRANSFER
            |    INSERT TRANSFER HISTORY
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
                    | Reason & Remarks
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
            | 3. UPDATE EMPLOYEE MASTER
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

                /*
                |--------------------------------------------------------------------------
                | Region
                |--------------------------------------------------------------------------
                |
                | New Office Location-এর Region ID Employee master-এ update হবে।
                |
                */

                $employee->region_id =
                    $newRegionId;
            }


            /*
            |--------------------------------------------------------------------------
            | Reporting To
            |--------------------------------------------------------------------------
            |
            | শুধুমাত্র Promotion with Transfer হলে update হবে।
            |
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
                    ->route(
                        'employee-promotion-history.create'
                    )
                    ->with(
                        'success',
                        'Employee promotion and transfer details saved successfully.'
                    );
            }


            return redirect()
                ->route(
                    'employee-promotion-history.create'
                )
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

    public function PromotionListdownload()
    {
        return Excel::download(
            new EmployeePromotionListExport(),
            'EmployeePromotionList.xlsx'
        );
    }

    public function uploadPromotion(Request $request)
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

            $filePath = $file->getRealPath();

            /*
            |--------------------------------------------------------------------------
            | Excel To Array
            |--------------------------------------------------------------------------
            */

            $excelDataArray = $this->dumptoarray($filePath);


            /*
            |--------------------------------------------------------------------------
            | Master Data
            |--------------------------------------------------------------------------
            */

            $departmentList = Department::pluck('name', 'id');

            $designationList = Designation::pluck('title', 'id');

            $officeLocationList = OfficeLocation::pluck('name', 'id');


            /*
            |--------------------------------------------------------------------------
            | Employee List
            |
            | polar_id => employee_id
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
            | Prevent Duplicate Rows From Same Excel File
            |--------------------------------------------------------------------------
            */

            $processed = [];


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

                $polarId = trim($value['polar_id'] ?? '');

                $employeeId = $employeeList->get($polarId);


                /*
                |--------------------------------------------------------------------------
                | Employee Not Found
                |--------------------------------------------------------------------------
                */

                if (!$employeeId) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Previous Department
                |--------------------------------------------------------------------------
                */

                $previousDepartmentId = null;

                if (!empty($value['previous_department'])) {

                    $previousDepartmentId = $departmentList->search(
                        trim(
                            html_entity_decode(
                                $value['previous_department']
                            )
                        )
                    );

                    $previousDepartmentId =
                        $previousDepartmentId !== false
                            ? $previousDepartmentId
                            : null;
                }


                /*
                |--------------------------------------------------------------------------
                | New Department
                |--------------------------------------------------------------------------
                */

                $newDepartmentId = null;

                if (!empty($value['new_department'])) {

                    $newDepartmentId = $departmentList->search(
                        trim(
                            html_entity_decode(
                                $value['new_department']
                            )
                        )
                    );

                    $newDepartmentId =
                        $newDepartmentId !== false
                            ? $newDepartmentId
                            : null;
                }


                /*
                |--------------------------------------------------------------------------
                | Previous Designation
                |--------------------------------------------------------------------------
                */

                $previousDesignationId = null;

                if (!empty($value['previous_designation'])) {

                    $previousDesignationId = $designationList->search(
                        trim(
                            html_entity_decode(
                                $value['previous_designation']
                            )
                        )
                    );

                    $previousDesignationId =
                        $previousDesignationId !== false
                            ? $previousDesignationId
                            : null;
                }


                /*
                |--------------------------------------------------------------------------
                | New Designation
                |--------------------------------------------------------------------------
                */

                $newDesignationId = null;

                if (!empty($value['new_designation'])) {

                    $newDesignationId = $designationList->search(
                        trim(
                            html_entity_decode(
                                $value['new_designation']
                            )
                        )
                    );

                    $newDesignationId =
                        $newDesignationId !== false
                            ? $newDesignationId
                            : null;
                }


                /*
                |--------------------------------------------------------------------------
                | Previous Office Location
                |--------------------------------------------------------------------------
                */

                $previousOfficeLocationId = null;

                if (!empty($value['previous_office_location'])) {

                    $previousOfficeLocationId = $officeLocationList->search(
                        trim(
                            html_entity_decode(
                                $value['previous_office_location']
                            )
                        )
                    );

                    $previousOfficeLocationId =
                        $previousOfficeLocationId !== false
                            ? $previousOfficeLocationId
                            : null;
                }


                /*
                |--------------------------------------------------------------------------
                | New Office Location
                |--------------------------------------------------------------------------
                */

                $newOfficeLocationId = null;

                if (!empty($value['new_office_location'])) {

                    $newOfficeLocationId = $officeLocationList->search(
                        trim(
                            html_entity_decode(
                                $value['new_office_location']
                            )
                        )
                    );

                    $newOfficeLocationId =
                        $newOfficeLocationId !== false
                            ? $newOfficeLocationId
                            : null;
                }


                /*
                |--------------------------------------------------------------------------
                | Previous Reporting To
                |
                | Excel has Polar ID
                | Database needs Employee ID
                |--------------------------------------------------------------------------
                */

                $previousReportingToId = null;

                if (!empty($value['prev_reporting_to_polar_id'])) {

                    $previousReportingToId = $employeeList->get(
                        trim(
                            $value['prev_reporting_to_polar_id']
                        )
                    );
                }


                /*
                |--------------------------------------------------------------------------
                | New Reporting To
                |--------------------------------------------------------------------------
                */

                $newReportingToId = null;

                if (!empty($value['new_reporting_to_polar_id'])) {

                    $newReportingToId = $employeeList->get(
                        trim(
                            $value['new_reporting_to_polar_id']
                        )
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

                        /*
                        | Excel Serial Date
                        */

                        if (is_numeric($value['effective_date'])) {

                            $effectiveDate =
                                \PhpOffice\PhpSpreadsheet\Shared\Date::
                                excelToDateTimeObject(
                                    $value['effective_date']
                                )->format('Y-m-d');

                        } else {

                            /*
                            | Normal Date
                            */

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
                | Promotion Type
                |--------------------------------------------------------------------------
                */

                $promotionType = trim(
                    $value['promotion_type'] ?? ''
                );


                /*
                |--------------------------------------------------------------------------
                | Duplicate Key
                |
                | Employee + Effective Date + Promotion Type
                |--------------------------------------------------------------------------
                */

                $duplicateKey =
                    $employeeId .
                    '|' .
                    $effectiveDate .
                    '|' .
                    $promotionType;


                /*
                |--------------------------------------------------------------------------
                | Duplicate In Same Excel File
                |--------------------------------------------------------------------------
                */

                if (isset($processed[$duplicateKey])) {
                    continue;
                }

                $processed[$duplicateKey] = true;


                /*
                |--------------------------------------------------------------------------
                | Duplicate Already Exists In Database
                |--------------------------------------------------------------------------
                */

                $exists = EmployeePromotionHistory::where(
                    'employee_id',
                    $employeeId
                )
                ->where(
                    'effective_date',
                    $effectiveDate
                )
                ->where(
                    'promotion_type',
                    $promotionType
                )
                ->exists();


                if ($exists) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | Prepare Promotion Data
                |--------------------------------------------------------------------------
                */

                $data = [];

                $data['employee_id'] =
                    $employeeId;

                $data['year'] =
                    !empty($value['year'])
                        ? $value['year']
                        : (
                            $effectiveDate
                                ? Carbon::parse($effectiveDate)->year
                                : null
                        );

                $data['promotion_type'] =
                    $promotionType;

                $data['previous_department_id'] =
                    $previousDepartmentId;

                $data['new_department_id'] =
                    $newDepartmentId;

                $data['previous_designation_id'] =
                    $previousDesignationId;

                $data['new_designation_id'] =
                    $newDesignationId;

                $data['previous_grade'] =
                    $value['previous_grade'] ?? null;

                $data['new_grade'] =
                    $value['new_grade'] ?? null;

                $data['previous_office_location_id'] =
                    $previousOfficeLocationId;

                $data['new_office_location_id'] =
                    $newOfficeLocationId;

                $data['previous_reporting_to'] =
                    $previousReportingToId;

                $data['new_reporting_to'] =
                    $newReportingToId;

                $data['effective_date'] =
                    $effectiveDate;

                $data['promotion_reason'] =
                    $value['promotion_reason'] ?? null;

                $data['remarks'] =
                    $value['remarks'] ?? null;

                $data['created_at'] =
                    Carbon::now();

                $data['updated_at'] =
                    Carbon::now();


                /*
                |--------------------------------------------------------------------------
                | Add To Insert Array
                |--------------------------------------------------------------------------
                */

                $dataArray[] = $data;
            }


            /*
            |--------------------------------------------------------------------------
            | Insert Data
            |--------------------------------------------------------------------------
            */

            if (!empty($dataArray)) {

                EmployeePromotionHistory::insert($dataArray);

                $message =
                    "Successfully Uploaded";

                return redirect()
                    ->route('employee-promotion-history.index')
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
                "No new promotion data found. Duplicate records were skipped.";

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
            'promotion_details.uploadPromotions'
        );
    }

}
