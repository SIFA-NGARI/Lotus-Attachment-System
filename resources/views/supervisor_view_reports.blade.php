<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        table {
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            overflow: hidden;
            font-weight: bolder;
            margin: 10px auto;
        }

        table th {
            text-align: left;
        }

        table td {
            padding-top: 5px;
            padding: 10px 0;
            align-items: center;
            border-bottom: 1.1px solid #88654e;
        }

        table tbody td {
            padding-left: 10px;
        }

        table tbody tr:hover {
            /* background-color: #8c66534d; */
            color: #88654e;
            /* border-radius: 50px; */
            transition: 0.2s;
        }

        table td img {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 100px;
        }

        table input {
            width: 80px;
            padding: 5px;
        }
        button {
            background: rgb(56, 52, 52);
            border: 0px solid #fff;
            /* height: 45px; */
            width: max-content;
            font-size: 16px;
            font-weight: bold;
            border-radius: 20px;
            padding: 10px;
            box-sizing: border-box;
            outline: none;
            color: white;
            cursor: pointer;
            transition: .4s;
        }

        button:hover {
            color: rgb(150, 5, 5);
            background-color: white;
            border: 1px solid black;

        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/classes.css') }}">

    <title>Report Submissions</title>
</head>

<body>
    <div class="box">
        <h2>Submitted Reports</h2>
        <hr />
    </div>
    <table class="styled-table">
        <thead>
            <th>Student Number</th>
            <th>Student Name</th>
            <th>Date Submitted</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr class="active-row">
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->date}}</td>
                <td><a href="{{route('viewAssignmentSubmission',$data->report_id)}}"><button>View</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    <a href="{{route('dashboard')}}"> <button id="back_btn">BACK</button></a>
</body>