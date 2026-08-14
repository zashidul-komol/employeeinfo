@extends('layouts.admin')
@section('title', 'Career Management Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Career Management</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="tabs">
    <ul class="nav nav-tabs">

        <li class="{{ request()->routeIs('employee-promotion-history.*') ? 'active' : '' }}">
            <a href="{{ route('employee-promotion-history.index') }}">
                <i class="fa fa-level-up"></i>
                Promotion List
            </a>
        </li>

        <li class="{{ request()->routeIs('employee-transfer-history.*') ? 'active' : '' }}">
            <a href="{{ route('employee-transfer-history.index') }}">
                <i class="fa fa-exchange"></i>
                Transfer List
            </a>
        </li>

        <li class="{{ request()->routeIs('employee-training-history.*') ? 'active' : '' }}">
            <a href="{{ route('employee-training-history.index') }}">
                <i class="fa fa-graduation-cap"></i>
                Training Details
            </a>
        </li>

    </ul>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Transfer Lists</b></h4>
        <span class="pull-right">
        	{!! Html::decode(link_to_route('employee-transfer-history.TransferListDownload','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
              <div class="table-responsive">
                <table id="basic-table"
                   class="data-table table table-striped nowrap table-hover"
                   cellspacing="0"
                   width="100%">

                <thead>
                    <tr>
                        <th>SI</th>
                        <th>Employee Name</th>
                        <th>Transfer Type</th>
                        <th>Previous Department</th>
                        <th>New Department</th>
                        <th>Previous Office Location</th>
                        <th>New Office Location</th>
                        <th>Previous Reporting To</th>
                        <th>New Reporting To</th>
                        <th>Effective Date</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @php($i = 1)

                    @foreach($employees as $employeeHistories)

                        @foreach($employeeHistories as $data)

                            <tr>

                                <td>
                                    {{ $i++ }}
                                </td>

                                <td>
                                    {{ $data->employee->name ?? '' }}

                                </td>

                                <td>
                                    {{ $data->transfer_type ?? '' }}
                                </td>

                                <td>
                                    {{ $data->previous_department->name ?? '' }}
                                </td>

                                <td>
                                    {{ $data->new_department->name ?? '' }}
                                </td>

                                <td>
                                    {{ $data->previous_office_location->name ?? '' }}
                                </td>

                                <td>
                                    {{ $data->new_office_location->name ?? '' }}
                                </td>

                                <td>
                                    {{ $data->previousReportingTo->name ?? '' }}

                                </td>

                                <td>
                                    {{ $data->newReportingTo->name ?? '' }}

                                </td>

                                <td>
                                    @if($data->effective_date)
                                        {{ \Carbon\Carbon::parse($data->effective_date)->format('d-m-Y') }}
                                    @endif
                                </td>

                                <td>
                                    @if($data->transfer_duration)
                                        {{ $data->transfer_duration->y }} Years,
                                        {{ $data->transfer_duration->m }} Months
                                    @endif
                                </td>

                                <td>

                                    {!! Html::decode(
                                        link_to_route(
                                            'employee-transfer-history.edit',
                                            '<span aria-hidden="true" class="fa fa-edit fa-x"></span>',
                                            [$data->id]
                                        )
                                    ) !!}

                                    {!! Html::decode(
                                        link_to_route(
                                            'employee.view_employeeBaten',
                                            '<span aria-hidden="true" class="fa fa-eye fa-x"></span>',
                                            [$data->employee_id]
                                        )
                                    ) !!}

                                    {!! Form::delete(
                                        route(
                                            'employee-transfer-history.destroy',
                                            [$data->id]
                                        )
                                    ) !!}

                                </td>

                            </tr>

                        @endforeach

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
