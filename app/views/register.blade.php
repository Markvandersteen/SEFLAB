@extends('master')
@section('main')

<div class="modal-dialog register">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="text-center"><img src="/img/logo_seflab@2x.png" alt=""></h1>
        </div>
        <div class="modal-body">
            <div class="row">
                <form class="form col-md-12 center-block" id="registration" method='post' action='doRegister'>
                    <fieldset>
                        <legend>Registratie formulier</legend>
                        <div class="control-group">
                            <label class="control-label">Username:</label>

                            <div class="controls">
                                <input type="text" class="form-control input-sm" id="username" name="username">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password:</label>

                            <div class="controls">
                                <input type="password" class="form-control input-sm" id="password" name="password1">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password:</label>

                            <div class="controls">
                                <input type="password" class="form-control input-sm" id="password" name="password2">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Email</label>

                            <div class="controls">
                                <input type="text" class="form-control input-sm" id="email" name="email">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Voornaam</label>

                            <div class="controls">
                                <input type="text" class="form-control input-sm" id="firstname" name="firstname">
                            </div>
                            <div class="control-group">
                                <label class="control-label">Achternaam</label>

                                <div class="controls">
                                    <input type="text" class="form-control input-sm" id="lastname" name="lastname">
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Bedrijf</label>

                                    <div class="controls">
                                        <input type="text" class="form-control input-sm" id="company" name="company">
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Telefoon</label>

                                        <div class="controls">
                                            <input type="text" class="form-control input-sm" id="phone" name="phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"></label>

                            <div class="controls">
                                <button type="submit" class="btn btn-primary btn-lg pull-right">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop