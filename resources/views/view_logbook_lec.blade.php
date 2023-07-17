@extends('layouts.supervisorlayout2')
@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Logbook</h1>
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

<section class="content ">
    <div class="container-fluid ">
        <div class="row">

            @foreach($data as $data)
            <h1 style="font-size: 20px; color: #0967B5;">{{$sname}} Dates: {{$data->date}} </h1>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Objectives
                    </h3>
                </div>
                <div class="card-body">

                    <p>
                        {{$data->objectives}}
                    </p>
                </div>
            </div>
        
    <div class="card card-row card-primary">
        <div class="card-header">
            <h3 class="card-title">
                Tasks
            </h3>
        </div>
        <div class="card-body">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>
                        {{$data->tasks}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-row card-primary">
        <div class="card-header">
            <h3 class="card-title">
                Lessons Learnt
            </h3>
        </div>
        <div class="card-body">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>
                        {{$data->lessons}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    </div>
    @endforeach
</section>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
    $(function() {

    })
</script>



@endsection