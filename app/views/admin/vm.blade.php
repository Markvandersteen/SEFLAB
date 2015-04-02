@extends('admin.master')

@section('scripts')
<script>
    $('.delete-loadscript').click(function (e) {
        var r = confirm("Are you sure you want to delete this loadscript?");
        if (!r) e.preventDefault();
    });

    $('.delete-virtualMachine').click(function (e) {
        var r = confirm("Are you sure you want to delete this VM?");
        if (!r) e.preventDefault();
    });

    @if (Session::has('errors'))
    $(function () {
        $('#uploadLoadscript').modal('toggle')
    });
    @endif
</script>
@stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-inbox"></i> Viewing VM</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Filename:</strong> {{ $virtualMachine->file_name }}
                <div class="pull-right">
                    <div class="btn-group">
                        <a href="{{ route('delete-virtualMachine', ['id' => $virtualMachine->id]) }}"
                           class="btn btn-default btn-xs delete-virtualMachine"><i class="fa fa-times"></i> Delete
                            virtual machine</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <strong>File size: </strong>{{ $virtualMachine->file_size }} bytes
                    </li>
                    <li>
                        <strong>Uploaded at: </strong>{{ $virtualMachine->created_at }}
                    </li>
                    <li>
                        <strong>Description: </strong>{{ $virtualMachine->vm_description}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Load scripts
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#uploadLoadscript"><i
                                class="fa fa-plus"></i> Upload loadscript
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive table-striped">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Action</th>
                            <th>Delete?</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($virtualMachine->loadScripts as $loadScript)
                        <tr>
                            <td>{{ $loadScript->file_name }}</td>
                            <td>{{ $loadScript->created_at }}</td>
                            <td>
                                <a href="{{ route('doAddQueue', $loadScript->id) }}" class="btn btn-primary"><i
                                        class="fa fa-th-list"></i> Run test</a>
                            </td>
                            <td>
                                <a href="{{ route('delete-loadscript', ['id' => $loadScript->id]) }}"
                                   class="btn btn-default btn-sm delete-loadscript"><i class="fa fa-times"></i>
                                    Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->


<!-- Modal -->
<div class="modal model-open fade" id="uploadLoadscript" tabindex="-1" role="dialog" aria-labelledby="uploadLoadScript"
     aria-hidden="true">
    {{ Form::open(['method'=>'post', 'files'=>true, 'class'=>'form-horizontal', 'action'=>'upload-loadscript']) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Upload additional loadscript</h4>
            </div>
            <div class="modal-body">

                @if(Session::has('errors'))
                <div class="alert alert-warning">
                    <ul>
                        @foreach(Session::get('errors')->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{ Form::hidden('virtualmachine_id', $virtualMachine->id)}}
                <div class="form-group">
                    {{ Form::label('file', 'Loadscript file', ['class'=> 'col-md-3 control-label']) }}
                    <div class="col-md-9">
                        {{ Form::file('file', ['class'=>'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>

@stop