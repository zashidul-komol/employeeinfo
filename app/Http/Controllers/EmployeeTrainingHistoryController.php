<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeTransferHistory;
use App\Models\EmployeePromotionHistory;
use App\Models\EmployeeTrainingHistory;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Designation;
use App\Models\OfficeLocation;
use Illuminate\Support\Facades\DB;
use App\Exports\EmployeeTrainingListExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;



class EmployeeTrainingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = \App\Models\User::find(auth()->id());

        $Organization_id = $user->organization_id;

        $trainings = EmployeeTrainingHistory::with([
            'employee:id,name,polar_id',
        ])
        ->whereHas('employee', function ($q) use ($Organization_id) {
            $q->where('organization_id', $Organization_id);
        })
        ->orderBy('employee_id', 'ASC')
        ->orderBy('start_date', 'ASC')
        ->get();

        return view(
            'promotion_details.training',
            compact('trainings')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'employee_id'       => 'required|exists:employees,id',

            'training_name'     => 'required|string|max:255',
            'training_type'     => 'required|string|max:255',
            'training_provider' => 'required|string|max:255',

            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',

            'duration'          => 'required|string|max:100',

            'training_location' => 'required|string|max:255',

            'certificate'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

            'status'            => 'nullable|string|max:100',
            'remarks'           => 'nullable|string',
        ]);


        // ==============================
        // Prepare Data
        // ==============================

        $data = [
            'employee_id'       => $request->employee_id,
            'training_name'     => $request->training_name,
            'training_type'     => $request->training_type,
            'training_provider' => $request->training_provider,
            'start_date'        => $request->start_date,
            'end_date'          => $request->end_date,
            'duration'          => $request->duration,
            'training_location' => $request->training_location,
            'status'            => $request->status,
            'remarks'           => $request->remarks,
        ];


        // ==============================
        // Certificate Upload
        // ==============================

        if ($request->hasFile('certificate')) {

            $file = $request->file('certificate');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                'training_certificates',
                $fileName,
                'public'
            );

            $data['certificate_path'] = $path;
        }
        //dd('komol');

        // ==============================
        // Save Training History
        // ==============================

        EmployeeTrainingHistory::create($data);

        //dd('Saved');
        return redirect()
            ->route('employee-promotion-history.create')
            ->with(
                'success',
                'Employee training details saved successfully.'
            );
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

    public function TrainingListDownload()
    {
        return Excel::download(
            new EmployeeTrainingListExport(),
            'EmployeeTrainingList.xlsx'
        );
    }

    public function uploadTraining(Request $request)
    {
        ini_set('max_execution_time', 60000);

        /*
        |--------------------------------------------------------------------------
        | GET
        |--------------------------------------------------------------------------
        */

        if (!$request->isMethod('post')) {

            return view('promotion_details.uploadTraining');
        }


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


            $row = array_pad(
                $row,
                count($headers),
                null
            );


            $row = array_slice(
                $row,
                0,
                count($headers)
            );


            $excelDataArray[] = array_combine(
                $headers,
                $row
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Employee List
        |
        | Polar ID => Employee ID
        |--------------------------------------------------------------------------
        */

        $employeeList = Employee::pluck(
            'id',
            'polar_id'
        );


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

        $invalidDataCount = 0;

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
            | Polar ID
            |--------------------------------------------------------------------------
            */

            $polarId = trim(
                (string) ($value['polar_id'] ?? '')
            );


            /*
            |--------------------------------------------------------------------------
            | Find Employee
            |--------------------------------------------------------------------------
            */

            $employeeId = $employeeList->get(
                $polarId
            );


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
            | Training Name
            |--------------------------------------------------------------------------
            */

            $trainingName = trim(
                (string) ($value['training_name'] ?? '')
            );


            /*
            |--------------------------------------------------------------------------
            | Training Name Required
            |--------------------------------------------------------------------------
            */

            if ($trainingName === '') {

                $invalidDataCount++;

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Start Date
            |--------------------------------------------------------------------------
            */

            $startDate = null;

            if (!empty($value['start_date'])) {

                try {

                    if (is_numeric($value['start_date'])) {

                        $startDate =
                            \PhpOffice\PhpSpreadsheet\Shared\Date::
                            excelToDateTimeObject(
                                $value['start_date']
                            )->format('Y-m-d');

                    } else {

                        $startDate = Carbon::parse(
                            $value['start_date']
                        )->format('Y-m-d');
                    }

                } catch (\Exception $e) {

                    $startDate = null;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | End Date
            |--------------------------------------------------------------------------
            */

            $endDate = null;

            if (!empty($value['end_date'])) {

                try {

                    if (is_numeric($value['end_date'])) {

                        $endDate =
                            \PhpOffice\PhpSpreadsheet\Shared\Date::
                            excelToDateTimeObject(
                                $value['end_date']
                            )->format('Y-m-d');

                    } else {

                        $endDate = Carbon::parse(
                            $value['end_date']
                        )->format('Y-m-d');
                    }

                } catch (\Exception $e) {

                    $endDate = null;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Training Type
            |--------------------------------------------------------------------------
            */

            $trainingType = trim(
                (string) ($value['training_type'] ?? '')
            );


            /*
            |--------------------------------------------------------------------------
            | Training Provider
            |--------------------------------------------------------------------------
            */

            $trainingProvider = trim(
                (string) ($value['training_provider'] ?? '')
            );


            /*
            |--------------------------------------------------------------------------
            | Duration
            |--------------------------------------------------------------------------
            */

            $duration = trim(
                (string) ($value['duration'] ?? '')
            );


            /*
            |--------------------------------------------------------------------------
            | Training Location
            |--------------------------------------------------------------------------
            */

            $trainingLocation = trim(
                (string) ($value['training_location'] ?? '')
            );


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $status = trim(
                (string) ($value['status'] ?? '')
            );


            /*
            |--------------------------------------------------------------------------
            | Certificate
            |--------------------------------------------------------------------------
            */

            $certificatePath = trim(
                (string) ($value['certificate'] ?? '')
            );


            if ($certificatePath === '') {

                $certificatePath = null;
            }


            /*
            |--------------------------------------------------------------------------
            | Remarks
            |--------------------------------------------------------------------------
            */

            $remarks = $value['remarks'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | Duplicate Key
            |
            | Employee + Training Name + Start Date + End Date
            |--------------------------------------------------------------------------
            */

            $duplicateKey =
                $employeeId .
                '|' .
                strtolower($trainingName) .
                '|' .
                $startDate .
                '|' .
                $endDate;


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

            $exists = EmployeeTrainingHistory::where(
                'employee_id',
                $employeeId
            )
            ->where(
                'training_name',
                $trainingName
            )
            ->where(
                'start_date',
                $startDate
            )
            ->where(
                'end_date',
                $endDate
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

            $dataArray[] = [

                'employee_id' =>
                    $employeeId,

                'training_name' =>
                    $trainingName,

                'training_type' =>
                    $trainingType !== ''
                        ? $trainingType
                        : null,

                'training_provider' =>
                    $trainingProvider !== ''
                        ? $trainingProvider
                        : null,

                'start_date' =>
                    $startDate,

                'end_date' =>
                    $endDate,

                'duration' =>
                    $duration !== ''
                        ? $duration
                        : null,

                'training_location' =>
                    $trainingLocation !== ''
                        ? $trainingLocation
                        : null,

                'certificate_path' =>
                    $certificatePath,

                'status' =>
                    $status !== ''
                        ? $status
                        : null,

                'remarks' =>
                    $remarks,

                'created_at' =>
                    Carbon::now(),

                'updated_at' =>
                    Carbon::now(),
            ];


            $insertCount++;
        }


        /*
        |--------------------------------------------------------------------------
        | Insert Data
        |--------------------------------------------------------------------------
        */

        if (!empty($dataArray)) {

            EmployeeTrainingHistory::insert(
                $dataArray
            );


            $message =
                $insertCount .
                " training record(s) imported successfully.";


            /*
            |--------------------------------------------------------------------------
            | Duplicate Message
            |--------------------------------------------------------------------------
            */

            if ($duplicateCount > 0) {

                $message .=
                    " " .
                    $duplicateCount .
                    " duplicate record(s) skipped.";
            }


            /*
            |--------------------------------------------------------------------------
            | Invalid Employee Message
            |--------------------------------------------------------------------------
            */

            if ($invalidEmployeeCount > 0) {

                $message .=
                    " " .
                    $invalidEmployeeCount .
                    " employee record(s) skipped because Polar ID was not found.";
            }


            /*
            |--------------------------------------------------------------------------
            | Invalid Data Message
            |--------------------------------------------------------------------------
            */

            if ($invalidDataCount > 0) {

                $message .=
                    " " .
                    $invalidDataCount .
                    " invalid training record(s) skipped.";
            }


            return redirect()
                ->route(
                    'employee-training-history.index'
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
            "No new training data found.";


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


        if ($invalidDataCount > 0) {

            $message .=
                " " .
                $invalidDataCount .
                " invalid training record(s) were found.";
        }


        return redirect()
            ->back()
            ->with(
                'flash_danger',
                $message
            );
    }
}
