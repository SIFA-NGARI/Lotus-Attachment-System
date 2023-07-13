<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment File</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        iframe {
            display: block;
            /* iframes are inline by default */
            height: 100vh;
            /* Set height to 100% of the viewport height */
            width: 100vw;
            /* Set width to 100% of the viewport width */
            border: none;
            /* Remove default border */
            padding: 0;
        }
    </style>
</head>

<body>

    @foreach($data as $data)
    <iframe src="/files/{{$data->file}}"><iframe>
            @endforeach
</body>

</html>