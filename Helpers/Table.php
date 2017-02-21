<?php 

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Relation;


function selected($type, $type_column) {

	$nb = strlen($type);

	$type_column = substr($type_column, 0 , $nb);

	if ($type == $type_column) {
		return "selected='selected'";
	}

	// return "$type";
}

function size($type) {
	preg_match('#[0-9]+#', $type , $size);

	if (!empty($size)) {
		return $size[0];
	}

	return false;
}

/* TABLE */

function getTables() {
	return DB::select('SHOW TABLES');
}

function showTable($table) {

    $schema_name = DB::connection()->getDatabaseName();
	
	$raw = "SELECT column_name AS 'field',
                       column_type     AS 'type',
                       is_nullable     AS 'null',
                       column_key      AS 'key',
                       column_default  AS 'default',
                       extra           AS 'extra'
                    FROM   information_schema.columns
                    WHERE  table_schema = '{$schema_name}'
                    AND    table_name   = '{$table}'";

    return collect(DB::select(DB::raw($raw)))->map(function ($item) {

        return [
            'field'   => $item->field,
            'type'    => $item->type,
            'null'    => $item->null,
            'key'     => $item->key,
            'default' => $item->default,
            'extra'   => $item->extra,
        ];
    });
}

/* COLUMN */

function newColumn($tablename, $column) {
	Schema::table($tablename, function (Blueprint $table) use ($column, $tablename) {
        if (!empty($column['key'])) {
            if ($column['key'] == 'PRI') {
                $table->increments($column['name']);
                return true;
            }
        }

        if (!empty($column['enum'])) {
            $result = $table->{$column['type']}($column['name'], $column['enum']);
        } else {
            $result = $table->{$column['type']}($column['name']);
        }

        // NULL
        if (!empty($column['null'])) {
            if ($column['null'] == 'yes') {
                $result = $result->nullable();
            }
        } else {
            $result = $result->nullable(false);
        }

        if (!empty($columns['default'])) {
            if ($columns['default'] != '') {
                $result = $result->default($columns['default']);
            }
        }
    });
}

function updateColumn($tablename, $columns, $oldcolumns) {
	Schema::table($tablename, function (Blueprint $table) use ($column, $tablename) {
        if (!empty($column['key'])) {
            if ($column['key'] == 'PRI') {
                $table->increments($column['name']);
                return true;
            }
        }

        if (!empty($column['enum'])) {
            $result = $table->{$column['type']}($column['name'], $column['enum']);
        } else {
            $result = $table->{$column['type']}($column['name']);
        }

        // NULL
        if (!empty($column['null'])) {
            if ($column['null'] == 'yes') {
                $result = $result->nullable();
            }
        } else {
            $result = $result->nullable(false);
        }

        if (!empty($columns['default'])) {
            if ($columns['default'] != '') {
                $result = $result->default($columns['default']);
            }
        }
    });
}

function deleteColumn($table, $column) {
	Schema::table($table, function ($table) use ($column) {
        $table->dropColumn($column);
    });
}


/* MODEL */

function updateModel($table) {


    $schema_name = DB::connection()->getDatabaseName();

    /* init */
    $app       = app_path();
    $modelBase = $app.'/Models/Fields/Model.php';
    $functionmodel =  $app.'/Models/Fields/Function.php';

    $file     = $app.'/'.ucfirst($table).'.php';
    $contents = '';

    $columns = showTable($table);

    $fields = array();
    $timestamps = 'false';

    foreach ($columns as $column) {

        if ($column['field'] == 'created_at' || $column['field'] == 'updated_at' ) {
            $timestamps = 'true';
            continue;
        }

        if ($column['field'] == 'id') {
            continue;
        }

        $fields[] = "        '".$column['field']."'";

    }

    $fillable   = 'array('. PHP_EOL . implode(', '.PHP_EOL, $fields) . PHP_EOL . '    )';

    // add relations
    $functions   = '';
    $relations = Relation::where('table', $table)->get();

    if (!empty($relations)) {
        $function_content = file_get_contents($functionmodel);

        $func_replace = array(
            "/%RELATION%/",
            "/%TYPE%/",
            "/%CLASS%/",
            "/%FOREIGN%/",
            "/%OTHER%/"
        );
        
        foreach ($relations as $relation) {

            $elt_func_replace = array(
                $relation->relation,
                $relation->type,
                $relation->class,
                $relation->foreign_key,
                $relation->other_key,

            );

            $functions .= preg_replace($func_replace, $elt_func_replace, $function_content);

        }
        
    }

    $str_replace = array(
        "/%MODEL%/",
        "/%TABLE%/",
        "/%FILLABLE%/",
        "/%TIMETAMPS%/",
        "/%FUNCTIONS%/",
    );

    $elt_replace = array(
        ucfirst($table),
        $table,
        $fillable,
        $timestamps,
        $functions,
    );

    $file_content = '';


    if (File::exists($file)) {
        $file_content = file_get_contents($modelBase);
        $content      = preg_replace($str_replace, $elt_replace, $file_content);

        File::put($file, $content);
    }
}