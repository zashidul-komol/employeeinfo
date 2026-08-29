@extends('layouts.admin')

@section('title', 'Upload Training History')

@section('content')

<div class="content-header">

    <div class="leftside-content-header">

        <ul class="breadcrumbs">

            <li>
                <i class="fa fa-table" aria-hidden="true"></i>
                <a href="#">Training History</a>
            </li>

            <li>
                <a>Import</a>
            </li>

        </ul>

    </div>

</div>


<div class="row animated fadeInRight">

    <div class="col-sm-12">

        <h4 class="section-subtitle">
            <b>Training History Import</b>
        </h4>


        <span class="pull-right">

            {!! Html::decode(
                link_to_route(
                    'employee-training-history.index',
                    '<i class="fa fa-list"></i>',
                    [],
                    [
                        'class' => 'btn btn-success btn-right-side'
                    ]
                )
            ) !!}

        </span>


        <div class="panel">

            <div class="panel-content">

                {{ Form::open([
                    'route' => 'employee-training-history.uploadTraining',
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal'
                ]) }}


                <div class="form-group">

                    {{ Form::label(
                        'file',
                        'Browse Training Excel:',
                        [
                            'class' => 'control-label col-sm-2'
                        ]
                    ) }}


                    <div class="col-md-6">

                        {{ Form::file('file', [
                            'class' => 'form-control'
                        ]) }}


                        {!! $errors->first(
                            'file',
                            '<p class="text-danger">:message</p>'
                        ) !!}

                    </div>

                </div>


                <div class="form-group">

                    <div class="col-md-6 col-md-offset-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="fa fa-upload"></i>

                            Upload Training Information

                        </button>

                    </div>

                </div>


                {{ Form::close() }}

            </div>

        </div>

    </div>

</div>

@endsection