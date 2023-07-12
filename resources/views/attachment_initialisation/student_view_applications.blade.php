<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">

    <link rel="stylesheet" href="{{ URL::asset('css/results.css') }}">

    <style>
        body {
            margin: 2em;
        }

        #snip1168 {
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }

        #snip1168 * {
            box-sizing: border-box;
        }

        #snip1168 li {
            display: inline-block;
            list-style: outside none none;
            margin: 10px 10px 5px;
            padding: 0;
        }

        #this {
            padding: 0.5em 0;
            color: #8c6653;
            position: relative;
            letter-spacing: 1px;
            text-decoration: none;
        }
        #this1 {
           
            color: #8c6653;
          
        }
        #this1:hover{
            color: black;
        }

        #this:before,
        #this:after {
            position: absolute;
            -webkit-transition: all 0.35s ease;
            transition: all 0.35s ease;
        }

        #this:before {
            top: 0;
            display: block;
            height: 3px;
            width: 0%;
            content: "";
            background-color: #8c6653;
        }

        #this:after {
            left: 0;
            top: 0;
            padding: 0.35em 0;
            position: absolute;
            content: attr(data-hover);
            color: black;
            white-space: nowrap;
            max-width: 0%;
            overflow: hidden;
        }

        #this:hover:before,
        #snip1168 .current a:before {
            opacity: 1;
            width: 100%;
        }

        #this:hover:after,
        #snip1168 .current a:after {
            max-width: 100%;
        }

        #status{
            padding: 0;
            font-size: 30px;
            text-align: center;
        }
        .status{
            
            margin-right: 1em;
        }
    </style>

    <title>View Attachment Applications</title>
</head>

<body>
    <div class="main-content">

        <table id="example" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Attachment Type</th>
                    <th>Organisation Details</th>
                    <th>Attachment Details</th>
                    <th>Status</th>
                    @foreach($data2 as $data2)
                    @if(2==@$data2->status)
                    <th>Reject Comments</th>
                    @endif
                    @endforeach
                </tr>
            </thead>
            @foreach($data as $data)
            <tbody>
                <tr>
                    <td>{{$data->type}}</td>
                    <td><a id="this1" href="{{ route('student_view_organization_details' ,$data->id)}}">View Details</a></td>
                    <td><a id="this1" href="{{ route('student_view_organization_details' ,$data->id)}}">View Details</a></td>
                    @if(1==@$data->status)
                    <td>Accepted</td>
                    @elseif(0==@$data->status)
                    <td>Pending</td>
                    @elseif(2==@$data->status)
                    <td>Rejected</td>
                    <td><a id="this1" href="{{ route('student_view_reject_comments',$data->id)}}">View Comments</a></td>
                    @endif
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</body>

</html>