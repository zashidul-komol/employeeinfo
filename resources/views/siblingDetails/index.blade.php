@extends('layouts.admin')
@section('title', 'Sibling Details Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Sibling Details</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Sibling Details List</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('siblingDetails.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>SI NO.</th>
                        <th>Employee Name</th>
                        <th>Sibling Name</th>
                        <th>Occupation</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php ($i=1)
                        @foreach ($siblingDetails as $data)
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$data->employees->name ?? ''}}</td>
                        <td>{{$data->sibling_name ?? ''}}</td>
                        <td>{{$data->occupation ?? ''}}</td>
                        <td>{{$data->gender ?? ''}}</td>
                        <td>{{$data->age ?? ''}}</td>
                        <td>
                          {!!  Html::decode(link_to_route('siblingDetails.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
                          {!! Form::delete(route('siblingDetails.destroy',array($data->id))) !!}
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

