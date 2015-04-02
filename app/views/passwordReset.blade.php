@extends('master')
@section('main')

<div class="modal-dialog register">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="text-center"><img src="/img/logo_seflab@2x.png" alt=""></h1>
        </div>

        <div class="modal-body">
            <div class="row">

                <fieldset>
                    <legend>Password recovery</legend>

                    <form action="{{ action('RemindersController@postReset') }}" method="POST">


                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="control-group">
                            <label class="control-label">Email:</label>

                            <div class="controls">
                                <input type="email" class="form-control input-sm" placeholder="email" name="email">
                            </div>


                            <div class="control-group">
                                <label class="control-label">Password:</label>

                                <div class="controls">
                                    <input type="password" class="form-control input-sm" placeholder="password"
                                           name="password">
                                </div>
                                <div class="control-group">
                                    <label class="control=label">Password confirm:</label>

                                    <div class="controls">
                                        <input type="password" class="form-control input-sm"
                                               placeholder="passwordConfirm" name="password_confirmation">
                                    </div>

                                    <br>

                                    <div class="controls">
                                        <button type="submit" value="Reset Password"
                                                class="btn btn-primary btn-lg pull-right">Reset password
                                        </button>
                                    </div>


                    </form>
                </fieldset>
            </div>
        </div>
    </div>
    @stop

