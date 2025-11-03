@extends('layouts.admin')
@section('title', 'Upload Warranty Claim Documents')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Inventories</a></li>
            <li><a>Update Warranty Claim</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Warranty Claim</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('inventories.itemIndex','<i >Back</i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
    		
			{{ Form::model($item,array('route' => array('inventories.warrantyclaim.details',request()->route()->parameters['param']),'method'=>'PUT','enctype'=>'multipart/form-data','class'=>'form-horizontal confirm-form')) }}
             {{Form::hidden('item_id',$item->id,array('id'=>'itemId'))}}
             {{Form::hidden('brand_id',$item->brand_id,array('id'=>'brandId'))}}
             {{ Form::hidden('old_warranty_file',$item->warranty_file, array('id'=>'warranty_file'))}}
            <div class="row">
                <div class="col-md-6">
					<div class="form-group">
                        <div class="col-md-4">
                            {{Form::label('DF Serial No :',null,array('class' => 'control-label'))}}
                        </div>
                        <div class="col-md-8">
                            {{Form::text('serial_no',null ,array('class' => 'form-control','placeholder'=>'Ex:Front Side', 'readonly' => 'true'))}}
                                {!! $errors->first('serial_no', '<p class="text-danger">:message</p>' ) !!}
                            
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            {{Form::label('LR Serial No :',null,array('class' => 'control-label'))}}
                        </div>
                        <div class="col-md-8">
                            {{Form::text('company_serial',null ,array('class' => 'form-control','placeholder'=>'Ex:Comany Serial No.'))}}
                                {!! $errors->first('company_serial', '<p class="text-danger">:message</p>' ) !!}
                            
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                          {{Form::label('Packaging Date :',null,array('class' => 'control-label'))}}
                        </div> 
                        <div class="col-md-8">
                            <div class="input-group">
                              <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                              {{Form::text('packaging_date',null,array('class' => 'form-control datepicker', 'id'=>'packaging_date'))}}
                            </div>
                        </div>
                        <p class="text-danger" id="error_packaging_date"></p>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            {{Form::label('Model/Index No :',null,array('class' => 'control-label'))}}
                        </div>
                        <div class="col-md-8">
                            {{Form::text('company_model',null ,array('class' => 'form-control','placeholder'=>'Ex:Company Model No.'))}}
                                {!! $errors->first('company_model', '<p class="text-danger">:message</p>' ) !!}
                            
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            {{Form::label('Compressure Part No :',null,array('class' => 'control-label'))}}
                        </div>
                        <div class="col-md-8">
                            {{Form::text('compressure_partno',null ,array('class' => 'form-control','placeholder'=>'Ex:Compressure Part No.'))}}
                                {!! $errors->first('compressure_partno', '<p class="text-danger">:message</p>' ) !!}
                            
                        </div>

                    </div>
                    <div class="form-group" id="lr_warranty_file">
                          <div class="col-md-4">
                              {{Form::label('Upload Image :',null,array('class' => 'control-label'))}}
                          </div>
                          <div class="col-md-8">
                              <div class="input-group">
                                <input type="file" name="warranty_file" id="warranty_file"> 
                                {!! $errors->first('warranty_file', '<p class="text-danger">:message</p>' ) !!}
                              </div>
                          </div>
                      </div>
					
					                 					
            		<div class="form-group">
                        <div class="col-md-6 ">
                        	<button type="submit" name="docupdate" value="docupdate" class="btn btn-primary">
                            	Update Document
                        	</button>
                        </div>
                        
                    </div>
                  
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 preview-div">
                        <a href="" target="_blank"></a>
                        <a href="{{ asset('storage/images/Warranty_File/'.$item->id.'/'.$item->warranty_file) }}" target="_blank"><img src="{{ asset('storage/images/Warranty_File/'.$item->id.'/'.$item->warranty_file) }}" alt="Girl in a jacket" width="600" height="300"></a>
                          
                    </div>

                </div>

            </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@component('common_pages.selectize')

<script type="text/javascript">

    </script>

@section('script')
@include('common_pages.max_length')
<style>
    .left-element{min-width: 160px !important;font-weight: bold;text-align: right;padding-right: 10px}
</style>
<script src="{{ asset('vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">

        $('.datepicker').datepicker({ format: "yyyy-mm-dd",todayHighlight: true,autoclose:true});
</script>
@stop


