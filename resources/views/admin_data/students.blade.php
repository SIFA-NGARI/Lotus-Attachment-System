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
            color: #0967B5;
            position: relative;
            letter-spacing: 1px;
            text-decoration: none;
        }

        #this1 {

            color: #0967B5;

        }

        #this1:hover {
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
            background-color: #0967B5;
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

        #status {
            text-align: center;
        }

        .status {

            margin-right: 1em;
        }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=showMap"></script>


    <title>Accepted Applications</title>
</head>

<body>
    <div class="main-content">

        <div class="nav">
            <ul id="snip1168">
            <li> <a href="{{route('dashboard')}}">
                        <button> <i class="las la-angle-left"></i></button>
                    </a></li>
                <li><a id="this" href="{{ route('view_applications') }}" data-hover="View Applications"> View Applications</a></li>
                <li class="current"><a id="this" href="#" data-hover="Accepted Applications">Accepted Applications</a></li>
                <li><a id="this" href="{{ route('rejected_applications') }}" data-hover="Rejected Applications">Rejected Applications</a></li>
            </ul>
        </div>
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Organisation Name</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Attachment Details</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            @foreach($data as $data)

            <?php
            $lat = $data->address_latitude;
            $long = $data->address_longitude;
            ?>
            <tbody>
                <tr onclick="showMap(<?php echo $lat ?>,<?php echo $long ?>)">
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->org_name}}</td>
                    <td>{{$lat}}</td>
                    <td>{{$long}}</td>
                    <td><a id="this1" href="{{ route('view_attachment_details',$data->id)}}">View Details</a></td>
                    <td>Accepted</td>
                    <td id="status"><a class="status" id="this1" href="{{ route('reject_comments',$data->app_id)}}">Reject</a></td>
                </tr>
            </tbody>
            @endforeach
        </table>
        <div class="container mb-5">
            <div id="map" style="width:100%;height:300px;"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            //Only needed for the filename of export files.
            //Normally set in the title tag of your page.
            document.title = 'Accepted Attachment Applications';
            // DataTable initialisation
            $('#example').DataTable({
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                "paging": true,
                "autoWidth": true,
                "buttons": [
                    'colvis',
                    'copyHtml5',
                    'csvHtml5',
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });

        });

        function showMap(lat, long) {
            var coord = {
                lat: lat,
                lng: long
            };

            var map = new google.maps.Map(
                document.getElementById("map"), {
                    zoom: 10,
                    center: coord
                }
            );

            new google.maps.Marker({
                position: coord,
                map: map
            })
        }
        showMap(0, 0);
    </script>
</body>

</html>