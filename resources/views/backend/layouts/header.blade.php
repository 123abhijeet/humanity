<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

  <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/img/sat_logo.png')}}" />

  <link href="../../../../css?family=Roboto:300,400,500,700,900" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css')}}" />

  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/all.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/fontawesome.min.css')}}" />

  <link rel="stylesheet" href="{{ asset('backend/css/fullcalendar.min.css')}}" />

  <link rel="stylesheet" href="{{ asset('backend/css/dataTables.bootstrap4.min.css')}}" />

  <link rel="stylesheet" href="{{ asset('backend/plugins/morris/morris.css')}}" />

  <link rel="stylesheet" href="{{ asset('backend/css/style.css')}}" />
  <link rel="stylesheet" href="{{ asset('toastr/toastr.css') }}">
  <!--[if lt IE 9]>
      <script src="{{ asset('backend/js/html5shiv.min.js')}}"></script>
      <script src="{{ asset('backend/js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>
  <div class="main-wrapper">
  