@extends('layouts.admin')
@section('title', 'Child Details Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Child Details</a></li>
            <li><a>Edit</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-8">
        <h4 class="section-subtitle"><b>Edit Relatives Details</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('relationships.create','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  {{ Form::model($relationships,array('route' => array('relationships.update',$relationships->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
              <!-- .tab-pane -->
                  <div class="tab-pane" id="child">
                      <form class="form-horizontal">
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Child Name</label>

                              <div class="col-xs-7">
                                {{Form::text('child_name',null,array('class' => 'form-control'))}}
                                {!! $errors->first('child_name', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Date of Birth</label>
                              <div class="col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('date_of_birth',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Gender</label>
                                  <div class="col-xs-7">
                                      {{Form::select('gender',[''=>'--Please Select Gender--']+['Male'=>'Male', 'Female'=>'Female'],null,array('class' => 'form-control'))}}
                                  </div>
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Occupation</label>

                              <div class="col-xs-7">
                                  {{Form::select('occupation',[''=>'--Please Select Occupation--']+['Infant'=>'Infant','Student'=>'Student', 'Service'=>'Service'],null,array('class' => 'form-control'))}}
                              </div>
                              
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Institution/Company</label>

                              <div class="col-xs-7">
                                  {{Form::text('institution',null,array('class' => 'form-control'))}}
                                  {!! $errors->first('institution', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                              
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Education</label>

                              <div class="col-xs-7">
                                {{Form::select('education',[''=>'--Please Select Occupation--']+['Pre-Primary'=>'Pre-Primary','Primary'=>'Primary', 'High School'=>'High School','College'=>'College','University'=>'University'],null,array('class' => 'form-control'))}}
                                {!! $errors->first('education', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Name of Class/ Grade</label>

                              <div class="col-xs-7">
                                  {{Form::text('class_name',null,array('class' => 'form-control'))}}
                                  {!! $errors->first('class_name', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                              
                          </div>
                          <div class="form-group">
                              <div class="col-sm-offset-5 col-sm-8">
                                <button type="submit" class="btn btn-primary"> UPDATE</button>
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

        $('.datepicker').datepicker({ format: "dd-mm-yyyy",todayHighlight: true,autoclose:true});

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

