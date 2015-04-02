@extends('master')

@section('main')

<div class="modal-dialog login">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="text-center"><img src="/img/logo_seflab@2x.png" alt=""></h1>
        </div>
        <div class="modal-body">
            <div class="row">
                <form class="form col-md-12 center-block" name="sendCredentials" action="doSendCredentials"
                      method="post">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control input-lg" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg pull-right" type="submit" value="Submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop