@component('common_pages.selectize')
@endcomponent
@extends('layouts.admin',['className' => 'sign-in'])
@section('title', 'Register User')
@section('content')
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">User</a></li>
            <li><a>register</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle"><b>User Register</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('users.index','<i class="fa fa-list"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
                  <form id="inline-validation" class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        
                        <div class="form-group">
                            <label for="inputName" class="col-md-2 control-label">Employee ID </label>
                            <div class="col-md-4">
                              {{Form::select('employee_id',[''=>'Please Select Origin']+$employees->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Employee ID'))}}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="role_id" class="col-md-2 control-label require">Role</label>
                            <div class="col-md-4">
                            {{Form::select('role_id',[''=>'Please Select Role']+$roles->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Role'))}}
                            </div>
                            @if ($errors->has('role_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                        </div>
                         <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }}">
                            <label for="designation_id" class="col-md-2 control-label require">Designation</label>
                            <div class="col-md-4">
                                {{Form::select('designation_id',[''=>'Please Select Designation']+$designations->toArray(),null,array('class' => 'form-control select2','data-placeholder'=>'Please Select Designation'))}}
                            </div>
                             @if ($errors->has('designation_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('designation_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-2 control-label require">Mobile Number</label>
                            <div class="col-md-4">
                            {{Form::text('mobile',old('mobile'),array('class' => 'form-control max-length','oninput'=>'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);','maxlength'=>11,'required'=>'required'))}}
                            </div>
                             @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-2 control-label require">Username</label>

                            <div class="col-md-4">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label require">E-Mail Address</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label require">Password</label>

                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-2 control-label require">Confirm Password</label>
                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="status" class="col-md-2 control-label require">Status</label>
                            <div class="col-md-4">
                            {{Form::select('status',config('myconfig.status'),old('status'),array('class' => 'form-control'))}}
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<style>
    .fa-sort-desc{
        cursor: pointer;
        font-size: 20px;
    }
    .fa-sort-desc.open{
        transform: rotate(90deg);
    }
    .distributor{
        display: none;
        list-style: none;
    }

</style>
@stop
@section('script')
@include('common_pages.max_length')
<script>
$(document).on('click','.fa-sort-desc',function(){
    $(this).next('ul.distributor').slideToggle();
    $(this).toggleClass('open');
});

$(document).on('click','.depots',function(){
    var tis=$(this);
    var obj=tis.parents('.input-container').find('ul.distributor');
    if(tis.is(':checked')){
        var lgth=obj.find("input:checkbox:checked").length;
        if(!lgth){
            obj.find("input:checkbox").prop('checked',true);
        }
    }else{
        obj.find("input:checkbox").prop('checked',false);
    }
});

$(document).on('click','.distributors',function(){
    var idd=$(this).data('parent');
   if($('.depot-'+idd+':checked').length){
        $('#depot-'+idd).prop('checked',true);
   }else{
        $('#depot-'+idd).prop('checked',false);
   }
});

$(document).ready(function(e){
    $("#checkoruncheck").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
});
</script>
@stop

