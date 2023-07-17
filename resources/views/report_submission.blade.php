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
            color: black;
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
            margin: 120px auto;
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
            color: #0967B5;
        }

        button {
            background: rgb(56, 52, 52);
            border: 0px solid #fff;
            margin-top: 10px;
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
            margin-left: 75%;
        }

        button:hover {
            color: rgb(150, 5, 5);
            background-color: white;
            border: 1px solid black;

        }

        .file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .file-input::before {
            content: 'UPLOAD FILE';
            display: inline-block;
            background: linear-gradient(top, #f9f9f9, #e3e3e3);
            border: 1px solid #0967B5;
            margin-left: 0px;
            margin-top: 4px;
            height: 30px;
            border-radius: 20px;
            padding: 0 10px;
            padding-top: 5px;
            width: 200px;
            box-sizing: border-box;
            outline: none;
            text-align: center;
            color: black;
            font-size: 15px;
            white-space: nowrap;
            user-select: none;
            -webkit-user-select: none;
            cursor: pointer;
        }

        .file {
            width: 205px;
        }
        .this{
            display: inline;
            display: flex;
            flex-direction: row;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        .this button{
            margin: 0;
            margin-left: 570%;
            height: 17px;
            padding-top: 1px;
           
        }
    </style>
    <title>Submission Details</title>
</head>

<body>
    <div class="overlay">
        <div class="wrapper">
            <a id="close" href="{{route('dashboard')}}"><i class="las la-times"></i></a>
            <div class="content">
                <div class="container">
                    <h1>Report Submission</h1>
                    <br />

                    <h2>Status:</h2>
                    <br />

                    @if($data->isEmpty())
                    <h3>No Submission</h3>
                    <br />
                    <h2>Submit:</h2>
                    <br />
                    <form action="{{route('submit_assignment')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="file">Upload File</label>
                        <div class="file">
                            <input class="file-input" type="file" id="file" name="file">
                        </div>
                        <br />

                        <button id="create-btn" name="create">SUBMIT</button>

                    </form>

                    @else
                    @foreach($data as $data)
                    <h3>Submitted</h3>
                    <br />
                    <h2>View Your Submission:</h2>
                    <br />
                    <div class="this">
                        <a href="{{route('viewAssignmentSubmission',$data->report_id)}}">Your Submission</a>
                        <form action="{{ route('delete_assignment') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->report_id}}">
                            <button type="submit" name="delete" class="del pull-right"><i class="las la-trash-alt"></i></button>
                        </form>
                    </div>
                    <br />
                    <h2>Edit Your Submission</h2>
                    <br />
                    <form action="{{route('edit_assignment3')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="file">Upload File</label>
                        <div class="file">
                            <input class="file-input" type="file" id="file" name="file">
                        </div>

                        <input type="hidden" name="id" value="{{$data->report_id}}">
                        <br />

                        <button id="create-btn" name="create">EDIT</button>
                    </form>
                    @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>

</body>

</html>