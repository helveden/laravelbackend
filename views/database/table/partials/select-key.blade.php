<select name="column[key]" data-name="key" id="" class="form-control" title="{{ $type }}">
    <option value="default"></option>
    <option value="delete">Supprimer l'index</option>
	@if ($type == 'PRI')
    	<option value="PRI" selected="selected">Primary</option>
    @else
    	<option value="PRI">Primary</option>
    @endif
	@if ($type == 'UNI')
    	<option value="UNI" selected="selected">Unique</option>
    @else
    	<option value="UNI">Unique</option>
    @endif
</select>