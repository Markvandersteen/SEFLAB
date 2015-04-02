@extends('admin.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profile</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        {{ Form::model($user, ['class'=>'form-horizontal']) }}

        @if(Session::has('errors'))
        <div class="alert alert-warning">
            <ul>
                @foreach(Session::get('errors')->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(Session::has('success') && Session::get('success'))
        <div class="alert alert-success">
            Profile updated.
        </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                Edit profile
                <div class="pull-right">
                    <div class="btn-group">
                        <button onclick="confirmDelete()" type="button" class="btn btn-default btn-xs">Delete</button>

                        <script>
                            function confirmDelete() {
                                var r = confirm("Wil dit account echt verwijderen?");
                                if (r == true) {
                                    window.location.href = "profile/delete";
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>

            <div class="panel-body">

                <div class="form-group">
                    {{ Form::label('first_name', 'First name', ['class'=> 'col-sm-2 col-md-2 control-label']) }}
                    <div class="col-sm-10 col-md-6">
                        {{ Form::text('first_name', $user->first_name,['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('last_name', 'Last name', ['class'=> 'col-sm-2 col-md-2 control-label']) }}
                    <div class="col-sm-10 col-md-6">
                        {{ Form::text('last_name', $user->last_name,['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email Address', ['class'=> 'col-sm-2 col-md-2 control-label']) }}
                    <div class="col-sm-10 col-md-6">
                        {{ Form::text('email', $user->email,['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('phone', 'Phone', ['class'=> 'col-sm-2 col-md-2 control-label']) }}
                    <div class="col-sm-10 col-md-6">
                        {{ Form::text('phone', $user->phone,['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('company', 'Company', ['class'=> 'col-sm-2 col-md-2 control-label']) }}
                    <div class="col-sm-10 col-md-6">
                        {{ Form::text('company', $user->company,['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('password1', 'New password', ['class'=> 'col-sm-2 col-md-2 control-label']) }}
                    <div class="col-sm-10 col-md-6">
                        {{ Form::password('password1', ['class'=>'form-control'])}}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('password2', 'Confirm password', ['class'=> 'col-sm-2 col-md-2 control-label']) }}
                    <div class="col-sm-10 col-md-6">
                        {{ Form::password('password2', ['class'=>'form-control'])}}
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>


@stop