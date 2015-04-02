@extends('master')

@section('main')
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="text-center">Login</h1>
            </div>
            <div class="modal-body">
                <form class="form col-md-12 center-block" name="login" action="/doLogin" method="post">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control input-lg" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control input-lg" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">Sign In</button>

                    </div>

            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <a href="/" class="btn btn-primary btn-large">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@stop