<div class="form-group {{ $errors->has('cargo_cost') ? 'has-error' : ''}}">
    <label class="col-md-4 control-label">Kargo xərci</label>
    <div class="col-md-6">
        <input class="form-control" name="cargo_cost" type="text"
               value="{{ $order->cargo_cost or 0}}">
        {!! $errors->first('cargo_cost', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>