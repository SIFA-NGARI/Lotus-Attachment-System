@extends('layouts.studentlayout2')
@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Logbooks</h1>
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
                        <th>Date Submitted</th>
                        <th>View Logbook</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                   
                    <tr>
                        <td>{{$data->date}}</td>
                        <td><a href="{{route('view_logbook_student', ['id'=> $data->id])}}"><button>View</button></a></td>
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