<div class="col-md-2">
    <select name="column[type]" data-name="type" id="" class="form-control" title="{{$type}}">
    	<option value="tinyInteger" {{ selected('tinyinteger', $type) }}>TINY INTEGER</option>
        <option value="smallInteger" {{ selected('smallinteger', $type) }}>SMALL INTEGER</option>
        <option value="mediumInteger" {{ selected('mediuminteger', $type) }}>MEDIUM INTEGER</option>
        <option value="integer" {{ selected('int', $type) }}>INTEGER</option>
        <option value="bigInteger" {{ selected('biginteger', $type) }}>BIG INTEGER</option>
        <option value="string" {{ selected('varchar', $type) }}>STRING</option>
        <option value="text" {{ selected('text', $type) }}>TEXT</option>
        <option value="mediumText" {{ selected('mediumtext', $type) }}>MEDIUM TEXT</option>
        <option value="longText" {{ selected('longtext', $type) }}>LONG TEXT</option>
        <option value="float" {{ selected('float', $type) }}>FLOAT</option>
        <option value="double" {{ selected('double', $type) }}>DOUBLE</option>
        <option value="decimal" {{ selected('decimal', $type) }}>DECIMAL</option>
        <option value="boolean" {{ selected('boolean', $type) }}>BOOLEAN</option>
        <option value="date" {{ selected('date', $type) }}>DATE</option>
        <option value="datetime" {{ selected('datetime', $type) }}>DATETIME</option>
        <option value="time" {{ selected('time', $type) }}>TIME</option>
        <option value="timestamp" {{ selected('timestamp', $type) }}>TIMESTAMP</option>
        <option value="binary" {{ selected('binary', $type) }}>BINARY</option>
    </select>
</div>
<div class="col-md-1">
    <div class="enum_val">
        <input type="text" placeholder="Value" class="form-control enum" name="column[enum]" data-name="enum" value='{{ size($type) }}'>
    </div>
</div>