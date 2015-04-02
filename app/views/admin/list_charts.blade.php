@extends('admin.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Overview</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                List of virtual machines
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($virtualMachines as $virtualMachine)
                        <tr>
                            <td>{{ $virtualMachine->name }}</td>
                            <td><a href="{{ route('chart', $virtualMachine->id) }}" class="btn btn-primary"><i
                                        class="fa fa-bar-chart-o fa-fw"></i> View chart</a></td>
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