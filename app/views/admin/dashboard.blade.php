@extends('admin.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Latest VM upload</div>
                <div class="panel-body">
                    {{$latestVm->file_name}}
                    <a href="{{ route('vm', $latestVm->id) }}" class="btn btn-primary pull-right">View</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Latest Result</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Loadscript name</th>
                                <th>Virtual machine</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topThreeResult as $result)
                            <tr>
                                <td>{{ $result->loadscript_name }}</td>
                                <td>{{ $result->virtualmachine_name }}</td>
                                <td><a href="{{ route('chart', $result->id) }}" class="btn btn-primary"><i
                                            class="fa fa-bar-chart-o fa-fw"></i> View chart</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    @stop

