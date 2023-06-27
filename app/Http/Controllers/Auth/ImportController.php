<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;
use App\Http\Requests\CsvImportRequest;
use App\Imports\UsersImport;
use App\Models\User;
use App\Models\CsvData;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

class ImportController extends Controller
{
    public function parseImport(CsvImportRequest $request)
    {
        if ($request->has('header')) {
            $headings = (new HeadingRowImport)->toArray($request->file('csv_file'));
            $data = Excel::toArray(new UsersImport, $request->file('csv_file'))[0];
        } else {
            $data = array_map('str_getcsv', file($request->file('csv_file')->getRealPath()));
        }

        if (count($data) > 0) {
            $csv_data = array_slice($data, 0, 2);

            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('admin_reg_sup/import_records', [
            'headings' => $headings ?? null,
            'csv_data' => $csv_data,
            'csv_data_file' => $csv_data_file
        ]);
    }

    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $user = new User();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    if ($field != 'password') {
                        $user->$field = $row[$request->fields[$field]];
                    } else {
                        $user->$field = Hash::make($row[$request->fields[$field]]);
                    }
                    $user->role = 1;
                } else {
                    if ($field != 'password') {
                        $user->$field = $row[$request->fields[$index]];
                    } else {
                        $user->$field = Hash::make($row[$request->fields[$index]]);
                    }

                    $user->role = 1;
                }
            }
            $user->save();
        }

        return redirect()->route('SupervisorRegistration')->with('success', 'Import finished.');
    }
}
