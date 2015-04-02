@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Upload</h1>
    </div>
</div>

<div class="row">
    <form class="form col-md-12" id="upload-form" name="upload" action="/doUpload" method="post"
          enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading">Upload</div>
            <div class="panel-body">
                <div class="row">
                    <!-- VM file upload-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vm" class="control-label">Virtual Box:</label>
                            <input type="file" name="vm" id="vm">

                            <p class="help-block">Should be a file with an ova extension.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!--Load script upload  -->
                    <div class="col-md-6">

                        <label for="script" class="control-label">Load script:</label>
                        <input type="file" name="script" id="script">

                        <p class="help-block">Only shell files (.sh).</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="vm_description" class="control-label" id="vm_label">Description:</label>
                        <textarea id="vm_description" name="vm_description" type="string" class="form-control"
                                  rows="5"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-success" id="bar" role="progressbar"></div>
                            <div class="percent">0%</div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div id="status" class="alert">

                            @if(Session::has('errors'))
                            <div class="alert alert-warning">
                                <ul>
                                    @foreach(Session::get('errors')->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit">
                <span id="waiting-message">Wacht tot het uploaden is voltooid...</span>
            </div>
        </div>
    </form>
</div>

@stop

@section('scripts')
<script src="/vendor/jquery.form.js"></script>
<script>
    $(function () {

        var $bar = $('#bar');
        var $percent = $('.percent');
        var $status = $('#status');
        var $form = $('#upload-form');
        var $submit = $('#submit');
        var $msg = $('#waiting-message');
        $msg.hide();

        $form.ajaxForm({
            beforeSend: function () {
                $status.empty();
                var percentVal = '0%';
                $bar.width(percentVal)
                $percent.html(percentVal);

                $submit.hide();
                $msg.show();
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                $bar.width(percentVal)
                $percent.html(percentVal);
            },
            complete: function (xhr, status) {

                var response = $.parseJSON(xhr.responseText);

                if (response.success) {
                    $bar.width("100%");
                    $percent.html("100%");
                    $status.addClass('alert-success');

                    setTimeout(function () {
                        window.location.href = "/vms/overview";
                    }, 500);

                } else {
                    $bar.width("0%");
                    $percent.html("0%");
                    $status.addClass('alert-warning');

                    $submit.show();
                    $msg.hide();
                }
                $status.text(response.message);

            }
        });

    });
</script>
@stop
