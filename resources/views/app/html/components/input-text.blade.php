
{{--{{ dd($item) }}--}}

<div class="form-group">
    <label class="control-label" for="{{ $item->id }}">{{ isset($item->label) ? $item->label : '' }}</label>
    <input type="text" class="form-control" id="{{ $item->id }}" name="{{ $item->id }}" {{ isset($item->readonly) && $item->readonly ? 'readonly' : '' }} {{ isset($item->disabled) && $item->disabled ? 'readonly' : '' }} value="{{ awesovel_out($collection, $item->id) }}">
    <span class="form-control--bar"></span>
</div>
