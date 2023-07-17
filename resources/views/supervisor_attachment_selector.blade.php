@extends('layouts.supervisorlayout')
@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Attachments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach($data as $data)
            <?php
            $type=$data->type;

            ?>
            
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$data->type}}</h3>
                        <p>{{$data->date}}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day fa-fw"></i>

                    </div>
                    
                    <a href="{{route('Lec_view_submissions')}}" class="small-box-footer">Go to Attachment <i class="fas fa-arrow-circle-right"></i></a> 
                </div>
            </div>
            @endforeach
        </div>
</section>
@endsection