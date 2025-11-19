@extends('layouts.admin')
@section('title', 'Employee Education Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Employee Education</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Employee Education List</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('employeeEducations.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>SI NO.</th>
                        <th>Employee Name</th>
                        <th>Name of Degree</th>
                        <th>Institution</th>
                        <th>Passing Year</th>
                        <th>Result</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($employeeEducations as $data)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$data->employees->name ?? ''}}</td>
                        <td>{{$data->last_education ?? ''}}</td>
                        <td>{{$data->institution ?? ''}}</td>
                        <td>{{$data->passing_year ?? ''}}</td>
                        <td>{{$data->result ?? ''}}</td>
                        <td>
                          {!!  Html::decode(link_to_route('employeeEducations.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}

                          <form action="{{ route('employeeEducations.destroy', $data->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this employeeEducation?')">Delete</button>
                          </form>
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

