<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $title or 'Seflab' }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.png">
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/vendor/sb-admin-v2/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="/vendor/sb-admin-v2/css/sb-admin.css">
        <link rel="stylesheet" href="/css/main.css">
        <script src="/vendor/modernizr-2.6.2.min.js"></script>
        @yield('stylesheets')
    </head>
    <body class="{{ Route::getCurrentRoute()->getName() }}">
    @yield('main')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/vendor/jquery-1.10.2.min.js"><\/script>')</script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendor/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/vendor/sb-admin-v2/js/sb-admin.js"></script>
    @yield('scripts')
  </body>
</html>