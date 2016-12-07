<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">

    <title>Dashboard</title>
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<section id="container" >
    <header class="header black-bg">
    <span class="sidebar-toggle-btn">
        <i class="fa fa-bars"></i>
    </span>
        <a class="logout-btn" href="{{route('logout')}}">Logout</a></li>
    </header>
    <div class="content-wrapper">
        <aside  class="nav-collapse">
            <ul class="sidebar-menu">

                <li>
                    <a class="active" href="{{route('admin.dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="" href="{{route('published_contract')}}">
                        <i class="fa fa-file-text"></i>
                        <span>Published Contracts</span>
                    </a>
                </li>
            </ul>
        </aside>


        <div class="content">