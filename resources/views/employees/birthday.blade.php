@extends('layouts.admin')
@section('title', 'Employee Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee</a></li>
            <li><a>Birthday</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Employees Birthday : {{$CurMonth}} - {{$CurYear}}</b></h4>
        <span class="pull-right">
          {!! Html::decode(link_to_route('employees.birthday','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            
        </span>
        {{ Form::model(request()->old(),array('route' => array('employees.birthday'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Mobile</th>
                        <th>DOB</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($results as $data)
                      <tr>
                        <td>{{$data->name or ''}}</td>
                        <td>{{$data->designation->title or ''}}</td>
                        <td>{{$data->department->name or ''}}</td>
                        <td>{{$data->office_location->name or ''}}</td>
                        <td>{{$data->mobile or ''}}</td>
                        <td>{{$data->birthdate or ''}}</td>
                      </tr>
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary"> Submit</button>
          </div>
      </div>
      {{ Form::close() }}
    </div>
</div>
@endsection
@component('common_pages.data_table_script')
<script>
  $(function(){
      "use strict";
      $('.data-table').DataTable({
        "order": [], /* No ordering applied by DataTables during initialisation */
      });
  });
</script>
@endcomponent

