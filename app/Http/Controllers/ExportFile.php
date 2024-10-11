<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ExportFile extends Controller
{
    public static function export(Request $request){
        
        $users    = DB::table('users')->get();
        $filename = "users.csv";

        $header = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'. $filename . '"'
        ];

        $handle = fopen('php://output','w');
        fputcsv($handle, ['First Name', 'Last Name', 'Age', 'Hobby', 'Birthday', 'Gender'  ]);

        foreach($users as $user){
            fputcsv($handle, [$user->fname, $user->lname, $user->age, $user->hobby, $user->bday, $user->gender]);
        }

        fclose($handle);

        return Response::make('',200, $header);
    }
}