<?php

namespace Helveden\LBE\Src\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Config;
use DB;
use File;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Schema;
use App\Relation;
use App\Repositories\RelationRepo;

/*
 * @url https://laravel.com/docs/5.4/migrations
 *
 *
 */

class TableController extends Controller
{

    public function index()
    {

        $data['tables'] = getTables();

        return view('back.database.table.index', $data);
    }

    public function create(FormBuilder $formBuilder)
    {

        $data['form'] = $formBuilder->create(\App\Forms\TestForm::class, [
            'method' => 'POST',
            'url'    => 'test',
        ]);

        return view('back.database.table.form', $data);
    }

    public function show($table)
    {
        $data = array();

        $data['table'] = $table;

        $data['tables'] = DB::select('SHOW TABLES');

        //

        if (Schema::hasTable($table)) {
            $data['columns'] = showTable($table);

            // get model
            $file         = app_path().'/'.ucfirst($table).'.php';
            $data['file'] = File::exists($file);
            $data['file_content'] = false;
            $data['relations'] = array();

            // get relation
            if($data['file']){
                 $data['relations'] = Relation::where('table', $table)->get();
            }
            
            // get content and if users
            if ($data['file']) {
                $data['file_content'] = file_get_contents($file);
            } else if(!$data['file'] && $table == 'users' ) {
                $file = app_path().'/User.php';
                $data['file'] = File::exists($file);
                $data['file_content'] = file_get_contents($file);
            }
            

            return view('back.database.table.show', $data);

        } else {
            die('Pas de table du nom de '.$table);
        }


        
    }

    public function update($table, Request $req) {

        $request = $req->all();

        $rename = $request["rename"];

        Schema::rename($table, $rename);

        return redirect()->action(
            'Back\\TableController@show', ['table' => $rename]
        );
    }

    /* TABLE - TABLE - TABLE - TABLE - TABLE - TABLE
     *
     * https://laravel.com/docs/5.4/eloquent-relationships
     *
     */

    public function createTable(Request $req) {

        $request = $req->all();

        Schema::create($request['table'], function (Blueprint $table) use ($request) {
            $table->increments('id');
        });

        return redirect()->action(
            'Back\\TableController@show', ['table' => $request['table']]
        );
    }

    public function deleteTable($table)
    {

        Schema::dropIfExists($table);

        $file = app_path().'/'.ucfirst($table).'.php';
        File::delete($file);

        return redirect()->action(
            'Back\\TableController@index', []
        );
    }

    public function addTimestamps($table)
    {

        Schema::table($table, function ($table) {
            $table->timestamps();
        });

        return redirect()->action(
            'Back\\TableController@show', ['table' => $table]
        );
    }

    public function addToken($table)
    {

        Schema::table($table, function ($table) {
            $table->rememberToken();
        });

        return redirect()->action(
            'Back\\TableController@show', ['table' => $table]
        );
    }

    /* COLUMNS - COLUMNS - COLUMNS - COLUMNS - COLUMNS - COLUMNS
     *
     * https://laravel.com/docs/5.4/eloquent-relationships
     *
     */

    public function newColumn(Request $req, $tablename)
    {

        $request = $req->all();

        if (!empty($request)) {
            if (!empty($request['column'])) {
                $column = $request['column'];
                newColumn($tablename, $column);
            }
        }

        return redirect()->action(
            'Back\\TableController@show', ['table' => $tablename]
        );
    }

    public function updateColumn(Request $req, $tablename)
    {

        $request = $req->all();

        if (!empty($request)) {
            if (!empty($request['column'])) {
                $columns    = $request['column'];
                $oldcolumns = $request['oldcolumn'];

                updateColumn($tablename, $columns, $oldcolumns);
            }
        }

        return redirect()->action(
            'Back\\TableController@show', ['table' => $tablename]
        );
    }

    public function deleteColumn($table, $column)
    {
        deleteColumn($table, $column);
    }

    /*
     *
     *
     * MODEL MODEL MODEL MODEL MODEL MODEL MODEL MODEL
     *
     */

    public function createModel($model)
    {

        $file     = app_path().'/'.ucfirst($model).'.php';
        $contents = '';

        if (!File::exists($file)) {
            File::put($file, $contents);
        }

        return redirect()->action(
            'Back\\TableController@updateModel', ['table' => $model]
        );
    }

    public function updateModel($table)
    {
        updateModel($table);

        return redirect()->action(
            'Back\\TableController@show', ['table' => $table]
        );
    }

    public function deleteModel($table)
    {
        $file = app_path().'/'.ucfirst($table).'.php';
        File::delete($file);

        return redirect()->action(
            'Back\\TableController@show', ['table' => $table]
        );
    }
}
