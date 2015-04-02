@extends('admin.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Test results</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                List of test results
            </div>
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

                        @foreach($results as $result)
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

</div>
<!-- /.row -->

@stop