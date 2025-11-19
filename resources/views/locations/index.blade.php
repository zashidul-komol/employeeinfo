@extends('layouts.admin')
@section('title', 'Location Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Location</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@include('locations.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        @include('locations.subtitle')
        <span class="pull-right">
          {!! Html::decode(link_to_route('locations.download','<i class="fa fa-download" aria-hidden="true"></i>',[$param],array('class'=>'btn btn-success btn-right-side'))) !!}
            {!! Html::decode(link_to_route('locations.create','<i class="fa fa-plus"></i>',[$param],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>SI NO.</th>
                            <th>Division</th>
                            @if ($param=='1')
                            	<th>District</th>
                            @elseif($param=='2')
                            	<th>District</th>
                            	<th>Thana</th>
                            @endif
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i=1)
                          @foreach ($locations as $data)
                          <tr>
                            <td>{{$i}}</td>
                             @if ($param=='1')
                            	<td>{{$data->parent->name ?? ''}}</td>
                            @elseif($param=='2')
                            	<td>{{$data->parent->parent->name ?? ''}}</td>
                            	<td>{{$data->parent->name ?? ''}}</td>
                            @endif
                            <td>{{$data->name}}</td>
                            <td>
                              {!!  Html::decode(link_to_route('locations.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id,$param?$param:'')))!!}
                            
                              <form action="{{ route('locations.destroy', array($data->id,'level'=>$param)) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this location?')">Delete</button>
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

