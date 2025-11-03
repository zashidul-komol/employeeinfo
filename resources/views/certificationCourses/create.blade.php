@extends('layouts.admin')
@section('title', 'Certification Courses Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Certification Courses</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Add Certification Courses </b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('certificationCourses.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  {{ Form::model(request()->old(),array('route' => array('certificationCourses.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                  <!-- .tab-pane -->
                  <div class="tab-pane" id="EmployeeEducation">
                      <form class="form-horizontal">
                          <div class="form-group">
                            <div class="col-xs-3">
                              {{Form::select('employee_id',[''=>'--Please Select Employee--']+$employeesName->toArray(),null,array('class' => 'form-control'))}}
                            </div>
                            <div class="col-sm-3">
                                {{Form::text('name_course',null,array('class' => 'form-control'))}}
                                {!! $errors->first('name_course', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                              <div class="col-sm-2">
                                {{Form::text('institution',null,array('class' => 'form-control'))}}
                                {!! $errors->first('institution', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                              <div class="col-sm-2">
                                <div class="input-group">
                                    {{Form::text('passing_year',null,array('class' => 'form-control'))}}
                                {!! $errors->first('passing_year', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                                   
                              </div>
                              <div class="col-sm-2">
                                <div class="input-group">
                                    {{Form::text('result',null,array('class' => 'form-control'))}}
                                {!! $errors->first('result', '<p class="text-danger">:message</p>' ) !!}
                                </div>
                              </div>
                          </div>

                          
                          <div class="form-group">
                              <div class="col-sm-offset-11 col-sm-5">
                                <button type="submit" class="btn btn-primary"> ADD</button>
                              </div>
                          </div>
                      {{ Form::close() }}
                      <!-- /.form-horizontal -->
                  </div>
                  <!-- /.tab-pane -->
              </div
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

