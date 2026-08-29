@extends('layouts.admin')

@section('title', 'Employee Promotion / Transfer / Training')

@section('content')

<div class="container-fluid">

    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade in" role="alert">

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

            <i class="fa fa-check-circle"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =========================================================
         ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade in" role="alert">

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

            <i class="fa fa-exclamation-circle"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- =========================================================
         COMMON EMPLOYEE INFORMATION
    ========================================================== --}}

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <h4 class="panel-title">

                        <i class="fa fa-user"></i>

                        Employee Information

                    </h4>

                </div>


                <div class="panel-body">

                    <div class="row">


                        {{-- Employee --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="employee_id">

                                    Employee

                                    <span class="text-danger">*</span>

                                </label>


                                <select id="employee_id"
                                        class="form-control select2"
                                        required>

                                    <option value="">
                                        Select Employee
                                    </option>


                                    @foreach($employeesName as $employee)

                                        <option value="{{ $employee->id }}"

                                            data-polar-id="{{ $employee->polar_id }}"

                                            data-designation-id="{{ $employee->desig_id }}"

                                            data-department-id="{{ $employee->dept_id }}"

                                            data-office-location-id="{{ $employee->office_loc_id }}"

                                            data-reporting-to="{{ $employee->reporting_to }}"

                                            data-designation="{{ optional($employee->designation)->title }}"

                                            data-department="{{ optional($employee->department)->name }}"

                                            data-office-location="{{ optional($employee->office_location)->name }}"

                                            data-grade="{{ $employee->grade ?? '' }}">

                                            {{ $employee->name }}
                                            -
                                            {{ $employee->polar_id }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- Polar ID --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="polar_id">
                                    Polar ID
                                </label>

                                <input type="text"
                                       id="polar_id"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>


                        {{-- Current Designation --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="previous_designation">
                                    Current Designation
                                </label>

                                <input type="text"
                                       id="previous_designation"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>


                        {{-- Current Department --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="previous_department">
                                    Current Department
                                </label>

                                <input type="text"
                                       id="previous_department"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>


                        {{-- Current Grade --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="previous_grade">
                                    Current Grade
                                </label>

                                <input type="text"
                                       id="previous_grade"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>


                        {{-- Current Office Location --}}
                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="previous_office_location">
                                    Current Office Location
                                </label>

                                <input type="text"
                                       id="previous_office_location"
                                       class="form-control"
                                       readonly>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
         TABS
    ========================================================== --}}

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-body">


                    {{-- TAB MENU --}}

                    <ul class="nav nav-tabs">

                        <li class="active">

                            <a href="#promotion_tab"
                               data-toggle="tab">

                                <i class="fa fa-line-chart"></i>

                                Promotion Details

                            </a>

                        </li>


                        <li>

                            <a href="#transfer_tab"
                               data-toggle="tab">

                                <i class="fa fa-exchange"></i>

                                Transfer Details

                            </a>

                        </li>


                        <li>

                            <a href="#training_tab"
                               data-toggle="tab">

                                <i class="fa fa-graduation-cap"></i>

                                Training Details

                            </a>

                        </li>

                    </ul>



                    <div class="tab-content">


                        {{-- =================================================
                             PROMOTION TAB
                        ================================================== --}}

                        <div class="tab-pane active"
                             id="promotion_tab">

                            <div class="tab-form-container">


                                <form method="POST"
                                      action="{{ route('employee-promotion-history.store') }}"
                                      id="promotionForm">

                                    @csrf


                                    {{-- Employee ID --}}
                                    <input type="hidden"
                                           name="employee_id"
                                           id="promotion_employee_id">


                                    <div class="row">


                                        <div class="col-md-12">

                                            <h4 class="section-title">

                                                Promotion Information

                                            </h4>

                                        </div>


                                        {{-- Promotion Type --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="promotion_type">

                                                    Promotion Type

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <select name="promotion_type"
                                                        id="promotion_type"
                                                        class="form-control"
                                                        required>

                                                    <option value="">
                                                        Select Type
                                                    </option>

                                                    <option value="Promotion">
                                                        Promotion
                                                    </option>

                                                    <option value="Re-designation">
                                                        Re-designation
                                                    </option>

                                                    <option value="Grade Change">
                                                        Grade Change
                                                    </option>

                                                    <option value="Promotion with Transfer">
                                                        Promotion with Transfer
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Effective Date --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="effective_date">

                                                    Effective Date

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="date"
                                                       name="effective_date"
                                                       id="effective_date"
                                                       class="form-control"
                                                       required>

                                            </div>

                                        </div>


                                        {{-- New Designation --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="new_designation_id">

                                                    New Designation

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <select name="new_designation_id"
                                                        id="new_designation_id"
                                                        class="form-control select2"
                                                        required>

                                                    <option value="">
                                                        Select Designation
                                                    </option>


                                                    @foreach($designations as $id => $title)

                                                        <option value="{{ $id }}">

                                                            {{ $title }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- New Department --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="new_department_id">

                                                    New Department

                                                </label>


                                                <select name="new_department_id"
                                                        id="new_department_id"
                                                        class="form-control select2">

                                                    <option value="">
                                                        Select Department
                                                    </option>


                                                    @foreach($departments as $id => $name)

                                                        <option value="{{ $id }}">

                                                            {{ $name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- New Grade --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="new_grade">
                                                    New Grade
                                                </label>


                                                <input type="text"
                                                       name="new_grade"
                                                       id="new_grade"
                                                       class="form-control">

                                            </div>

                                        </div>


                                        {{-- New Office Location --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="new_office_location_id">

                                                    New Office Location

                                                </label>


                                                <select name="new_office_location_id"
                                                        id="new_office_location_id"
                                                        class="form-control select2">

                                                    <option value="">
                                                        Select Office Location
                                                    </option>


                                                    @foreach($office_locations as $id => $name)

                                                        <option value="{{ $id }}">

                                                            {{ $name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- New Reporting To --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="promotion_new_reporting_to">

                                                    New Reporting To

                                                </label>


                                                <select name="new_reporting_to"
                                                        id="promotion_new_reporting_to"
                                                        class="form-control select2">

                                                    <option value="">
                                                        Select Reporting To
                                                    </option>


                                                    @foreach($employeesName as $reportingEmployee)

                                                        <option value="{{ $reportingEmployee->id }}">

                                                            {{ $reportingEmployee->name }}
                                                            -
                                                            {{ $reportingEmployee->polar_id }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Promotion Reason --}}
                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="promotion_reason">

                                                    Promotion Reason

                                                </label>


                                                <textarea name="promotion_reason"
                                                          id="promotion_reason"
                                                          class="form-control"
                                                          rows="2"></textarea>

                                            </div>

                                        </div>


                                        {{-- Remarks --}}
                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="promotion_remarks">

                                                    Remarks

                                                </label>


                                                <textarea name="remarks"
                                                          id="promotion_remarks"
                                                          class="form-control"
                                                          rows="2"></textarea>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- Promotion Buttons --}}

                                    <div class="row">

                                        <div class="col-md-12 text-right">


                                            <a href="{{ route('employee-promotion-history.index') }}"
                                               class="btn btn-default">

                                                <i class="fa fa-arrow-left"></i>

                                                Back

                                            </a>


                                            <button type="reset"
                                                    class="btn btn-warning">

                                                <i class="fa fa-refresh"></i>

                                                Reset

                                            </button>


                                            <button type="submit"
                                                    class="btn btn-primary">

                                                <i class="fa fa-save"></i>

                                                Save Promotion

                                            </button>

                                        </div>

                                    </div>


                                </form>

                            </div>

                        </div>



                        {{-- =================================================
                             TRANSFER TAB
                        ================================================== --}}

                        <div class="tab-pane"
                             id="transfer_tab">

                            <div class="tab-form-container">


                                <form method="POST"
                                      action="{{ route('employee-transfer-history.store') }}"
                                      id="transferForm">

                                    @csrf


                                    {{-- Employee ID --}}
                                    <input type="hidden"
                                           name="employee_id"
                                           id="transfer_employee_id">


                                    <div class="row">


                                        <div class="col-md-12">

                                            <h4 class="section-title">

                                                Transfer Information

                                            </h4>

                                        </div>


                                        {{-- Transfer Type --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="transfer_type">

                                                    Transfer Type

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <select name="transfer_type"
                                                        id="transfer_type"
                                                        class="form-control"
                                                        required>

                                                    <option value="">
                                                        Select Type
                                                    </option>

                                                    <option value="Transfer">
                                                        Transfer
                                                    </option>

                                                    <option value="Internal Transfer">
                                                        Internal Transfer
                                                    </option>

                                                    <option value="Temporary Transfer">
                                                        Temporary Transfer
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Effective Date --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="transfer_effective_date">

                                                    Effective Date

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="date"
                                                       name="effective_date"
                                                       id="transfer_effective_date"
                                                       class="form-control"
                                                       required>

                                            </div>

                                        </div>


                                        {{-- New Department --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="transfer_department_id">

                                                    New Department

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <select name="new_department_id"
                                                        id="transfer_department_id"
                                                        class="form-control select2"
                                                        required>

                                                    <option value="">
                                                        Select Department
                                                    </option>


                                                    @foreach($departments as $id => $name)

                                                        <option value="{{ $id }}">

                                                            {{ $name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- New Office Location --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="transfer_office_location_id">

                                                    New Office Location

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <select name="new_office_location_id"
                                                        id="transfer_office_location_id"
                                                        class="form-control select2"
                                                        required>

                                                    <option value="">
                                                        Select Office Location
                                                    </option>


                                                    @foreach($office_locations as $id => $name)

                                                        <option value="{{ $id }}">

                                                            {{ $name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- New Reporting To --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="transfer_new_reporting_to">

                                                    New Reporting To

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <select name="new_reporting_to"
                                                        id="transfer_new_reporting_to"
                                                        class="form-control select2"
                                                        required>

                                                    <option value="">
                                                        Select Reporting To
                                                    </option>


                                                    @foreach($employeesName as $reportingEmployee)

                                                        <option value="{{ $reportingEmployee->id }}">

                                                            {{ $reportingEmployee->name }}
                                                            -
                                                            {{ $reportingEmployee->polar_id }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Transfer Reason --}}
                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="transfer_reason">

                                                    Transfer Reason

                                                </label>


                                                <textarea name="transfer_reason"
                                                          id="transfer_reason"
                                                          class="form-control"
                                                          rows="3"></textarea>

                                            </div>

                                        </div>


                                        {{-- Remarks --}}
                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="transfer_remarks">

                                                    Remarks

                                                </label>


                                                <textarea name="remarks"
                                                          id="transfer_remarks"
                                                          class="form-control"
                                                          rows="3"></textarea>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- Transfer Buttons --}}

                                    <div class="row">

                                        <div class="col-md-12 text-right">


                                            <a href="{{ route('employee-transfer-history.index') }}"
                                               class="btn btn-default">

                                                <i class="fa fa-arrow-left"></i>

                                                Back

                                            </a>


                                            <button type="reset"
                                                    class="btn btn-warning">

                                                <i class="fa fa-refresh"></i>

                                                Reset

                                            </button>


                                            <button type="submit"
                                                    class="btn btn-primary">

                                                <i class="fa fa-save"></i>

                                                Save Transfer

                                            </button>

                                        </div>

                                    </div>


                                </form>

                            </div>

                        </div>



                        {{-- =================================================
                             TRAINING TAB
                        ================================================== --}}

                        <div class="tab-pane"
                             id="training_tab">

                            <div class="tab-form-container">


                                <form method="POST"
                                      action="{{ route('employee-training-history.store') }}"
                                      id="trainingForm"
                                      enctype="multipart/form-data">

                                    @csrf


                                    {{-- Employee ID --}}
                                    <input type="hidden"
                                           name="employee_id"
                                           id="training_employee_id">


                                    <div class="row">


                                        <div class="col-md-12">

                                            <h4 class="section-title">

                                                Training Information

                                            </h4>

                                        </div>


                                        {{-- Training Name --}}
                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="training_name">

                                                    Training Name

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="text"
                                                       name="training_name"
                                                       id="training_name"
                                                       class="form-control"
                                                       value="{{ old('training_name') }}"
                                                       placeholder="Enter Training Name"
                                                       required>


                                                @error('training_name')

                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Training Type --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="training_type">

                                                    Training Type

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <select name="training_type"
                                                        id="training_type"
                                                        class="form-control"
                                                        required>

                                                    <option value="">
                                                        Select Type
                                                    </option>

                                                    <option value="Internal">
                                                        Internal
                                                    </option>

                                                    <option value="External">
                                                        External
                                                    </option>

                                                    <option value="Online">
                                                        Online
                                                    </option>

                                                </select>


                                                @error('training_type')

                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Training Provider --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="training_provider">

                                                    Training Provider

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="text"
                                                       name="training_provider"
                                                       id="training_provider"
                                                       class="form-control"
                                                       value="{{ old('training_provider') }}"
                                                       placeholder="Training Provider"
                                                       required>


                                                @error('training_provider')

                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Start Date --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="start_date">

                                                    Start Date

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="date"
                                                       name="start_date"
                                                       id="start_date"
                                                       class="form-control"
                                                       value="{{ old('start_date') }}"
                                                       required>


                                                @error('start_date')

                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- End Date --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="end_date">

                                                    End Date

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="date"
                                                       name="end_date"
                                                       id="end_date"
                                                       class="form-control"
                                                       value="{{ old('end_date') }}"
                                                       required>


                                                @error('end_date')

                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Duration --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="duration">

                                                    Duration

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="text"
                                                       name="duration"
                                                       id="duration"
                                                       class="form-control"
                                                       value="{{ old('duration') }}"
                                                       placeholder="e.g. 3 Days"
                                                       readonly
                                                       required>


                                                @error('duration')

                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Training Location --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="training_location">

                                                    Training Location

                                                    <span class="text-danger">*</span>

                                                </label>


                                                <input type="text"
                                                       name="training_location"
                                                       id="training_location"
                                                       class="form-control"
                                                       value="{{ old('training_location') }}"
                                                       placeholder="Training Location"
                                                       required>


                                                @error('training_location')

                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Training Certificate --}}
                                        <div class="col-md-6">

                                            <div class="form-group">

                                                <label for="certificate">

                                                    Training Certificate

                                                </label>


                                                <input type="file"
                                                       name="certificate"
                                                       id="certificate"
                                                       class="form-control"
                                                       accept=".pdf,.jpg,.jpeg,.png">


                                                <small class="text-muted">

                                                    Allowed: PDF, JPG, JPEG, PNG
                                                    |
                                                    Maximum 5 MB

                                                </small>


                                                @error('certificate')

                                                    <span class="text-danger">

                                                        {{ $message }}

                                                    </span>

                                                @enderror

                                            </div>

                                        </div>


                                        {{-- Status --}}
                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <label for="status">

                                                    Status

                                                </label>


                                                <select name="status"
                                                        id="status"
                                                        class="form-control">

                                                    <option value="">
                                                        Select Status
                                                    </option>

                                                    <option value="Completed">
                                                        Completed
                                                    </option>

                                                    <option value="Ongoing">
                                                        Ongoing
                                                    </option>

                                                    <option value="Cancelled">
                                                        Cancelled
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        {{-- Remarks --}}
                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label for="training_remarks">

                                                    Remarks

                                                </label>


                                                <textarea name="remarks"
                                                          id="training_remarks"
                                                          class="form-control"
                                                          rows="3"
                                                          placeholder="Enter remarks">{{ old('remarks') }}</textarea>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- Training Buttons --}}

                                    <div class="row">

                                        <div class="col-md-12 text-right">


                                            <a href="{{ route('employee-training-history.index') }}"
                                               class="btn btn-default">

                                                <i class="fa fa-arrow-left"></i>

                                                Back

                                            </a>


                                            <button type="reset"
                                                    class="btn btn-warning">

                                                <i class="fa fa-refresh"></i>

                                                Reset

                                            </button>


                                            <button type="submit"
                                                    class="btn btn-primary">

                                                <i class="fa fa-save"></i>

                                                Save Training

                                            </button>

                                        </div>

                                    </div>


                                </form>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection



@section('script')

<style>

    .section-title {
        background: #f5f5f5;
        border-left: 4px solid #337ab7;
        padding: 10px 15px;
        margin-top: 10px;
        margin-bottom: 20px;
        font-size: 16px;
        font-weight: 600;
    }

    .form-group label {
        font-weight: 600;
    }

    .text-danger {
        color: #d9534f;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 34px;
        padding: 2px 8px;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
        line-height: 28px;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
        height: 32px;
    }

    .nav-tabs {
        margin-bottom: 20px;
    }

    .tab-form-container {
        padding: 10px 0;
    }

</style>



{{-- =========================================================
     SELECT2
========================================================= --}}

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<script>

$(document).ready(function () {


    /*
    |--------------------------------------------------------------------------
    | Initialize Select2
    |--------------------------------------------------------------------------
    */

    $('.select2').select2({
        width: '100%',
        allowClear: true
    });



    /*
    |--------------------------------------------------------------------------
    | Employee Selection
    |--------------------------------------------------------------------------
    */

    $('#employee_id').on('change', function () {

        var selectedOption =
            $(this).find('option:selected');


        var employeeId =
            selectedOption.val() || '';


        var polarId =
            selectedOption.attr('data-polar-id') || '';


        var designationId =
            selectedOption.attr('data-designation-id') || '';


        var departmentId =
            selectedOption.attr('data-department-id') || '';


        var officeLocationId =
            selectedOption.attr('data-office-location-id') || '';


        var reportingTo =
            selectedOption.attr('data-reporting-to') || '';


        var designation =
            selectedOption.attr('data-designation') || '';


        var department =
            selectedOption.attr('data-department') || '';


        var officeLocation =
            selectedOption.attr('data-office-location') || '';


        var grade =
            selectedOption.attr('data-grade') || '';



        /*
        |--------------------------------------------------------------------------
        | Common Employee Information
        |--------------------------------------------------------------------------
        */

        $('#polar_id')
            .val(polarId);


        $('#previous_designation')
            .val(designation);


        $('#previous_department')
            .val(department);


        $('#previous_grade')
            .val(grade);


        $('#previous_office_location')
            .val(officeLocation);



        /*
        |--------------------------------------------------------------------------
        | Set Employee ID For All Forms
        |--------------------------------------------------------------------------
        */

        $('#promotion_employee_id')
            .val(employeeId);


        $('#transfer_employee_id')
            .val(employeeId);


        $('#training_employee_id')
            .val(employeeId);



        /*
        |--------------------------------------------------------------------------
        | PROMOTION
        |--------------------------------------------------------------------------
        */

        $('#new_designation_id')
            .val(designationId)
            .trigger('change');


        $('#new_department_id')
            .val(departmentId)
            .trigger('change');


        $('#new_office_location_id')
            .val(officeLocationId)
            .trigger('change');


        $('#new_grade')
            .val(grade);


        /*
        | Current Reporting To → New Reporting To
        |
        | Promotion with Transfer-এর জন্য
        */

        $('#promotion_new_reporting_to')
            .val(reportingTo)
            .trigger('change');



        /*
        |--------------------------------------------------------------------------
        | TRANSFER
        |--------------------------------------------------------------------------
        */

        $('#transfer_department_id')
            .val(departmentId)
            .trigger('change');


        $('#transfer_office_location_id')
            .val(officeLocationId)
            .trigger('change');


        $('#transfer_new_reporting_to')
            .val(reportingTo)
            .trigger('change');

    });



    /*
    |--------------------------------------------------------------------------
    | Promotion Type
    |--------------------------------------------------------------------------
    |
    | Promotion with Transfer select করলে
    | New Reporting To required হবে।
    |
    */

    $('#promotion_type').on('change', function () {

        var promotionType =
            $(this).val();


        if (promotionType === 'Promotion with Transfer') {

            $('#promotion_new_reporting_to')
                .prop('required', true);

        } else {

            $('#promotion_new_reporting_to')
                .prop('required', false);

        }

    });



    /*
    |--------------------------------------------------------------------------
    | Promotion Form Reset
    |--------------------------------------------------------------------------
    */

    $('#promotionForm').on('reset', function () {

        setTimeout(function () {

            $('#promotion_employee_id')
                .val($('#employee_id').val());


            $('#new_designation_id')
                .val('')
                .trigger('change');


            $('#new_department_id')
                .val('')
                .trigger('change');


            $('#new_office_location_id')
                .val('')
                .trigger('change');


            $('#promotion_new_reporting_to')
                .val('')
                .trigger('change');


            $('#new_grade')
                .val('');


            $('#promotion_type')
                .val('');


        }, 10);

    });



    /*
    |--------------------------------------------------------------------------
    | Transfer Form Reset
    |--------------------------------------------------------------------------
    */

    $('#transferForm').on('reset', function () {

        setTimeout(function () {

            $('#transfer_employee_id')
                .val($('#employee_id').val());


            $('#transfer_department_id')
                .val('')
                .trigger('change');


            $('#transfer_office_location_id')
                .val('')
                .trigger('change');


            $('#transfer_new_reporting_to')
                .val('')
                .trigger('change');


            $('#transfer_type')
                .val('');


        }, 10);

    });



    /*
    |--------------------------------------------------------------------------
    | Training Form Reset
    |--------------------------------------------------------------------------
    */

    $('#trainingForm').on('reset', function () {

        setTimeout(function () {

            $('#training_employee_id')
                .val($('#employee_id').val());

        }, 10);

    });



    /*
    |--------------------------------------------------------------------------
    | Training Duration Calculation
    |--------------------------------------------------------------------------
    */

    function calculateDuration() {

        let startDate =
            $('#start_date').val();


        let endDate =
            $('#end_date').val();


        if (!startDate || !endDate) {

            $('#duration').val('');

            return;
        }


        let start =
            new Date(startDate);


        let end =
            new Date(endDate);


        if (end < start) {

            $('#duration').val('');

            return;
        }


        let diffTime =
            end.getTime() - start.getTime();


        let diffDays =
            Math.floor(
                diffTime /
                (1000 * 60 * 60 * 24)
            ) + 1;


        if (diffDays === 1) {

            $('#duration')
                .val('1 Day');

        } else {

            $('#duration')
                .val(diffDays + ' Days');

        }

    }


    $('#start_date, #end_date')
        .on('change', function () {

            calculateDuration();

        });



    /*
    |--------------------------------------------------------------------------
    | Prevent Submit Without Employee
    |--------------------------------------------------------------------------
    */

    $('#promotionForm, #transferForm, #trainingForm')
        .on('submit', function (e) {

            if (!$('#employee_id').val()) {

                e.preventDefault();


                alert(
                    'Please select an employee first.'
                );


                $('#employee_id')
                    .select2('open');


                return false;
            }

        });

});

</script>

@endsection