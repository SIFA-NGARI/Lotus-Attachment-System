@extends('layouts.studentlayout')
@section('content')
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach($data2 as $data2)
            <?php
            $supervisor_id = $data2->supervisor_id;

            ?>
            @endforeach
            @foreach($data as $data)

            <a href="{{route('report_status_check',['attachment_id'=>$data->id,'supervisor_id'=> $supervisor_id, 'type'=>$data->type])}}">

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
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <!-- /.row -->
    </div>
</section>
@endsection