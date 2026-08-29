@extends('layouts.admin')
@section('title', 'Upload Transfer History')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Transfer History</a></li>
            <li><a>Import</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Transfer History Import</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('employee-transfer-history.uploadTransfer','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				{{ Form::model(request()->old(),array('route' => array('employee-transfer-history.uploadTransfer'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
  					<div class="form-group">
                        {{Form::label('Browse Employee:',null,array('class' => 'control-label col-sm-2'))}}
                        <div class="col-md-6">
                            {{Form::file('file')}}
                            {!! $errors->first('file', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                        <div class="col-md-2 preview-div">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary" name="btnRetailer">
                                Upload Transfer Information
                            </button>
                        </div>
                    </div>
				{{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection