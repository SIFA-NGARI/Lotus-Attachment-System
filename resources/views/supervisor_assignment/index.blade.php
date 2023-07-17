

@extends('layouts.adminlayout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">

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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('import_parse2') }}" method="POST" class="mb-4" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="csv_file" :value="__('Allocate from .csv file')" />

                            <x-text-input id="csv_file" class=" mt-1 " type="file" name="csv_file" required />
                        </div>

                        <div class="mt-4 flex items-center">
                            <x-input-label for="header" :value="__('File contains header row?')" />

                            <x-text-input id="header" class="ml-1" type="checkbox" name="header" checked />
                        </div>

                        <x-primary-button class="mt-4">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </form>

                    <!-- <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md"> -->
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th >
                                        Student ID
                                    </th>
                                    <th >
                                        Student Name
                                    </th>
                                    <th >
                                        Supervisor ID
                                    </th>
                                    <th >
                                        Supervisor Name
                                    </th>
                                    <th >
                                        Change
                                    </th>
                                    <th >
                                        Nullify
                                    </th>
                                </tr>
                            </thead>

                            <!-- <tbody class="bg-white divide-y divide-gray-200 divide-solid"> -->
                                <tbody>
                                @foreach($data as $data)
                                <?php
                                $data2 = DB::table('users')->where('id', '=', $data->student_id)->get();
                                $id =$data->student_id;
                                ?>
                                <tr>
                                    <td  style="text-align: center;">
                                        {{$id }}
                                    </td>
                                    @foreach($data2 as $data2)
                                    <td  style="text-align: center;">
                                        {{ $data2->name}}
                                    </td>
                                    @endforeach
                                    <?php
                                    $data3 = DB::table('users')->where('id', '=', $data->supervisor_id)->get();
                                    ?>
                                    <td  style="text-align: center;">
                                        {{ $data->supervisor_id}}
                                    </td>
                                    @foreach($data3 as $data3)
                                    <td  style="text-align: center;">
                                        {{ $data3->name}}
                                    </td>
                                    @endforeach
                                    <td><a id="this1" href="{{ route('edit_assignment_page',$id)}}">Change</a></td>
                                    <td><a id="this1" href="{{ route('nullify_assignment',$id)}}">Nullify</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                   

                </div>
            </div>
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
    </script>
    @endsection
