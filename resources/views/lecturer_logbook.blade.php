@extends('layouts.supervisorlayout2')
@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Student Logbooks</h1>
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

<section class="content">
    <div class="container-fluid">

        <!-- /.card-header -->
        <div class="card-body">
            <table id="this" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Student Number</th>
                        <th>Student Name</th>
                        <th>Date Submitted</th>
                        <th>View Logbook</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <?php
                    $fname = DB::table('users')->where('id', '=', $data->student_id)->get();
                    foreach ($fname as $fname) {
                        $sname = $fname->name;
                        $id = $fname->id;
                    }
                    ?>
                    <tr>
                        <td>{{$id}}</td>
                        <td>{{$sname}}</td>
                        <td>{{$data->date}}</td>
                        <td><a href="{{route('view_logbook_lec', ['id'=> $data->id, 'sname'=> $sname])}}"><button>View</button></a></td>
                        <td><a href="{{route('comment_logbook',['id'=> $data->id, 'sname'=> $sname])}}"><button>Comment</button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

</section>
<script>
    import DataTable from 'datatables.net-dt';
    import 'datatables.net-responsive-dt';

    let table = new DataTable('#this', {
        // config options...
        responsive: true,
        paging: true,
        searching: true,
        ordering: true
    });
    $(document).ready(function() {
        $('#this').DataTable();
    });
</script>
@endsection