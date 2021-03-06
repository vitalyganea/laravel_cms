<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use mysql_xdevapi\Session;


class TablesController extends Controller
{

    public function getMenu()
    {
        return Tables::all();
    }

    public function getTableInformation($id)
    {
          return(Tables::findOrFail($id));

    }

    public function getTable($id) {

        $table_objects = DB::table($this->getTableInformation($id)->table_title)->get();


//        $table_columns =  Schema::getColumnListing($this->getTableInformation($id)->table_title);

        $table_columns = DB::table('column_settings')
            ->select('*')
            ->where('table_id', $id)
            ->get();
        return view('admin/table', [
                'id' => $id,
                'menu_elements' => $this->getMenu(),
                'table_info' => $this->getTableInformation($id),
                'table_objects' => $table_objects,
                'table_columns' => $table_columns
                ]
        );

    }

    public function getColumns($id){


        $table_columns = DB::table('column_settings')
            ->select('*')
            ->join('tables', 'tables.id', '=', 'column_settings.table_id')
            ->where('tables.id', $id)
            ->get();


        return view('admin/create',[
            'table_info' => $this->getTableInformation($id),
            'menu_elements' => $this->getMenu(),
            'table_columns' => $table_columns,
        ]);

    }

    public function createObject(Request $request, $id){

        $arrayToInsert = array();

        foreach ($request->request as $key => $value){
            if($key !== '_token') {
                $arrayToInsert[$key] = $value;
            }
        }

        if(DB::table(Tables::findOrFail($id)->table_title)->insert($arrayToInsert)){
            session(['type' => 1,'message' => 'Success']);
        }else{
            session(['type' => 2,'message' => 'Fail']);
        }
        return redirect('admin/table/'.$id);
    }


        public function deleteElement(Request $request){

            DB::table($this->getTableInformation($request->table_id)->table_title)->delete($request->element_id);

        }

}
