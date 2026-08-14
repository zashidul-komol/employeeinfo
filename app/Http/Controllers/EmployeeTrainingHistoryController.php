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
}
