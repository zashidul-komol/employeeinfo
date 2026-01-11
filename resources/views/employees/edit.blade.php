@extends('layouts.admin')
@section('title', 'Employee Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee</a></li>
            <li><a>Edit</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Edit Employee</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('employees.index','<i class="fa fa-list"></i>',[],['class'=>'btn btn-success btn-right-side'])) !!}
        </span>

        <div class="panel">
            <div class="panel-content">
              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                {{ Form::model($employee, [
                        'route' => ['employees.update', $employee->id],
                        'method' => 'PUT',
                        'class' => 'form-horizontal'
                    ]) }}


                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Name</label>

                          <div class="col-sm-4">
                            {{Form::text('name',null,array('class' => 'form-control'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Company Name</label>

                          <div class="col-sm-4">

                          </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 ">Department</label>
                          <div class="col-xs-4">
                            {{Form::select('dept_id',$departments,null,array('class' => 'form-control'))}}
                          </div>
                          
                          <label for="inputName" class="col-sm-2 ">Designation</label>
                          <div class="col-xs-4">
                              {{Form::select('desig_id',$designations,null,array('class' => 'form-control'))}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Polar ID</label>

                          <div class="col-xs-4">
                              {{Form::text('polar_id',null,array('class' => 'form-control'))}}
                              {!! $errors->first('polar_id', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Location</label>
                          <div class="col-xs-4">
                              {{Form::select('office_loc_id',$officelocations,null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Hire Date</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('hiredate',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>
                        
                          <label for="inputName" class="col-sm-2 ">Birth Date</label>
                          <div class="col-xs-4">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('birthdate',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>
                      </div>
                      
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Mobile</label>

                          <div class="col-xs-4">
                              {{Form::text('mobile',null,array('class' => 'form-control'))}}
                              {!! $errors->first('mobile', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Gender</label>
                          <div class="col-xs-4">
                              {{Form::select('gender',[''=>'--Please Select Gender--']+['Male'=>'Male', 'Female'=>'Female'],null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Blood Group</label>

                          <div class="col-xs-1">
                              {{Form::text('bloodgroup',null,array('class' => 'form-control'))}}
                              {!! $errors->first('bloodgroup', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Grade</label>
                          <div class="col-xs-1">
                              {{Form::text('grade',null,array('class' => 'form-control'))}}
                              {!! $errors->first('grade', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Height</label>
                          <div class="col-xs-1">
                              {{Form::text('height_feet',null,array('class' => 'form-control'))}}
                              {!! $errors->first('height_feet', '<p class="text-danger">:message</p>' ) !!} 
                          </div>
                          <label for="inputName" class="col-sm-1 ">feet</label>
                          <div class="col-xs-1">
                              {{Form::text('height_inch',null,array('class' => 'form-control'))}}
                              {!! $errors->first('height_inch', '<p class="text-danger">:message</p>' ) !!} 
                          </div>inch
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Passport No.</label>

                          <div class="col-xs-4">
                              {{Form::text('passportno',null,array('class' => 'form-control'))}}
                              {!! $errors->first('passportno', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">TIN</label>
                          <div class="col-xs-4">
                              {{Form::text('tin',null,array('class' => 'form-control'))}}
                              {!! $errors->first('tin', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <label for="inputName" class="col-sm-2 ">Emergency Contact Person Name</label>
                          <div class="col-xs-4">
                              {{Form::text('emergency_contact_person',null,array('class' => 'form-control'))}}
                              {!! $errors->first('emergency_contact_person', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">NID</label>
                          <div class="col-xs-4">
                              {{Form::text('nid',null,array('class' => 'form-control'))}}
                              {!! $errors->first('nid', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <label for="inputName" class="col-sm-2 ">Relationship</label>
                          <div class="col-xs-4">
                              {{Form::text('relationship',null,array('class' => 'form-control'))}}
                              {!! $errors->first('relationship', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Contact No.</label>
                          <div class="col-xs-4">
                              {{Form::text('emergency_contact_no',null,array('class' => 'form-control'))}}
                              {!! $errors->first('emergency_contact_no', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Email</label>

                          <div class="col-xs-4">
                              {{Form::text('email',null,array('class' => 'form-control'))}}
                              {!! $errors->first('email', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Maritial Status</label>
                          <div class="col-xs-4">
                              {{Form::select('maritial_status',[''=>'--Please Select Maritial status--']+['Married'=>'Married', 'Unmarried'=>'Unmarried'],null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Region</label>

                          <div class="col-xs-4">
                              {{Form::select('region_id',$regions,null,array('class' => 'form-control'))}}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Job Status</label>
                          <div class="col-xs-4">
                              {{Form::select('job_status',[''=>'--Please Select Job status--']+['Permanent'=>'Permanent', 'Temporary'=>'Temporary'],null,array('class' => 'form-control select2'))}}
                          </div>
                      </div>
                      <div id="app">

                          <div class="form-group">

                              <label class="col-sm-2">Present Address</label>
                              <div class="col-sm-4">
                                  {{ Form::textarea('present_address', null, [
                                      'class' => 'form-control',
                                      'rows' => 3
                                  ]) }}
                              </div>

                              <label class="col-sm-2">Division</label>
                              <div class="col-sm-4">
                                  {{ Form::select(
                                      'division_id',
                                      ['' => 'Please Select Division'] + $divisions->toArray(),
                                      null,
                                      ['class' => 'form-control', 'v-model' => 'division_id', '@change' => 'getDistricts']
                                  ) }}
                              </div>

                              <label class="col-sm-2">District</label>
                              <div class="col-sm-4">
                                  <select name="district_id" class="form-control"
                                      v-model="district_id"
                                      @change="getThanas">
                                      <option value="">Please Select District</option>
                                      <option v-for="(name,id) in districts" :value="id">@{{ name }}</option>
                                  </select>
                              </div>

                              <label class="col-sm-2">Thana</label>
                              <div class="col-sm-4">
                                  <select name="thana_id" class="form-control" v-model="thana_id">
                                      <option value="">Please Select Thana</option>
                                      <option v-for="(name,id) in thanas" :value="id">@{{ name }}</option>
                                  </select>
                              </div>

                          </div>
                          </div>


                      
                      <div class="form-group">
                          <label for="inputExperience" class="col-sm-2 ">Highest Education</label>
                    <div class="form-group">
                        <label class="col-sm-2">Name</label>
                        <div class="col-sm-4">
                            {{ Form::text('name', null, ['class'=>'form-control']) }}
                            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Company Name</label>
                        <div class="col-sm-4">
                            {{ Form::select('organization_id', [''=>'--Please Select Company--'] + $organizations->toArray(), null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Department</label>
                        <div class="col-sm-4">
                            {{ Form::select('dept_id', $departments, null, ['class'=>'form-control']) }}
                        </div>

                        <label class="col-sm-2">Designation</label>
                        <div class="col-sm-4">
                            {{ Form::select('desig_id', $designations, null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Polar ID</label>
                        <div class="col-sm-4">
                            {{ Form::text('polar_id', null, ['class'=>'form-control']) }}
                            {!! $errors->first('polar_id', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Location</label>
                        <div class="col-sm-4">
                            {{ Form::select('office_loc_id', $officelocations, null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Hire Date</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('hiredate', null, ['class'=>'form-control datepicker']) }}
                            </div>
                        </div>

                        <label class="col-sm-2">Birth Date</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                {{ Form::text('birthdate', null, ['class'=>'form-control datepicker']) }}
                            </div>
                        </div>
                    </div>

                    <!-- Mobile and Gender -->
                    <div class="form-group">
                        <label class="col-sm-2">Mobile</label>
                        <div class="col-sm-4">
                            {{ Form::text('mobile', null, ['class'=>'form-control']) }}
                            {!! $errors->first('mobile', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Gender</label>
                        <div class="col-sm-4">
                            {{ Form::select('gender', [''=>'--Please Select Gender--','Male'=>'Male','Female'=>'Female'], null, ['class'=>'form-control']) }}
                        </div>
                    </div>

                    <!-- Blood Group, Grade, Height -->
                    <div class="form-group">
                        <label class="col-sm-2">Blood Group</label>
                        <div class="col-sm-1">
                            {{ Form::text('bloodgroup', null, ['class'=>'form-control']) }}
                            {!! $errors->first('bloodgroup', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Grade</label>
                        <div class="col-sm-1">
                            {{ Form::text('grade', null, ['class'=>'form-control']) }}
                            {!! $errors->first('grade', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Height</label>
                        <div class="col-sm-1">
                            {{ Form::text('height_feet', null, ['class'=>'form-control']) }}
                            {!! $errors->first('height_feet', '<p class="text-danger">:message</p>') !!}
                        </div>
                        <label class="col-sm-1">feet</label>
                        <div class="col-sm-1">
                            {{ Form::text('height_inch', null, ['class'=>'form-control']) }}
                            {!! $errors->first('height_inch', '<p class="text-danger">:message</p>') !!}
                        </div>inch
                    </div>

                    <!-- Passport, TIN -->
                    <div class="form-group">
                        <label class="col-sm-2">Passport No.</label>
                        <div class="col-sm-4">
                            {{ Form::text('passportno', null, ['class'=>'form-control']) }}
                            {!! $errors->first('passportno', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">TIN</label>
                        <div class="col-sm-4">
                            {{ Form::text('tin', null, ['class'=>'form-control']) }}
                            {!! $errors->first('tin', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <!-- Addresses and Division/District/Thana -->
                    <div class="form-group">
                        <label class="col-sm-2">Present Address</label>
                        <div class="col-sm-4">
                            {{ Form::textarea('present_address', null, ['class'=>'form-control max-length','rows'=>3,'maxlength'=>150]) }}
                            {!! $errors->first('present_address', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Division</label>
                        <div class="col-sm-4">
                            {{ Form::select('division_id', [''=>'Please Select Division']+$divisions->toArray(), $employees[0]->division_id ?? null, ['class'=>'form-control', 'v-model'=>'division_id', '@change'=>'getDistricts']) }}
                            {!! $errors->first('division_id', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">District</label>
                        <div class="col-sm-4">
                            <select name="district_id" class="form-control" v-model="district_id" @change="getThanas">
                                <option value="">Please Select District</option>
                                <option v-for="(name,id) in districts" :value="id">@{{ name }}</option>
                            </select>
                            {!! $errors->first('district_id', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Thana</label>
                        <div class="col-sm-4">
                            <select name="thana_id" class="form-control" v-model="thana_id">
                                <option value="">Please Select Thana</option>
                                <option v-for="(name,id) in thanas" :value="id">@{{ name }}</option>
                            </select>
                            {!! $errors->first('thana_id', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <!-- Highest Education, Permanent Address -->
                    <div class="form-group">
                        <label class="col-sm-2">Highest Education</label>
                        <div class="col-sm-4">
                            {{ Form::text('highest_education', null, ['class'=>'form-control max-length','maxlength'=>100]) }}
                            {!! $errors->first('highest_education', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <label class="col-sm-2">Permanent Address</label>
                        <div class="col-sm-4">
                            {{ Form::textarea('permanent_address', null, ['class'=>'form-control max-length','rows'=>1,'maxlength'=>150]) }}
                            {!! $errors->first('permanent_address', '<p class="text-danger">:message</p>') !!}
                        </div>
                    </div>

                    <!-- Job Start Date -->
                    <div class="form-group">
                        <label class="col-sm-2">Job Start Date</label>
                        <div class="col-sm-4 input-group">
                            <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('jobstartdate', null, ['class'=>'form-control datepicker']) }}
                        </div>
                    </div>

                    <!-- Status and Employee Type -->
                    <div class="form-group">
                        <label class="col-sm-2">Employee Status</label>
                        <div class="col-sm-4">
                            {{ Form::select('status', config('myconfig.status'), null, ['class'=>'form-control']) }}
                        </div>

                        <label class="col-sm-2">Employee Type</label>
                        <div class="col-sm-4">
                            {{ Form::select('employee_type', [''=>'--Please Select Employee Type--','Management'=>'Management','Non-Management'=>'Non-Management'], null, ['class'=>'form-control select2']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"> Update</button>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('vuescript')
<script>
new Vue({
    el: '#app',

    data() {
        return {
            division_id: "{{ $employee->division_id ?? '' }}",
            district_id: "{{ $employee->district_id ?? '' }}",
            thana_id: "{{ $employee->thana_id ?? '' }}",

            districts: @json($districts ?? []),
            thanas: @json($thanas ?? [])
        }
    },

    mounted() {
        if (this.division_id) {
            this.getDistricts();
        }
        if (this.district_id) {
            this.getThanas();
        }
    },

    methods: {
        getDistricts() {
            this.district_id = '';
            this.thana_id = '';
            this.thanas = {};

            if (!this.division_id) return;

            axios.get('/get-districts/' + this.division_id)
                .then(res => {
                    this.districts = res.data;
                });
        },

        getThanas() {
            this.thana_id = '';

            if (!this.district_id) return;

            axios.get('/get-thanas/' + this.district_id)
                .then(res => {
                    this.thanas = res.data;
                });
        }
    }
});
</script>
<script>
    var laravelObj = laravelObj || {};
    laravelObj.division_id='{{ $employee->division_id ?? '' }}';
    laravelObj.districts = {!! $districts ?? '[]' !!};
    laravelObj.district_id='{{ $employee->district_id ?? '' }}';
    laravelObj.thanas = {!! $thanas ?? '[]' !!};
    laravelObj.thana_id ='{{ $employee->thana_id ?? '' }}';
</script>
@stop
@component('common_pages.selectize')
@include('common_pages.max_length')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">

        $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});

        //get shops or distributor
        
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
<script type="text/javascript">
    $('.datepicker').datepicker({ format: "yyyy-mm-dd", todayHighlight: true, autoclose: true });
</script>
@endcomponent
