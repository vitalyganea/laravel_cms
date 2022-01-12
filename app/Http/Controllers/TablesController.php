<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    //

    public static function getMenu(){
        return Tables::all();
    }


    public function getTable($id) {

        return view('admin/index', [
                'id' => $id]
        );

    }

}
