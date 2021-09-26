<?php

namespace Syedali\magicid\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
use  Illuminate\Support\Collection;
use \Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;

class DatabaseupdateController extends Controller
{
    public function database_update()
    {
        $tables = DB::select("show tables");
        foreach ($tables as $table) {
            $tbl_name = array_values(get_object_vars($table))[0];
            $columns = $this->getTableStructure($tbl_name);

            foreach ($columns as $col) {
                if ($col=='id')
                {
                    $type = DB::connection()->getDoctrineColumn($tbl_name, 'id')->getType()->getName();
                            
                    if ($type=="integer" || $type=="bigInt")
                    {
                        $s = DB::select("SELECT K.COLUMN_NAME FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS T JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE K ON K.CONSTRAINT_NAME=T.CONSTRAINT_NAME WHERE  K.TABLE_NAME='".$tbl_name."' AND K.TABLE_SCHEMA='".env('DB_DATABASE')."' AND T.CONSTRAINT_TYPE='PRIMARY KEY' LIMIT 1");

                        if (empty($s))
                        {
                            DB::Update("ALTER TABLE ".$tbl_name." ADD PRIMARY KEY(id);");
                            DB::UPdate("ALTER TABLE ".$tbl_name." MODIFY COLUMN id INT auto_increment;");   
                        }
                    }
                    break;  
                }
                
            }
        }
    }

    public function getTableStructure($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);   
    }
}
