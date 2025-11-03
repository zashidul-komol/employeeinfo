@extends('layouts.admin')
@section('title', 'Add DF Size')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Send</a></li>
            <li><a>SMS</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">

    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Send SMS </b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('smsPromotionals.send','<i class="fa fa-list"></i>',[$param],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                {{ Form::model(request()->old(),array('route' => array('smsPromotionals.create',$param),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
                    
                    
                    <div class="form-group{{ $errors->has('sms_language') ? ' has-error' : '' }}">
                        {{Form::label('SMS Language:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            <label class="radio-inline">
                                {{ Form::radio('sms_language', 'EN' ,true ) }}English
                            </label>
                            {!! $errors->first('sms_language', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        {{Form::label('Message:',null,array('class' => 'control-label col-sm-2 require'))}}
                        <div class="col-md-6">
                            {{Form::textarea('message',null,array('class' => 'form-control max-length','maxlength'=>320))}}
                            {!! $errors->first('message', '<p class="text-danger">:message</p>' ) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    @include('common_pages.max_length')
@stop