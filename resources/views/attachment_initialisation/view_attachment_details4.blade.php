<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap');

        html {
            font-size: 15px;
            font-family: "Titillium";
        }

        * {
            padding: 0;
            margin: 0;
        }

        a {
            color:#0967B5;
        }

        a:hover {
            color: black;
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: black;
            transition: opacity 500ms;
            visibility: visible;
            opacity: 1;
            z-index: 1;
        }

        .overlay .wrapper {
            margin: 50px auto;
            padding: 20px;
            background: #e7e7e7;
            border-radius: 5px;
            width: 30%;
            position: relative;
            transition: all .4s ease-in-out;
        }

        .overlay .wrapper .content {
            max-height: 30%;
            overflow: auto;
        }

        .overlay .container {
            border-radius: 5px;
            background-color: #e7e7e7;
            padding: 20px 0;
        }

        .overlay #close {
            color: rgb(163, 8, 8);
            float: right;
            transition: .4s;
        }

        .overlay #close:hover {
            color: black;
        }

        hr {
            border-top: 3px solid black;
        }

        h2 {
            color:#0967B5;
        }
    </style>
    <title>View Attachment Details</title>
</head>

<body>
    <div class="overlay">
        <div class="wrapper">
            <a id="close" href="{{route('lec_view_attachments')}}"><i class="las la-times"></i></a>
            <div class="content">
                @foreach($data as $data)
                <div class="container">
                    <h2>Organisation Details:</h2>
                    <hr>
                    <h3>{{$data->description}}</h3>
                    <br />
                    <h2>Attachment Dates:</h2>
                    <hr>
                    <h3>{{$data->date}}</h3>
                    <br />
                    <h2>Hours Per Week:</h2>
                    <hr>
                    <h3>{{$data->hours}}</h3>
                    <br />
                    <h2>Anticipated Activities:</h2>
                    <hr>
                    <h3>{{$data->activities}}</h3>
                    <br />
                    <h2>Anticipated Skills:</h2>
                    <hr>
                    <h3>{{$data->skills}}</h3>

                </div>
                @endforeach
            </div>
        </div>
    </div>


</body>

</html>