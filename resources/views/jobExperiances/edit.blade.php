@extends('layouts.admin')
@section('title', 'Employment Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employment Details</a></li>
            <li><a>Update</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">

    <div class="col-sm-8">
        <h4 class="section-subtitle"><b>Update Employment Details</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('jobExperiances.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">

              <!-- Blank Page Start Here -->
              <div class="active tab-pane" id="personal">
                  {{ Form::model($jobExperiances,array('route' => array('jobExperiances.update',$jobExperiances->id),'method' => 'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                  <!-- .tab-pane -->
                  <div class="tab-pane" id="employment">
                      <form class="form-horizontal">
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Name of Company</label>

                              <div class="col-xs-7">
                                {{Form::text('name_company',null,array('class' => 'form-control'))}}
                                {!! $errors->first('name_company', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Last Position</label>

                              <div class="col-xs-7">
                                {{Form::text('position',null,array('class' => 'form-control'))}}
                                {!! $errors->first('position', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Join Date</label>
                              <div class="col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('start_date',null,array('class' => 'form-control datepicker'))}}
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="inputName" class="col-sm-3 control-label">Released Date</label>
                              <div class="col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                    {{Form::text('end_date',null,array('class' => 'form-control datepicker'))}}
                                </div>
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

