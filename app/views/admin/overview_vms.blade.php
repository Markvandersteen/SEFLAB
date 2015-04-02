@extends('admin.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-inbox"></i> My virtual machines</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Overview
            </div>
            <div class="panel-body">
                <div class="table-responsive table-striped">
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
                            <td>{{ $virtualMachine->file_name }}</td>
                            <td><a href="{{ route('vm', $virtualMachine->id) }}" class="btn btn-primary">View</a></td>

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