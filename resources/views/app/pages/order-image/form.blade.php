@hasanyrole('admin|sales')
@if(!isset($orderimage))
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Şəkil' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="image" type="file" id="image">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
@endhasanyrole
@role('workshop')
<div class="form-group {{ $errors->has('sketch') ? 'has-error' : ''}}">
    <label for="sketch" class="col-md-4 control-label">{{ 'Eskiz' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sketch" type="file" id="sketch" >
        {!! $errors->first('sketch', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endrole
@hasanyrole('admin|sales')
@if(isset($orderimage))
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select name="status" class="form-control" id="status">
            <option {{ isset($orderimage) && $orderimage->status == 0 ? 'selected':'' }} value="0">Təsdiq olunmayıb</option>
            <option {{ isset($orderimage) && $orderimage->status == 1 ? 'selected':'' }} value="1">Təsdiqlənib</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
@endhasanyrole
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="col-md-4 control-label">{{ 'Qeyd' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="note" type="textarea" id="note" >{{ $orderimage->note or ''}}</textarea>
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
