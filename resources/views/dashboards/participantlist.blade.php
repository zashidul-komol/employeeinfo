@extends('layouts.admin')
@section('title', 'Participant Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Participant</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="{{'active'}}"><a href="{{ route('dashboards.participantlist') }}">Participant List</a></li>
        <li><a href="{{ route('employees.totalparticipantlist') }}">Child Participant List</a></li>
    </ul>
</div>
@if(!empty($employeeID))
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Participant Lists</b></h4>
        <span class="pull-right">
        	{!! Html::decode(link_to_route('employees.participantListdownload','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
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
                        <th>Location</th>
                        <th>Employee NID</th>
                        <th>Spouse NID</th>
                        <th>T-Shirt</th>
                        <th>Room No.</th>
                        <th>Key Delivery</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        @php ($i=1)
                        @foreach ($employees as $data)

                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$data->employees->name or ''}}</td>
                        <td>{{$data->employees->designation->title or ''}}</td>
                        <td>{{$data->employees->office_location->name or ''}}</td>
                        <td><a href="{{ asset('storage/Employee_nid/'.$data->employee_nid) }}" target="_blank">{{$data->employee_nid or ''}}</td>
                        <td><a href="{{ asset('storage/Spouse_nid/'.$data->spouse_nid) }}" target="_blank">{{$data->spouse_nid or ''}}</td>    
                        <td>{{$data->tshirt or ''}}</td>
                        <td>{{$data->room_one.','.$data->room_two}}</td>
                        <td>{{$data->room_one_key.','.$data->room_two_key}}</td>
                        <td>
                          <a class="fa fa-eye fa-x" onclick="showModal({{ $data->id }})"></a>
                          <a class="fa fa-key fa-x" onclick="showModalTwo({{ $data->id }})"></a>
                                                                               
                        </td>
                      </tr>
                        @php ($i=$i+1)
                        @endforeach
                    </tbody>
                    
                </table>
              </div>
            </div>
        </div>
        <!-- Modal for problem entry start-->
        @include('common_pages.common_modal',['modalTitle'=>'Business Meet-2023 Participant', 'modalSize'=>'modal-lg'])
         <!-- Modal for problem entry end-->
    </div>
</div>
@endif
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

@section('vuescript')
<script>
        function showModal(id,){
            laravelObj.common=id;
            var modalBody=$('#modal-body');
            modalBody.css('padding-top',0);
            modalBody.html('');
            $.ajax({
                type: 'Get',
                url:"{{ route('ajax.bm.getBMParticipantDetails') }}",
                data:{id:id}
            }).done(function(response) {
                 modalBody.html(response);
                 $.fn.select2.defaults.set( "theme", "bootstrap" );
                 $(".select2").select2({
                     placeholder: function(){
                         $(this).data('placeholder');
                     },
                    allowClear: true
                });
            }).fail(function(response) {
                console.log(response);
            });
            $('#common-modal').modal('show');
        };

        function showModalTwo(id,){
            laravelObj.common=id;
            var modalBody=$('#modal-body');
            modalBody.css('padding-top',0);
            modalBody.html('');
            $.ajax({
                type: 'Get',
                url:"{{ route('ajax.key.getBMKeyDelivery') }}",
                data:{id:id}
            }).done(function(response) {
                 modalBody.html(response);
                 $.fn.select2.defaults.set( "theme", "bootstrap" );
                 $(".select2").select2({
                     placeholder: function(){
                         $(this).data('placeholder');
                     },
                    allowClear: true
                });
            }).fail(function(response) {
                console.log(response);
            });
            $('#common-modal').modal('show');
        };

      
    </script>
@stop

@slot('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap.min.css') }}">
@endslot

@include('common_pages.max_length')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endcomponent
