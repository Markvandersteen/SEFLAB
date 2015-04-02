@extends('admin.master')

@section('scripts')
    <script>
        var JSON_RAW_VALUES = {{ json_encode($values) }};
    </script>

    <script src="/vendor/flot/jquery.flot.min.js"></script>
    <script src="/vendor/flot/jquery.flot.resize.min.js"></script>
    <script src="/js/chart.js"></script>
@stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Viewing chart</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Volt (V)
            </div>
            <div class="panel-body">
                <div id="volt-chart" class="chart"></div>
            </div>
        </div>
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ampere (I)
            </div>
            <div class="panel-body">
                <div id="ampere-chart" class="chart"></div>
            </div>
        </div>
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Watt (W)
            </div>
            <div class="panel-body">
                <div id="watt-chart" class="chart"></div>
            </div>
        </div>
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.row -->

@stop