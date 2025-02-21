<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/img/favicon.png')}}" />

  <link href="../../../../css?family=Roboto:300,400,500,700,900" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css')}}" />

  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/all.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/fontawesome.min.css')}}" />


  <link rel="stylesheet" href="{{ asset('backend/plugins/morris/morris.css')}}" />

  <link rel="stylesheet" href="{{ asset('backend/css/style.css')}}" />
  <link rel="stylesheet" href="{{ asset('toastr/toastr.css') }}">

  <!-- DataTables CSS CDN -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

  <style>
    .table-responsiveness {
      white-space: nowrap;
      max-width: 100%;
    }

    .table-responsiveness {
      display: block !important;
      width: 100% !important;
      -webkit-overflow-scrolling: touch !important;
    }
  </style>
</head>

<body>
  <div class="main-wrapper">