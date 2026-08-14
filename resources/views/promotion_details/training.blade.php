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
        	{!! Html::decode(link_to_route('employee-training-history.TrainingListDownload','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
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
                        <th>Training Name</th>
                        <th>Training Type</th>
                        <th>Trainer</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration</th>
                        <th>Training Location</th>
                        <th>Status</th>
                        <th>Certificate</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @php($i = 1)

                        @foreach($trainings as $data)

                            <tr>

                                {{-- SI --}}
                                <td>
                                    {{ $i++ }}
                                </td>

                                {{-- Employee --}}
                                <td>
                                    {{ $data->employee->name ?? '' }}
                                </td>

                                {{-- Training Name --}}
                                <td>
                                    {{ $data->training_name ?? '' }}
                                </td>

                                {{-- Training Type --}}
                                <td>
                                    {{ $data->training_type ?? '' }}
                                </td>

                                {{-- Training Provider --}}
                                <td>
                                    {{ $data->training_provider ?? '' }}
                                </td>

                                {{-- Start Date --}}
                                <td>
                                    @if($data->start_date)
                                        {{ \Carbon\Carbon::parse($data->start_date)->format('d-m-Y') }}
                                    @endif
                                </td>

                                {{-- End Date --}}
                                <td>
                                    @if($data->end_date)
                                        {{ \Carbon\Carbon::parse($data->end_date)->format('d-m-Y') }}
                                    @endif
                                </td>

                                {{-- Duration --}}
                                <td>
                                    {{ $data->duration ?? '' }}
                                </td>

                                {{-- Training Location --}}
                                <td>
                                    {{ $data->training_location ?? '' }}
                                </td>

                                {{-- Status --}}
                                <td>
                                    {{ $data->status ?? '' }}
                                </td>

                                {{-- Certificate --}}
                                <td>
                                    @if($data->certificate_path)

                                        <a href="{{ asset('storage/' . $data->certificate_path) }}"
                                           target="_blank"
                                           class="btn btn-xs btn-info">

                                            <i class="fa fa-file"></i>
                                            View

                                        </a>

                                    @else

                                        <span class="text-muted">
                                            N/A
                                        </span>

                                    @endif
                                </td>
                                {{-- Action --}}
                                <td>

                                    {!! Html::decode(
                                        link_to_route(
                                            'employee-training-history.edit',
                                            '<span aria-hidden="true" class="fa fa-edit fa-x"></span>',
                                            [$data->id]
                                        )
                                    ) !!}

                                    {!! Form::delete(
                                        route(
                                            'employee-training-history.destroy',
                                            [$data->id]
                                        )
                                    ) !!}

                                </td>

                            </tr>

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
