@extends('master')

@section('main')

<div class="modal-dialog login">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="text-center"><img src="/img/logo_seflab@2x.png" alt=""></h1>
        </div>
        <div class="modal-body">
            <div class="row">
                <form class="form col-md-12 center-block" name="login" action="/doLogin" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control input-lg" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg pull-right" type="submit" value="Submit">Sign In</button>
                        <a href="/rememberCredentials">inloggegevens vergeten?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop