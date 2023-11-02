<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ URL::asset('css/results.css') }}">
    

    <title>Update Results</title>
</head>

<body>
    
    <div class="main-content">
        <div class="nav">
            <ul class="snip1168">
            <li> <a href="{{route('dashboard')}}">
                        <button> <i class="las la-angle-left"></i></button>
                    </a></li>
                <li class="current"><a href="#" data-hover="Update Results">Update Results</a></li>
                <li><a href="{{route('view_results')}}" data-hover="View Results">View Results</a></li>
            </ul>
        </div>

        
        <div class="overlay" id="new-exam">
            <div class="wrapper">

                <a id="close" href="#"><i class="las la-times"></i></a>

                <div class="content">
                    <div class="container">
                        <form method="post" action="{{ route('create_assessment') }}">
                            @csrf
                            <label for="ExamName">Assessment Name</label>
                            <input class="input" type="text" name="name" id="ExamName">

                            <label for="date">Date</label>
                            <input class="input" type="date" id="date" name="date">

                            <label for="MaxScore">Max Score</label>
                            <input class="input" type="number" id="MaxScore" name="MaxScore">

                            <label for="Weight">Weight (%)</label>
                            <input class="input" type="number" id="Weight" name="Weight">

                            <button type="submit" id="create-btn" name="submit">CREATE</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="choose-exam">
            <div class="col-2">
                <h2 id="choosehead1">Choose Assessment</h2>
                <hr />
                <form method="post" action="{{ route('fetch_assessment_details') }}" id="form1">
                    @csrf
                    <select class="input" id="ExamID" name="assessment_id">
                        <option value=""></option>
                        @foreach ($data as $data)
                        <option value="{{$data->assessment_id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" name="ExamChooser"><i class="las la-check"></i></button>
                </form>
            </div>
        </div>
        @if(null !== @$data2)
        @foreach($data2 as $data2)
        <?php
        $maximum = $data2->maximum;
        $assessment_id = $data2->assessment_id;
        $assessment_name = $data2->name;
        ?>
        @endforeach
        @endif

        <div class="record-marks">
            <h2>Student Results
                @if(null !== @$data2)
                - {{$assessment_name}}
                @endif
            </h2>
            <hr>

            <form action="{{ route('update_student_results') }}" method="post">
                @csrf
                <table>
                    <?php
                    $count = 1;
                    $check=1;
                    ?>

                    @foreach($data4 as $data4)
                    @if(null !== @$data4->value)
                    <?php
                    $check=0;
                    ?>
                    @endif

                    <tr>
                        <td>{{$data4->id}}</td>
                        <td>{{$data4->name}}</td>
                        <input type="hidden" name="student_id[{{$count}}]" value="{{$data4->id}}">
                        @if(null !== @$data2)
                        @if($check==0)
                        <td><input class="input" type="number" name="value[{{$count}}]" value="{{$data4->value}}"></td>
                        @else
                        <td><input class="input" type="number" name="value[{{$count}}]" value=""></td>
                        @endif
                        <td>/<?php echo $maximum; ?></td>
                        <input type="hidden" name="assessment_id[{{$count}}]" value="<?php echo $assessment_id; ?>">
                        @endif
                    </tr>

                    <?php $count++; 
                    ?>
                    @endforeach


                </table>
                <button type="submit" id="final_submit" name="result_submit">SUBMIT</button>

            </form>
        </div>
    </div>
</body>

</html>