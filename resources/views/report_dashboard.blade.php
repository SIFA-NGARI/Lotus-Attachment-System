@extends('layouts.studentlayout2')
@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Attachment Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @foreach($deadline_open as $deadline_open)
        <?php
        $deadline = $deadline_open->deadline;
        $open = $deadline_open->open;
        if (strtotime($deadline) < strtotime('now')) {
            $overdue = 1;
        }

        ?>
        @endforeach
        @if(1 == @$open)
        <h1 style="font-size: 30px; color: red;">The submission portal for the reports has not been opened. Try again later</h1>
        @else
        
        @if(1 == @$overdue)
        <h1 style="font-size: 20px; color: #0967B5;">Deadline: {{$deadline}} </h1>
        <h1 style="font-size: 20px; color: red;">The submission date for the report has passed</h1>
        @else

        @if($draft->isEmpty() && $report->isEmpty())
        <h1 style="font-size: 20px; color: #0967B5;">Deadline: {{$deadline}} </h1>
        <h1 style="font-size: 30px; color: #0967B5;">Report Status: Not Submitted</h1>
        <form action="{{route('submit_assignment')}}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="images" style="position: relative; display: flex;  gap: 10px;  flex-direction: column;  justify-content: center;  align-items: center;  height: 200px; padding: 20px;  width:600px;  border-radius: 10px;  border: 2px dashed #555;  color: #444;  cursor: pointer;" id="dropcontainer">
                <span class="drop-title">Drop file here</span>
                or
                <input type="file" name="file" accept=".pdf" style=" margin-right: 20px;  border: none;    padding: 10px 20px;  border-radius: 10px;    cursor: pointer;  " id="images" required>
            </label>

            <button type="submit" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Submit</button>
            <button type="submit" formaction="{{route('save_as_draft')}}" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Save as Draft</button>
        </form>
        @elseif(! $draft->isEmpty())
        <h1 style="font-size: 20px; color: #0967B5;">Deadline: {{$deadline}} </h1>
        @if($errors->any())
        @foreach($draft as $draft)
        <?php
        $material_id = $draft->id;
        $file = $draft->file;
        ?>
        @endforeach
        <h1 style="font-size: 30px; color: #0967B5;">Report Status: Invalid</h1>
        <h1 style="font-size: 20px; color: red;">{{$errors->first()}}</h1>
        <br>
        <div style="display: flex; flex-direction:row">
            <a style="font-size: 30px; color: black;" href="{{route('viewAssignmentDraft',$material_id)}}">View Your Draft</a>
            <form action="{{route('submit_assignment2')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="file" value="{{$file}}">
                <button type="submit" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-left:20px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Submit</button>
            </form>
        </div>
        <br>
        <h1 style="font-size: 25px; color: black;">Edit Draft</h1>
        <hr>
        <form action="{{route('submit_assignment')}}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="images" style="position: relative; display: flex;  gap: 10px;  flex-direction: column;  justify-content: center;  align-items: center;  height: 200px; padding: 20px;  width:600px;  border-radius: 10px;  border: 2px dashed #555;  color: #444;  cursor: pointer;" id="dropcontainer">
                <span class="drop-title">Drop file here</span>
                or
                <input type="file" name="file" accept=".pdf" style=" margin-right: 20px;  border: none;    padding: 10px 20px;  border-radius: 10px;    cursor: pointer;  " id="images" required>
            </label>

            <button type="submit" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Submit</button>
            <button type="submit" formaction="{{route('save_as_draft2')}}" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Edit Draft</button>
        </form>

        @else

        @foreach($draft as $draft)
        <?php
        $material_id = $draft->id;
        $file = $draft->file;
        ?>
        @endforeach
        <h1 style="font-size: 30px; color: #0967B5;">Report Status: Saved as Draft</h1>
        <br>
        <div style="display: flex; flex-direction:row">
            <a style="font-size: 30px; color: black;" href="{{route('viewAssignmentDraft',$material_id)}}">View Your Draft</a>
            <form action="{{route('submit_assignment2')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="file" value="{{$file}}">
                <button type="submit" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-left:20px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Submit</button>
            </form>
        </div>
        <br>
        <h1 style="font-size: 25px; color: black;">Edit Draft</h1>
        <hr>
        <form action="{{route('submit_assignment')}}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="images" style="position: relative; display: flex;  gap: 10px;  flex-direction: column;  justify-content: center;  align-items: center;  height: 200px; padding: 20px;  width:600px;  border-radius: 10px;  border: 2px dashed #555;  color: #444;  cursor: pointer;" id="dropcontainer">
                <span class="drop-title">Drop file here</span>
                or
                <input type="file" name="file" accept=".pdf" style=" margin-right: 20px;  border: none;    padding: 10px 20px;  border-radius: 10px;    cursor: pointer;  " id="images" required>
            </label>

            <button type="submit" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Submit</button>
            <button type="submit" formaction="{{route('save_as_draft2')}}" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Edit Draft</button>
        </form>
@endif

        @elseif(! $report->isEmpty())
        @foreach($report as $report)
        <?php
        $material_id = $report->report_id;
        $file = $report->file;
        if($report->grade==null){
            $grade=0;
        }else{
            $grade=$report->grade;
        }
        ?>
        @endforeach
        @if(0 == @$grade)
        <h1 style="font-size: 20px; color: #0967B5;">Deadline: {{$deadline}} </h1>
        <h1 style="font-size: 30px; color: #0967B5;">Report Status: Submitted and Pending Review</h1>
        <br>
        <div style="display: flex; flex-direction:row">
            <a style="font-size: 30px; color: black;" href="{{route('viewAssignmentSubmission',$material_id)}}">View Your Submission</a>
            <form action="{{route('delete_assignment')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$material_id}}">
                <button type="submit" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-left:20px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Remove Submission</button>
            </form>
        </div>
        <br>
        <h1 style="font-size: 25px; color: black;">Edit Submisson</h1>
        <hr>
        <form action="{{route('edit_assignment3')}}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="images" style="position: relative; display: flex;  gap: 10px;  flex-direction: column;  justify-content: center;  align-items: center;  height: 200px; padding: 20px;  width:600px;  border-radius: 10px;  border: 2px dashed #555;  color: #444;  cursor: pointer;" id="dropcontainer">
                <span class="drop-title">Drop file here</span>
                or
                <input type="file" name="file" accept=".pdf" style=" margin-right: 20px;  border: none;    padding: 10px 20px;  border-radius: 10px;    cursor: pointer;  " id="images" required>
            </label>
            <input type="hidden" name="id" value="{{$material_id}}">


            <button type="submit" style="background: rgb(56, 52, 52);  border: 0px solid #fff; margin-top: 10px;  width: max-content; font-size: 16px; font-weight: bold;  border-radius: 20px;  padding: 10px;  box-sizing: border-box; outline: none; color: white; cursor: pointer; transition: .4s; ">Edit</button>
        </form>
        @else
        <h1 style="font-size: 30px; color: #0967B5;">Report Status: Submitted and Graded</h1>
        <br>
        <h1 style="font-size: 30px; color: green;">Your Grade:{{$grade}} /50</h1>
        <a style="font-size: 20px; color: black;" href="{{route('viewAssignmentSubmission',$material_id)}}">View Your Submission</a>

        @endif
        @endif


      
        @endif
        @endif
    </div>
</section>
<script>
    const dropContainer = document.getElementById("dropcontainer")
    const fileInput = document.getElementById("images")

    dropContainer.addEventListener("dragover", (e) => {
        // prevent default to allow drop
        e.preventDefault()
    }, false)

    dropContainer.addEventListener("dragenter", () => {
        dropContainer.classList.add("drag-active")
    })

    dropContainer.addEventListener("dragleave", () => {
        dropContainer.classList.remove("drag-active")
    })

    dropContainer.addEventListener("drop", (e) => {
        e.preventDefault()
        dropContainer.classList.remove("drag-active")
        fileInput.files = e.dataTransfer.files
    })
</script>
@endsection