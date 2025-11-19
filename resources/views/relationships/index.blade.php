@extends('layouts.admin')
@section('title', 'Child Details Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Child Details</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Child Details Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('employees.familyDetailsdownload','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('childDetails.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>SI NO.</th>
                        <th>Employee Name</th>
                        <th>Son/Daughter Name</th>
                        <th>Birth Date</th>
                        <th>Gender</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($childDetails as $data)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$data->employees->name ?? ''}}</td>
                        <td>{{$data->child_name ?? ''}}</td>
                        <td>{{$data->date_of_birth ?? ''}}</td>
                        <td>{{$data->gender ?? ''}}</td>
                        <td>
                          {!!  Html::decode(link_to_route('childDetails.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                        
                          <form action="{{ route('childDetails.destroy', array($data->id)) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this childDetail?')">Delete</button>
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

