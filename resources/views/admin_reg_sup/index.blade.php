
@extends('layouts.adminlayout')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('fetch_form') }}"><x-primary-button class="mt-0 mb-3">
                        {{ __('Register Supervisor') }}
                    </x-primary-button></a>
                    <h2 class="mt-0" style="margin-left: 50%;">OR</h2>
                    <hr class="mb-2">

                    <form action="{{ route('import_parse') }}" method="POST" class="mb-4" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="csv_file" :value="__('Register from .csv file')" />

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

                    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
                        <table id="example" class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50" style="text-align: center;">
                                        <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50" style="text-align: center;">
                                        <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</span>
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50" style="text-align: center;">
                                        <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Phone Number</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($supervisors as $supervisor)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900" style="text-align: center;">
                                        {{ $supervisor->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900" style="text-align: center;">
                                        {{ $supervisor->email}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900" style="text-align: center;">
                                        {{ $supervisor->phone_number}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $supervisors->links() }}

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            //Only needed for the filename of export files.
            //Normally set in the title tag of your page.
            document.title = 'Attachment Applications';
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
