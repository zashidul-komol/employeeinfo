@extends('layouts.admin')
@section('title', 'Child Details Lists')
@section('content')
@extends('layouts.app')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-user"></i>
                        Employee Promotion Details
                    </h4>
                </div>

                <div class="panel-body">

                    <form method="POST"
                          action="{{ route('promotion_details.store') }}"
                          id="promotionForm">

                        @csrf

                        {{-- Employee Information --}}
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="section-title">
                                    Employee Information
                                </h4>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Employee <span class="text-danger">*</span></label>

                                    <select name="employee_id"
                                            id="employee_id"
                                            class="form-control select2"
                                            required>

                                        <option value="">Select Employee</option>

                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                    data-designation="{{ $employee->designation_name ?? '' }}"
                                                    data-department="{{ $employee->department_name ?? '' }}"
                                                    data-grade="{{ $employee->grade_name ?? '' }}"
                                                    data-salary="{{ $employee->basic_salary ?? '' }}">

                                                {{ $employee->employee_id }}
                                                -
                                                {{ $employee->employee_name }}

                                            </option>
                                        @endforeach

                                    </select>

                                    @error('employee_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Current Designation</label>

                                    <input type="text"
                                           name="previous_designation"
                                           id="previous_designation"
                                           class="form-control"
                                           readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Current Department</label>

                                    <input type="text"
                                           name="previous_department"
                                           id="previous_department"
                                           class="form-control"
                                           readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Current Grade</label>

                                    <input type="text"
                                           name="previous_grade"
                                           id="previous_grade"
                                           class="form-control"
                                           readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Current Basic Salary</label>

                                    <input type="number"
                                           step="0.01"
                                           name="previous_salary"
                                           id="previous_salary"
                                           class="form-control"
                                           readonly>
                                </div>
                            </div>

                        </div>


                        {{-- Promotion Information --}}
                        <div class="row">

                            <div class="col-md-12">
                                <h4 class="section-title">
                                    Promotion Information
                                </h4>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Promotion Type <span class="text-danger">*</span></label>

                                    <select name="promotion_type"
                                            class="form-control"
                                            required>

                                        <option value="">Select Type</option>
                                        <option value="Promotion">Promotion</option>
                                        <option value="Re-designation">Re-designation</option>
                                        <option value="Grade Change">Grade Change</option>
                                        <option value="Promotion with Increment">
                                            Promotion with Increment
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Effective Date <span class="text-danger">*</span></label>

                                    <input type="date"
                                           name="effective_date"
                                           class="form-control"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Designation <span class="text-danger">*</span></label>

                                    <select name="new_designation_id"
                                            class="form-control select2"
                                            required>

                                        <option value="">Select Designation</option>

                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}">
                                                {{ $designation->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Department</label>

                                    <select name="new_department_id"
                                            class="form-control select2">

                                        <option value="">Select Department</option>

                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Grade</label>

                                    <select name="new_grade_id"
                                            class="form-control select2">

                                        <option value="">Select Grade</option>

                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}">
                                                {{ $grade->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>


                        {{-- Salary Information --}}
                        <div class="row">

                            <div class="col-md-12">
                                <h4 class="section-title">
                                    Salary Information
                                </h4>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Previous Basic Salary</label>

                                    <input type="number"
                                           step="0.01"
                                           name="previous_salary"
                                           id="salary_previous"
                                           class="form-control"
                                           readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Basic Salary</label>

                                    <input type="number"
                                           step="0.01"
                                           name="new_salary"
                                           id="new_salary"
                                           class="form-control">

                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Increment</label>

                                    <input type="number"
                                           step="0.01"
                                           name="salary_increment"
                                           id="salary_increment"
                                           class="form-control"
                                           readonly>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Increment %</label>

                                    <input type="number"
                                           step="0.01"
                                           name="increment_percentage"
                                           id="increment_percentage"
                                           class="form-control"
                                           readonly>
                                </div>
                            </div>

                        </div>


                        {{-- Approval Information --}}
                        <div class="row">

                            <div class="col-md-12">
                                <h4 class="section-title">
                                    Approval & Remarks
                                </h4>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Approved By</label>

                                    <select name="approved_by"
                                            class="form-control select2">

                                        <option value="">Select Approver</option>

                                        @foreach($approvers as $approver)
                                            <option value="{{ $approver->id }}">
                                                {{ $approver->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Approval Date</label>

                                    <input type="date"
                                           name="approved_date"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Promotion Reason</label>

                                    <textarea name="promotion_reason"
                                              class="form-control"
                                              rows="3"
                                              placeholder="Enter promotion reason"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Remarks</label>

                                    <textarea name="remarks"
                                              class="form-control"
                                              rows="3"
                                              placeholder="Enter remarks"></textarea>
                                </div>
                            </div>

                        </div>


                        {{-- Buttons --}}
                        <div class="row">

                            <div class="col-md-12 text-right">

                                <a href="{{ route('promotion_details.index') }}"
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

        </div>
    </div>

</div>


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

</style>


<script>

$(document).ready(function () {

    $('.select2').select2({
        width: '100%'
    });


    // Employee Selection
    $('#employee_id').on('change', function () {

        let selected = $(this).find(':selected');

        let designation = selected.data('designation') || '';
        let department  = selected.data('department') || '';
        let grade       = selected.data('grade') || '';
        let salary      = selected.data('salary') || '';

        $('#previous_designation').val(designation);
        $('#previous_department').val(department);
        $('#previous_grade').val(grade);

        $('#previous_salary').val(salary);
        $('#salary_previous').val(salary);

        calculateIncrement();

    });


    // Salary Calculation
    $('#new_salary').on('keyup change', function () {

        calculateIncrement();

    });


    function calculateIncrement() {

        let previousSalary = parseFloat($('#salary_previous').val()) || 0;
        let newSalary      = parseFloat($('#new_salary').val()) || 0;

        let increment = newSalary - previousSalary;

        let percentage = 0;

        if (previousSalary > 0) {
            percentage = (increment / previousSalary) * 100;
        }

        $('#salary_increment').val(increment.toFixed(2));
        $('#increment_percentage').val(percentage.toFixed(2));

    }

});

</script>

@endsection