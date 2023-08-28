<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cdbcontroller extends Controller
{
    public function deleteforever($table, $keyvalue)
    {
        $data = DB::table($table)->where('id',$keyvalue)->delete();
        return redirect()->route('voyager.' . $table . '.index');  
    }

    public function deletetrash($table, $check)
    {
        if($check)
        {
            $data = DB::table($table)->where('deleted_at','!=','')->delete();
            return redirect()->route('voyager.' . $table . '.index');
        }          
    }
}
