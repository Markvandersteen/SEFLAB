@extends('admin.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-th-list"></i> Queue</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Overview
                <div class="pull-right">
                    <div class="btn-group">
                        <a href="{{ route('vms-overview') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>
                            Add test</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive table-striped">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Loadscript</th>
                            <th>Virtualmachine</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($testsessions as $testsession)
                        <tr>
                            <td>{{ $testsession->loadscript_name }}</td>
                            <td>{{ $testsession->virtualmachine_name}}</td>
                            <td>{{ $testsession->date->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $testsession->status_formatted }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.row -->

@stop