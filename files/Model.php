<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class %MODEL% extends Model {

    protected $table = '%TABLE%';
    
    protected $fillable = %FILLABLE%;

    public $timestamps = %TIMETAMPS%;

%FUNCTIONS%
}