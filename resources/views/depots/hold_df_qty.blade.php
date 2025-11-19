@extends('layouts.admin')
@section('title', 'Hold DF Qty')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Depot</a></li>
            <li><a>Hold DF Qty</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>Hold DF Qty</b></h4>
        <div class="panel">
            <div class="panel-content">
               {{ Form::model(request()->old(),array('route' => array('depots.holdDFQty'),'method' => 'PUT','class'=>'form-horizontal')) }}
                    <div class="row">
                    	@foreach ($depots as $element)
                    		<div class="col-md-6 form-group">
		                        {{Form::label($element->name,null,array('class' => 'control-label col-sm-4'))}}
		                        <div class="col-md-4">
		                            {{Form::number("qty[".$element->id."]",$element->df_hold_qty?:null,array('class' => 'form-control','oninput'=>'javascript: if (this.value > this.maxLength) this.value = this.maxLength;','maxlength'=>255))}}
		                        </div>
		                        <div class="col-md-4">
		                        	Available DF: {{ $element->available_qty_count ?? '0' }}
		                        </div>
		                    </div>
                    	@endforeach
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">
                                SET Hold QTY
                            </button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
