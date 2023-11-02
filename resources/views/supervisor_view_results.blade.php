<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <link rel="stylesheet" href="{{ URL::asset('css/results.css') }}">

    <title>View Results</title>
</head>

<body>
    
    <div class="main-content">
        <div class="nav">
            <ul class="snip1168">
            <li> <a href="{{route('dashboard')}}">
                        <button> <i class="las la-angle-left"></i></button>
                    </a></li>
                <li><a href="{{route('update_results')}}" data-hover="Update Results">Update Results</a></li>
                <li class="current"><a href="#" data-hover="View Results">View Results</a></li>
            </ul>
        </div>
        <div class="record-marks">
            <h2>Student Results</h2>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>Adm No</th>
                        <th>Name</th>
                        <?php
                        $examsCount = count($data6);
                        ?>
                        @foreach($data6 as $data6)
                        <th>{{$data6->name}}</th>
                        @endforeach
                        <th>Total</th>
                        
                    </tr>
                </thead>

                @foreach($data4 as $data4)
                <?php
                $data5 = DB::table('student_results')
                    ->join('assessments', 'student_results.assessment_id', '=', 'assessments.assessment_id')
                    ->where('student_id', '=', $data4->id)
                    ->where('assessments.supervisor_id', '=', Auth::user()->id)
                    ->select('student_results.value', 'assessments.maximum', 'assessments.weight')->get();
                ?>
                <tr>
                    <td>{{$data4->id}}</td>
                    <td>{{$data4->name}}</td>
                    <?php
                        $resultCount = count($data5);
                        $total=0;
                        ?>
                    @foreach($data5 as $data5)
                    <td>{{$data5->value}} / {{$data5->maximum}}</td>
                    <?php
                    $total2=($data5->value * $data5->weight)/$data5->maximum;
                    $total=number_format($total2,2);
                    ?>
                    @endforeach
                    @while($resultCount<$examsCount)
                    <td>Not Updated</td>
                    <?php $resultCount++?>
                    @endwhile
                    <td>{{$total}} / 100</td>
                    <td>
                        <form action="{{ route('edit_student_results')}}" method="POST">
                            @csrf
                            <button name="Edit">Edit</button>
                            <input type="hidden" name="student_id" value="{{$data4->id}}">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
</body>

</html>