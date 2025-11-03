@extends('layouts.admin')
@section('title', 'Employee Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Add Employee</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('employees.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  {{ Form::model(request()->old(),array('route' => array('employees.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Name</label>

                          <div class="col-sm-10">
                            {{Form::text('name',null,array('class' => 'form-control'))}}
                              {!! $errors->first('name', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Department</label>
                          <div class="col-xs-4">
                            {{Form::select('dept_id',[''=>'--Please Select Department--']+$departments->toArray(),null,array('class' => 'form-control'))}}
                          </div>
                          
                         <label for="inputName" class="col-sm-2 control-label">Designation</label>
                          <div class="col-xs-4">
                              {{Form::select('desig_id',[''=>'--Please Select Designation--']+$designations->toArray(),null,array('class' => 'form-control'))}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Polar ID</label>

                          <div class="col-xs-4">
                              {{Form::text('polar_id',null,array('class' => 'form-control'))}}
                              {!! $errors->first('polar_id', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 control-label">Location</label>
                          <div class="col-xs-4">
                              {{Form::select('office_loc_id',[''=>'--Please Select Location--']+$officelocations->toArray(),null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Hire Date</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('hiredate',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>
                               
                          <label for="inputName" class="col-sm-2 control-label">Birth Date</label>
                          <div class="col-xs-4">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('birthdate',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>
                      </div>
                      <div class="form-group">
                          <label for="inputExperience" class="col-sm-2 control-label">Hobby</label>

                          <div class="col-sm-10">
                            {{Form::text('hobby',null,array('class' => 'form-control max-length','maxlength'=>'100'))}}
                              {!! $errors->first('hobby', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Mobile</label>

                          <div class="col-xs-4">
                              {{Form::text('mobile',null,array('class' => 'form-control'))}}
                              {!! $errors->first('mobile', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 control-label">Gender</label>
                          <div class="col-xs-4">
                              {{Form::select('gender',[''=>'--Please Select Gender--']+['Male'=>'Male', 'Female'=>'Female'],null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Blood Group</label>

                          <div class="col-xs-4">
                              {{Form::text('bloodgroup',null,array('class' => 'form-control'))}}
                              {!! $errors->first('bloodgroup', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 control-label">Grade</label>
                          <div class="col-xs-4">
                              {{Form::text('grade',null,array('class' => 'form-control'))}}
                              {!! $errors->first('grade', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Email</label>

                          <div class="col-xs-4">
                              {{Form::text('email',null,array('class' => 'form-control'))}}
                              {!! $errors->first('email', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputName" class="col-sm-2 control-label">Maritial Status</label>
                          <div class="col-xs-4">
                              {{Form::select('maritial_status',[''=>'--Please Select Maritial status--']+['Married'=>'Married', 'Unmarried'=>'Unmarried'],null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Region</label>

                          <div class="col-xs-4">
                              {{Form::select('region_id',$regions,null,array('class' => 'form-control'))}}
                          </div>
                          <label for="inputName" class="col-sm-2 control-label">Job Status</label>
                          <div class="col-xs-4">
                              {{Form::select('job_status',[''=>'--Please Select Job status--']+['permanent'=>'Permanent', 'dailyworker'=>'Daily Basis Worker'],null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputExperience" class="col-sm-2 control-label">Present Address</label>

                          <div class="col-sm-4">
                            {{Form::textarea('present_address',null,array('class' => 'form-control max-length','rows' => 3, 'cols' => 2,'maxlength'=>'150'))}}
                              {!! $errors->first('present_address', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                          <label for="inputExperience" class="col-sm-2 control-label">Permanent Address</label>

                          <div class="col-sm-4">
                            {{Form::textarea('permanent_address',null,array('class' => 'form-control max-length','rows' => 3, 'cols' => 2,'maxlength'=>'150'))}}
                              {!! $errors->first('permanent_address', '<p class="text-danger">:message</p>' ) !!}
                          </div>
                      </div>
                      <div class="form-group">
                          
                      </div>
                      <div class="form-group">
                          <label for="inputName" class="col-sm-2 control-label">Employee Status</label>

                          <div class="col-xs-4">
                              {{Form::select('status',config('myconfig.status'),null,array('class' => 'form-control'))}}
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"> ADD</button>
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

