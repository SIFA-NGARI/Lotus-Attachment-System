<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            background-color: grey;
            padding: 20px;
        }

        .this {
            padding: 0;
            margin-left: 20px;
            width: 30.5%;
            min-width: 14rem;
            height: 20rem;
            border-radius: 0.3rem;
            background-color: white;
            color: black;
        }
    </style>
    <title>Document</title>
</head>

<body>
    @foreach($data as $data)

    <div style=" display:flex ; flex-direction: row;">
        <div class="this">
        <h1 style="background-color: white; ">Objectives:</h1>
            <p style="background-color: white;">{{$data->objectives}}</p>
        </div>
        <div class="this">
        <h1 style="background-color: white; ">Tasks Achieved:</h1>
            <p style="background-color: white;">{{$data->tasks}}</p>
        </div>
        <div class="this">
        <h1 style="background-color: white; ">Lessons Learned:</h1>
            <p style="background-color: white;">{{$data->lessons}}</p>
        </div>
        @if(1==@$data->seen)

        <div class="this">
        <h1 style="background-color: white; color:red">Feedback:</h1>
            <p style="background-color: white;">{{$data->comments}}</p>
        </div>
        @endif
      
    </div>
    @endforeach
    <a href="{{route('student_logbook_view')}}"><button type="submit" style="margin-left:92%; background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Back</button></a>
</body>

</html>