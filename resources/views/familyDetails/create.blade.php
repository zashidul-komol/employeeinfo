@extends('layouts.admin')
@section('title', 'Family Details Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Family Details</a></li>
            <li><a>Add</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Add Family Details</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('familyDetails.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  {{ Form::model(request()->old(),array('route' => array('familyDetails.store'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
              <!-- .tab-pane -->
                <div class="tab-pane" id="family">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Employee Name </label>
                          <div class="col-xs-4">
                              {{Form::select('employee_id',[''=>'--Please Select Employee--']+$employeesName->toArray(),null,array('class' => 'form-control'))}}
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Father's Name</label>

                            <div class="col-sm-10">
                              {{Form::text('father_name',null,array('class' => 'form-control'))}}
                              {!! $errors->first('father_name', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Occupation</label>

                            <div class="col-xs-4">
                                {{Form::text('father_occupation',null,array('class' => 'form-control'))}}
                              {!! $errors->first('father_occupation', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <label for="inputName" class="col-sm-2 control-label">Father's Alive Status</label>
                            <div class="col-xs-4">
                                {{Form::select('father_live_status',[''=>'--Please Select Alive Status--']+['alive'=>'Alive', 'dead'=>'Dead'],null,array('class' => 'form-control'))}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Mother's Name</label>

                            <div class="col-sm-10">
                              {{Form::text('mother_name',null,array('class' => 'form-control'))}}
                              {!! $errors->first('mother_name', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Occupation</label>

                            <div class="col-xs-4">
                                {{Form::text('mother_occupation',null,array('class' => 'form-control'))}}
                              {!! $errors->first('mother_occupation', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <label for="inputName" class="col-sm-2 control-label">Mother's Alive Status</label>
                            <div class="col-xs-4">
                                {{Form::select('mother_live_status',[''=>'--Please Select Alive Status--']+['alive'=>'Alive', 'dead'=>'Dead'],null,array('class' => 'form-control'))}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Wife's Name</label>

                            <div class="col-sm-10">
                              {{Form::text('wife_name',null,array('class' => 'form-control'))}}
                              {!! $errors->first('wife_name', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Occupation</label>

                            <div class="col-xs-4">
                                {{Form::text('wife_occupation',null,array('class' => 'form-control'))}}
                              {!! $errors->first('wife_occupation', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <label for="inputName" class="col-sm-2 control-label">Wife's Birth Date</label>
                            <div class="col-xs-4">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('wife_dob',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">No of Brothers</label>

                            <div class="col-xs-4">
                                {{Form::text('no_of_brothers',null,array('class' => 'form-control'))}}
                              {!! $errors->first('no_of_brothers', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                            <label for="inputName" class="col-sm-2 control-label">No of Sisters</label>
                            <div class="col-xs-4">
                                {{Form::text('no_of_sisters',null,array('class' => 'form-control'))}}
                              {!! $errors->first('no_of_sisters', '<p class="text-danger">:message</p>' ) !!}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-primary"> ADD </button>
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

