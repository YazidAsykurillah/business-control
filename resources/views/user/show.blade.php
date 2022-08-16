@extends('adminlte::page')

@section('title', 'Employee :: '.$user->name.'')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Employee Detail</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="/home"><i class="fas fa-home"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="/user">Employees</a></li>
                <li class="breadcrumb-item active">{{ $user->id }}</li>
            </ol>
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <!--General Information-->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">General Information</h3>
                </div>
                <div class="card-body">
                    <strong>Code</strong>
                    <p class="text-muted">
                      {{ $user->code }}
                    </p>
                    <hr>

                    <strong>Name</strong>
                    <p class="text-muted">
                      {{ $user->name }}
                    </p>
                    <hr>

                    <strong>Email</strong>
                    <p class="text-muted">
                      {{ $user->email }}
                    </p>
                    <hr>
                </div>
            </div>
        </div>
        <!--END General Information-->

        <!--Roles Information-->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Roles Information</h3>
                </div>
                <div class="card-body">
                @if($user->roles->count())
                    @foreach($user->roles as $role)
                    <span class="badge bg-info">{{ $role->name }}</span>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
        <!--ENdRoles Information-->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('js')
    <script type="text/javascript">
        $('#manage-user-menu').find('.nav-link').addClass('active');
    </script>
@stop
