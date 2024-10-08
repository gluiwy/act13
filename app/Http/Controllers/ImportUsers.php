<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportUsers extends Controller
{
    public static function import(Request $request) {
        if(($open = fopen('C:\Users\client\Desktop\users.csv', 'r')) !== false) {
            while(($data = fgetcsv($open, 1000, ",")) !== false) {
                DB::table("users")->insert([
                    "fname"     => $data[0],
                    "lname"     => $data[1],
                    "age"       => $data[2],
                    "hobby"     => $data[3],
                    "bday"      => $data[4],
                    "gender"    => $data[5]
                ]);
            }

            return[
                "success" => true,
                "message" => "Import Successful!"
            ];
        }
        else {
            return[
                "success" => false,
                "message" => "File does not exist."
            ];
        }
    }
}
