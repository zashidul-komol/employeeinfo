@extends('layouts.admin') 
@section('title', 'Employee Promotion Details') 
@section('content') 

<div class="container-fluid"> 
  <div class="row"> 
    <div class="col-md-12"> 
      <div class="panel panel-default"> {{-- Panel Heading --}} 
        <div class="panel-heading"> 
          <h4 class="panel-title"> <i class="fa fa-user"></i> Employee Promotion Details </h4> 
        </div> 
        <div class="panel-body"> 
          <form method="POST" action="{{ route('employee-promotion-history.store') }}" id="promotionForm"> @csrf {{-- ================== EMPLOYEE INFORMATION =================== --}} 
            <div class="row"> 
              <div class="col-md-12"> 
                <h4 class="section-title"> Employee Information </h4> 
              </div> {{-- Employee --}} 

                <div class="col-md-4">
                    <div class="form-group">

                        <label for="employee_id">
                            Employee <span class="text-danger">*</span>
                        </label>


                        <select name="employee_id"
                                id="employee_id"
                                class="form-control select2"
                                required>

                            <option value="">Select Employee</option>

                            @foreach($employeesName as $employee)

                                <option value="{{ $employee->id }}"
                                        data-designation-id="{{ $employee->desig_id }}"
                                        data-department-id="{{ $employee->dept_id }}"
                                        data-designation="{{ optional($employee->designation)->title }}"
                                        data-department="{{ optional($employee->department)->name }}"
                                        data-grade="{{ $employee->grade ?? '' }}"
                                        data-officelocation-id="{{ $employee->office_loc_id }}"
                                        data-officelocation="{{ optional($employee->office_location)->name }}">

                                    {{ $employee->name }} - {{ $employee->polar_id }}

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
                           id="previous_designation"
                           class="form-control"
                           readonly>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Current Department</label>
                    <input type="text"
                           id="previous_department"
                           class="form-control"
                           readonly>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Current Grade</label>
                    <input type="text"
                           id="previous_grade"
                           class="form-control"
                           readonly>
                </div>
            </div> 

            <div class="col-md-4">
                <div class="form-group">
                    <label>Current Location</label>
                    <input type="text"
                           id="previous_officelocation"
                           class="form-control"
                           readonly>
                </div>
            </div> 
          </div> 
          {{-- =====================================================
                             PROMOTION INFORMATION
                        ====================================================== --}}

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

                                        <option value="Promotion"
                                            {{ old('promotion_type') == 'Promotion' ? 'selected' : '' }}>
                                            Promotion
                                        </option>

                                        <option value="Re-designation"
                                            {{ old('promotion_type') == 'Re-designation' ? 'selected' : '' }}>
                                            Re-designation
                                        </option>

                                        <option value="Grade Change"
                                            {{ old('promotion_type') == 'Grade Change' ? 'selected' : '' }}>
                                            Grade Change
                                        </option>

                                    </select>

                                    @error('promotion_type')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

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
                                           value="{{ old('effective_date') }}"
                                           required>

                                    @error('effective_date')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

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

                                            <option value="{{ $id }}"
                                                {{ old('new_designation_id') == $id ? 'selected' : '' }}>

                                                {{ $title }}

                                            </option>

                                        @endforeach

                                    </select>

                                    @error('new_designation_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

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

                                            <option value="{{ $id }}"
                                                {{ old('new_department_id') == $id ? 'selected' : '' }}>

                                                {{ $name }}

                                            </option>

                                        @endforeach

                                    </select>

                                    @error('new_department_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

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
                                           class="form-control"
                                           value="{{ old('new_grade') }}"
                                           placeholder="Enter New Grade">

                                    @error('new_grade')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            {{-- New Office Location --}}
                            <div class="col-md-3">

                                <div class="form-group">

                                    <label for="new_officelocation_id">
                                        Office Location
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select name="new_officelocation_id"
                                            id="new_officelocation_id"
                                            class="form-control select2"
                                            required>

                                        <option value="">
                                            Select Office Location
                                        </option>

                                        @foreach($office_locations as $id => $name)

                                            <option value="{{ $id }}"
                                                {{ old('new_officelocation_id') == $id ? 'selected' : '' }}>

                                                {{ $name }}

                                            </option>

                                        @endforeach

                                    </select>

                                    @error('new_officelocation_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div> 

{{-- Promotion Reason --}} 
<div class="col-md-12"> 
  <div class="form-group"> 
    <label for="promotion_reason"> Promotion Reason </label> 
    <textarea name="promotion_reason" id="promotion_reason" class="form-control" rows="3" placeholder="Enter promotion reason">{{ old('promotion_reason') }}</textarea> 
    @error('promotion_reason') 
    <span class="text-danger"> {{ $message }} </span> 
  @enderror 
</div> 
</div> 
{{-- Remarks --}} 
<div class="col-md-12"> 
  <div class="form-group"> 
    <label for="remarks"> Remarks </label> 
    <textarea name="remarks" id="remarks" class="form-control" rows="3" placeholder="Enter remarks">{{ old('remarks') }}</textarea> 
    @error('remarks') 
    <span class="text-danger"> {{ $message }} </span> 
  @enderror 
</div> 
</div> 
</div> 
{{-- ========================================================= BUTTONS ========================================================== --}} 
<div class="row"> 
  <div class="col-md-12 text-right"> 
    <a href="{{ route('employee-promotion-history.index') }}" class="btn btn-default"> <i class="fa fa-arrow-left"></i> Back </a> 
    <button type="reset" class="btn btn-warning"> 
      <i class="fa fa-refresh"></i> Reset </button> 
      <button type="submit" class="btn btn-primary"> 
        <i class="fa fa-save"></i> Save Promotion </button> 
      </div> 
    </div> 
  </form> 
</div> 
</div> 
</div> 
</div> 
</div> 
@section('script')
{{-- =========================== CUSTOM CSS ==================== --}} 
<style> 
.section-title { background: #f5f5f5; 
border-left: 4px solid #337ab7; 
padding: 10px 15px; 
margin-top: 10px; 
margin-bottom: 20px; 
font-size: 16px; 
font-weight: 600; } 
.form-group label { font-weight: 600; } 
.text-danger { color: #d9534f; } /* * Select2 width */ 
.select2-container { width: 100% !important; } 
.select2-container 
.select2-selection--single { height: 34px; padding: 2px 8px; } 
.select2-container--default 
.select2-selection--single 
.select2-selection__rendered { line-height: 28px; } 
.select2-container--default 
.select2-selection--single 
.select2-selection__arrow { height: 32px; } 
</style>

 {{-- ====================== JAVASCRIPT ======================= --}} 
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
</script>

<script>
$(document).ready(function () {

    // Initialize Select2
    $('.select2').select2({
        width: '100%',
        allowClear: true
    });


    // Employee Selection
    $('#employee_id').on('change', function () {

        var selectedOption = $(this).find('option:selected');

      // Employee current values
      var designationId     = selectedOption.attr('data-designation-id') || '';
      var departmentId      = selectedOption.attr('data-department-id') || '';
      var officelocationId  = selectedOption.attr('data-officelocation-id') || '';

      var designation     = selectedOption.attr('data-designation') || '';
      var department      = selectedOption.attr('data-department') || '';
      var officelocation  = selectedOption.attr('data-officelocation') || '';
      var grade           = selectedOption.attr('data-grade') || '';


      // Current Designation
      $('#previous_designation').val(designation);

      // Current Department
      $('#previous_department').val(department);

      // Current Office Location
      $('#previous_officelocation').val(officelocation);

      // Current Grade
      $('#previous_grade').val(grade);


        // Automatically select New Designation
        $('#new_designation_id')
            .val(designationId)
            .trigger('change');


        // Automatically select New Department
        $('#new_department_id')
            .val(departmentId)
            .trigger('change');

        // Automatically select New Office Location
        $('#new_officelocation_id')
            .val(officelocationId)
            .trigger('change');


        // Automatically set New Grade
        $('#new_grade').val(grade);

    });


    // Reset Form
    $('#promotionForm').on('reset', function () {

        setTimeout(function () {

            $('#employee_id')
                .val('')
                .trigger('change');

            $('#new_designation_id')
                .val('')
                .trigger('change');

            $('#new_department_id')
                .val('')
                .trigger('change');

            $('#new_officelocation_id')
                .val('')
                .trigger('change');

            $('#previous_designation').val('');
            $('#previous_department').val('');
            $('#previous_officelocation').val('');
            $('#previous_grade').val('');
            $('#new_grade').val('');

        }, 10);

    });

});
</script>
@endsection
@endsection