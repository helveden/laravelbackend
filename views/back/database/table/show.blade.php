@extends('back.layout')
{{-- https://github.com/the-control-group/voyager/blob/master/resources/views/tools/database/edit-add.blade.php --}}
@section('body')
    <div class="container-fluid">
        <div class="row">
            @include('back.common.header')
        </div>
        <div class="row">
            <aside class="main-sidebar">
                @include('back.common.menu')
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    <h1>{{ ucfirst($table) }}</h1>
                    @include('back.common.breadcrumb')
                </div>
                <div class="content body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('table') }}/{{ $table }}" class="form-inline" method="POST">
                                        {{ csrf_field() }}
                                        <div>
                                            <label for="table_name">Nom de la table</label>
                                        </div>
                                        <div class="form-group">
                                            <input id="table_name" type="text" class="form-control" placeholder="Nom de la table" name="rename" value="{{ $table }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-info">
                                        </div>
                                        <input type="hidden" name="_method" value="PUT">
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Colonnes <small>table</small></h3>
                                        </div>
                                        <table class="table table-condensed">
                                            <thead class="row">
                                                <tr>
                                                    <th>
                                                        <div class="col-md-2">Nom de la colonne</div>
                                                        <div class="col-md-2">Type</div>
                                                        <div class="col-md-1">Size</div>
                                                        <div class="col-md-1">Null</div>
                                                        <div class="col-md-2">Key</div>
                                                        <div class="col-md-2">Default</div>
                                                        <div class="col-md-1">A I</div>
                                                        <div class="col-md-1">Actions</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="list_column">
                                                {{-- {!! $columns !!} --}}
                                                <?php
                                                    $fields = array();
                                                    $timestamps = true;
                                                    $token = true;
                                                ?>
                                                @foreach($columns as $key => $column)
                                                <?php 

                                                    if ($column['field'] == 'created_at' || $column['field'] == 'updated_at' ) {
                                                        $timestamps = false;
                                                    }

                                                    if ($column['field'] == 'remember_token' ) {
                                                        $token = false;
                                                    }

                                                    preg_match("#([a-z].*)(_id)#", $column['field'], $match);

                                                    if($match) {
                                                        $fields[] = $column['field'];
                                                    }

                                                ?>
                                                    <tr id="column_{{$key}}">
                                                        <td>
                                                            <div data-column="{{$key}}" class="row">
                                                                <form action="{{ route('table') }}/{{ $table }}/updateColumn" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <input id="column_{{ $column['field'] }}" name="column[name]" type="text" class="form-control" placeholder="Nom de la colonne" value="{{ $column['field'] }}">
                                                                                </div>
                                                                            </div>
                                                                        
                                                                            @include('back.database.table.partials.select-type', ['key' => $key, 'type' => $column['type']])

                                                                            <div class="col-md-1">
                                                                                <div class="form-group">
                                                                                   {{--  <label class="">
                                                                                        <div class="icheckbox_flat-green checked" aria-checked="true" aria-disabled="false"> --}}
                                                                                            @if($column['null'] == "YES")
                                                                                                <input type="checkbox" class="flat-red" name="column[null]" value="no" checked="checked">
                                                                                            @else
                                                                                                <input type="checkbox" class="flat-red" name="column[null]" value="yes" >
                                                                                            @endif
                                                                                            {{-- <ins class="iCheck-helper"></ins>
                                                                                        </div>
                                                                                    </label> --}}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                @include('back.database.table.partials.select-key', ['key' => $key, 'type' => $column['key']])
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <input type="text" class="form-control" name="column[default]" value="{{ $column['default'] }}" placeholder="Tel que defini">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                @if($column['extra'] == "auto_increment")
                                                                                    <input type="checkbox" class="flat-red" name="column[auto_increment]" value="no" checked="checked">
                                                                                @else
                                                                                    <input type="checkbox" class="flat-red" name="column[auto_increment]" value="yes" >
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <div class="row">
                                                                                    <div class="col-md-3">
                                                                                        <input type="submit" id="update_column_{{$key}}" class="hidden">
                                                                                        <label for="update_column_{{$key}}" data-update-column="{{$key}}" data-table="{{$table}}" data-update-name="{{$column['field']}}"><i class="fa fa-pencil" aria-hidden="true"></i></label>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div data-delete-column="{{$key}}" data-table="{{$table}}" data-column-name="{{$column['field']}}"><i class="fa fa-trash" aria-hidden="true"></i></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="old_field"  class="row hidden">
                                                                        <div id="old_col_{{ $column['field'] }}">
                                                                            <input type="hidden" name="oldcolumn[name]" class="form-control" value="{{ $column['field'] }}">
                                                                            @include('back.database.table.partials.select-oldtype', ['key' => $key, 'type' => $column['type']])
                                                                            <input type="hidden" name="oldcolumn[enum]" class="form-control" value="{{ size($column['type']) }}">
                                                                            {{-- <input type="hidden" name="oldcolumn[null]" class="form-control" value="{{ $column['null'] }}"> --}}
                                                                            @if($column['null'] == "YES")
                                                                                <input type="hidden" name="oldcolumn[null]" value="no">
                                                                            @else
                                                                                <input type="hidden" name="oldcolumn[null]" value="yes" >
                                                                            @endif  
                                                                            <input type="hidden" name="oldcolumn[key]" class="form-control" value="{{ $column['key']}}">
                                                                            <input type="hidden" name="oldcolumn[default]" class="form-control" value="{{ $column['default']}}">
                                                                            <input type="hidden" name="oldcolumn[extra]" class="form-control" value="{{ $column['extra']}}">
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group">
                                        <button id="new_column" type="submit" class="btn">+ New column</button>
                                        @if($timestamps)
                                            <a href="{{ route('table') }}/{{ $table }}/addTimestamps" class="btn btn-info">Add timestamp</a>
                                        @endif
                                        @if($token)
                                            <a href="{{ route('table') }}/{{ $table }}/addToken" class="btn btn-info">Add token</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @if($table != 'users')
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>Model</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(!empty($file))
                                            <h3>Step 1</h3>
                                            <ul class="nav nav-pills">
                                                <li class="">
                                                    <button type="submit" class="btn" data-toggle="modal" data-target="#myModal">+ New relation</button>
                                                </li>
                                            </ul>
                                            <br>
                                            <div class="row">
                                                <ul id='list_relation' class="col-md-12">
                                                    @if(!empty($relations))
                                                        @foreach($relations as $relation)
                                                            <li class="row" data-relation-id="{{$relation->id}}">
                                                                <form action="/back/database/relation/{{$relation->id}}" class="col-md-12" method="POST">
                                                                    {{ csrf_field() }}
                                                                    <div class="row">
                                                                        <input name="_method" type="hidden" value="PUT">
                                                                        <input name="table" type="hidden" value="{{$table}}">
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" name="relation" placeholder="relation" value="{{$relation->relation}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <select name="foreign_key" id="" class="form-control">
                                                                                    @foreach($fields as $field)
                                                                                        <option value="{{ $field }}">{{ $field }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <select name="type" id="" class="form-control">
                                                                                    <option value="">Type</option>
                                                                                    <option value="belongsTo" <?php echo ($relation->type == "belongsTo") ? "selected='selected'" : '';?>>belongsTo</option>
                                                                                    <option value="hasMany" <?php echo ($relation->type == "hasMany") ? "selected='selected'" : '';?>>hasMany</option>
                                                                                    <option value="hasOne" <?php echo ($relation->type == "hasOne") ? "selected='selected'" : '';?>>hasOne</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" name="class" placeholder="App\ClassName" value="{{$relation->class}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" name="other_key" placeholder="other_key" value="{{$relation->other_key}}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-1">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <input type="submit" id="update_relation_{{$relation->id}}" class="hidden">
                                                                                    <label for="update_relation_{{$relation->id}}"><i class="fa fa-pencil" aria-hidden="true"></i></label>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <a data-delete="true" data-relation="{{$relation->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        @else
                                            <p>Le fichier n'existe pas.</p>
                                            <a href="{{ route('table') }}/{{ $table }}/createModel" class="btn btn-info" data-create-model="{{ $table }}">Create model</a>
                                            <hr>
                                        @endif
                                    </div>
                                    @if($file_content)
                                        <div class="col-md-12">
                                            <h3>Step 2</h3>
                                            <ul class="nav nav-pills">
                                                <li class=""><a href="{{ route('table') }}/{{ $table }}/updateModel" class="btn btn-info"><i class="fa fa-undo" aria-hidden="true"></i> Update Model</a></li>
                                                <li><a class="btn btn-default" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil" aria-hidden="true"></i>  Edit</a></li>
                                                <li class=""><a href="{{ route('table') }}/{{ $table }}/deleteModel" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete Model</a></li>
                                            </ul>
                                            <br>
                                            <pre><code class="php">{{ $file_content }}</code></pre>
                                        </div>
                                    @endif
                                    </div>
                                        <table id="templates" class="hidden">
                                            <tr id="custom_column">
                                                <td>
                                                    <div class="row">
                                                        <form action="{{ route('table') }}/{{ $table }}/newColumn" method="POST">
                                                            {{ csrf_field() }}
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input id="" name="column[name]" data-name="name" type="text" class="form-control" placeholder="Nom de la colonne" value="">
                                                                </div>
                                                            </div>
                                                        
                                                            @include('back.database.table.partials.select-type', ['key' => '####', 'type' => false])

                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="column[null]" data-name="null" value="yes" >
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                @include('back.database.table.partials.select-key', ['key' => '####', 'type' => false])
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="column[default]" data-name="default" value="" placeholder="Tel que defini">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="checkbox" name="column[auto_increment]" data-name="auto_increment" value="no" >
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input type="submit" id="column_delete####" class="hidden">
                                                                <label for="column_delete####"><i class="fa fa-check" aria-hidden="true"></i></label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @else 
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Model <small>Danger</small></h3>
                                        <ul class="nav nav-pills">
                                            <li><a class="btn btn-default" data-toggle="modal" data-target="#ModalEdit"><i class="fa fa-pencil" aria-hidden="true"></i>  Edit</a></li>
                                        </ul>
                                        <br>
                                        <pre><code class="php">{{ $file_content }}</code></pre>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form action="/back/database/relation" method="POST" class="modal-content">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New relation</h4>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Table</label>
                            <input type="text" name="table" value="{{ $table }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Relation</label>
                            <input type="text" class="form-control" name="relation" placeholder="relation">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Column</label>
                            <select name="foreign_key" id="" class="form-control">
                                @foreach($fields as $field)
                                    <option value="{{ $field }}">{{ $field }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="type" id="" class="form-control">
                                <option value="">Type</option>
                                <option value="belongsTo">belongsTo</option>
                                <option value="hasMany">hasMany</option>
                                <option value="hasOne">hasOne</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">ClassName</label>
                            <input type="text" class="form-control" name="class" placeholder="App\ClassName">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Other key</label>
                            <input type="text" class="form-control" name="other_key" placeholder="other_key">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
    <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            @if($table != 'users')
                <form action="{{ route('table') }}/{{ $table }}/updateModel" class="modal-content" method="POST">
            @else 
                <form action="{{ route('table') }}/users/updateModel" class="modal-content" method="POST">
            @endif
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit</h4>
                </div>
                <div class="modal-body row">
                    <pre class="form-group col-md-12">
                        <textarea name="content" id="" class="form-control" rows="30">{{ $file_content }}</textarea>
                    </pre>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input class="btn btn-info" type="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            
            hljs.initHighlightingOnLoad();

            $('#new_column').click(function(e){
                e.preventDefault();
                var tpl = $('#custom_column').clone(true),
                    nb = $('#list_column tr').length;

                console.log(tpl);
                tpl.attr('id', 'column_'+ nb);

                console.log(tpl);
                $('#list_column').append(tpl);
            });

            $('[data-delete-column]').on('click', function(e) {
                e.preventDefault();
                console.log('delete col');
                var id = $(this).data('delete-column'),
                    column = $(this).data('column-name'),
                    table = $(this).data('table');


                $('#old_col_'+column).remove();

                console.log(id);
                $('[data-column="'+id+'"').remove();

                $.ajax({
                    url: '{{ route('table') }}/'+table+'/deleteColumn/'+column,
                    type: 'GET',
                    success : function(res){
                        console.log(res);
                    }
                });
            });

            $('[data-delete]').on('click', function(e) {
                e.preventDefault();

                var relation = $(this).data('relation');

                $.ajax({
                    url: '/back/database/relation/'+relation,
                    type: 'DELETE',
                    success : function(res){
                        $('[data-relation-id="'+relation+'"]').remove();
                    }
                });
            });
            
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
              checkboxClass: 'icheckbox_flat-green',
              radioClass: 'iradio_flat-green'
            });
        });
    </script>
@endsection