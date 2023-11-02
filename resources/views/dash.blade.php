@extends('layouts.supervisorlayout2')
@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Book Appointment</h1>
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
            <form action="{{route('booking.store')}} " method="post">
                @csrf
                <label for="name"> Appointment for Site Visit</label>
                <br>
                <textarea name="name" id="" cols="30" rows="10"></textarea>
                <br>
                <label for="meeting_time">Choose a time for the site visit</label>
                <input type="date" name="meeting_date">
                <input type="time" name="meeting_time">
                <br>
                <br>
                <input type="submit" value="Submit">
            </form>
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