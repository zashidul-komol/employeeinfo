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
            {!! Html::decode(link_to_route('employees.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  {{ Form::model($employees,array('route' => array('employees.update',$employees->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Name</label>

                          <div class="col-sm-4">
                            {{Form::text('name',null,array('class' => 'form-control'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Company Name</label>

                          <div class="col-sm-4">
                            {{Form::select('organization_id',[''=>'--Please Select Company--']+$organizations->toArray(),null,array('class' => 'form-control'))}}
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
                              {{Form::select('job_status',[''=>'--Please Select Job status--']+['permanent'=>'Permanent', 'dailyworker'=>'Daily Basis Worker'],null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputExperience" class="col-sm-2">Present Address</label>

                          <div class="col-sm-4">
                            {{Form::textarea('present_address',null,array('class' => 'form-control max-length','rows' => 3, 'cols' => 2,'maxlength'=>'150'))}}
                              {!! $errors->first('present_address', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 require">Division</label>
                          <div class="col-xs-4">
                                {{Form::select('division_id',$divisions,null,array('class' => 'form-control', '@change'=>'getDistricts'))}}
                                {!! $errors->first('division_id', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 require">District</label>
                            <div class="col-xs-4">
                               
                                <select name="district_id" class="form-control col-sm-2" v-model="district_id" @change="getThanas">
                                    <option v-for="(name,id) in districts" v-bind:value="id" v-text="name"></option>
                                </select>
                                {!! $errors->first('district_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <label for="inputName" class="col-sm-2 require">Thana</label>
                            <div class="col-xs-4">
                              <select name="thana_id" v-model="thana_id" class="form-control col-sm-2">
                                  <option value="">Please Select Thana</option>
                                  <option v-for="(name,id) in thanas" v-bind:value="id" v-text="name"></option>
                              </select>
                              {!! $errors->first('thana_id', '<p class="text-danger">:message</p>' ) !!}
                            </div>

                      </div>
                      
                      <div class="form-group">
                          <label for="inputExperience" class="col-sm-2 ">Highest Education</label>

                          <div class="col-sm-4">
                            {{Form::text('highest_education',null,array('class' => 'form-control max-length','maxlength'=>'100'))}}
                              {!! $errors->first('highest_education', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputExperience" class="col-sm-2 ">Permanent Address</label>

                          <div class="col-sm-4">
                            {{Form::textarea('permanent_address',null,array('class' => 'form-control max-length','rows' => 1, 'cols' => 2,'maxlength'=>'150'))}}
                              {!! $errors->first('permanent_address', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <label for="inputName" class="col-sm-2 ">Institution</label>
                          <div class="col-xs-4">
                              {{Form::text('institution',null,array('class' => 'form-control'))}}
                              {!! $errors->first('institution', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 ">Job Start Date</label>
                              <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('jobstartdate',null,array('class' => 'form-control datepicker'))}}
                                </div>
                      </div> 
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 ">Employee Status</label>

                          <div class="col-xs-4">
                              {{Form::select('status',config('myconfig.status'),null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"> Update</button>
                          </div>
                      </div>
                 {{ Form::close() }}
                  <!-- /.form-horizontal -->
              </div>

              <!-- Blank Page End Here --> 
            </div>
        </div>
    </div>
</div>
@endsection
@section('vuescript')
<script>
    laravelObj.division_id='{{ old('division_id') }}';
    laravelObj.district_id='{{ old('district_id') }}';
    laravelObj.thana_id='{{ old('thana_id') }}';
</script>
@stop
@component('common_pages.selectize')
@include('common_pages.max_length')

     <script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">

        $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});

        //get shops or distributor
        function getExecutiveDepotShop(depotId){
          $('#shop-list').html('');
          $.ajax({
              type: 'Get',
              url:"{{ route('ajax.getShops') }}",
              data:{depot_id:depotId,distributor:1}
            }) .done(function(response) {
             $('#shop-list').html(response);
           //Select2 basic example
             $.fn.select2.defaults.set( "theme", "bootstrap" );
              $(".select2").select2({
                 // placeholder: function(){
                 //     $(this).data('placeholder');
                 // },
                 allowClear: true
             });
            if('{{old('shop_id')}}'){
              $("#shop_id").val('{{old('shop_id')}}').change();
            }

          })
          .fail(function(response) {
          });
        }
    </script>
    @slot('css')
     <!--Date picker-->
     <link rel="stylesheet" href="{{ asset('vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    @endslot
@endcomponent

