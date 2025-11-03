@extends('layouts.admin')
@section('title', 'Employee Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Employee Lists</b></h4>
        <span class="pull-right">
        	{!! Html::decode(link_to_route('employees.download','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('employees.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>SI</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Action</th>
                        <th>Transfer/Promotion</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($employees as $data)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$data->name or ''}}</td>
                        <td>{{$data->designation->title or ''}}</td>
                        <td>{{$data->department->name or ''}}</td>
                        <td>{{$data->office_location->name or ''}}</td>
                        <td>{{$data->mobile or ''}}</td>
                        <td>{{$data->email or ''}}</td>
                        <td>
                          {!!  Html::decode(link_to_route('employees.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                           {!!  Html::decode(link_to_route('employee.view_employeeBaten', '<span aria-hidden="true" class="fa fa-eye fa-x"></span>', array($data->id)))!!}
                          {!! Form::delete(route('employees.destroy',array($data->id))) !!}
                                                                             
                        </td>
                        <td>
                          {!!  Html::decode(link_to_route('employees.transfer_promotion', '<span> Transfer/Promotion</span>', array($data->id)))!!}  
                        </td>
                      </tr>
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
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

