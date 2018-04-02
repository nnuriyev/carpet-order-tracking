<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Image' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="image" type="file" id="image" value="{{ $orderimage->image or ''}}" >
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="col-md-4 control-label">{{ 'Note' }}</label>
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
