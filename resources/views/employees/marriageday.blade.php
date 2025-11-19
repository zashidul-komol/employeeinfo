@extends('layouts.admin')
@section('title', 'Employee Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee</a></li>
            <li><a>Marriage Day</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Employees Marriageday : {{$CurMonth}} - {{$CurYear}} </b></h4>
        <span class="pull-right">
          {!! Html::decode(link_to_route('employees.marriageday','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            
        </span>
        {{ Form::model(request()->old(),array('route' => array('employees.marriageday'),'enctype'=>'multipart/form-data','class'=>'form-horizontal')) }}
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Polar ID</th>
                        <th>Name</th>
                        <th>Spouse Name</th>
                        <th>Spouse Mobile</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Mobile</th>
                        <th>Marriage Day</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($results as $data)
                      <tr>
                        <td>{{$data->employees->polar_id ?? ''}}</td>
                        <td>{{$data->employees->name ?? ''}}</td>
                        <td>{{$data->wife_name ?? ''}}</td>
                        <td>{{$data->spouse_mobile ?? ''}}</td>
                        <td>{{$data->employees->designation->title ?? ''}}</td>
                        <td>{{$data->employees->department->name ?? ''}}</td>
                        <td>{{$data->employees->mobile ?? ''}}</td>
                        <td>{{$data->marriage_date ?? ''}}</td>
                      </tr>
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                </table>
              </div>
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

