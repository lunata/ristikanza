<div class="form-group">
    <input id="{{!empty($id) ? $id : ''}}" type="submit" value="{{$title ?? null}}" class="btn btn-danger btn-default"
        @if (isset($onClick))
            onClick="{{ $onClick }}"
        @endif
           >
</div>