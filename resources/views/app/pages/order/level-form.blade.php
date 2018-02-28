
<div class="form-group {{ $errors->has('order_level_id') ? 'has-error' : ''}}">
    <label for="order_level_id" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select name="order_level_id" class="form-control" id="order_level_id">
            @foreach ($orderLevels as $optionKey => $optionValue)
                <option value="{{ $optionKey }}">{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('order_level_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('due_date') ? 'has-error' : ''}}">
    <label for="due_date" class="col-md-4 control-label">{{ 'Tamamlanma tarixi' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="due_date" type="date" id="due_date">
        {!! $errors->first('due_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="col-md-4 control-label">{{ 'Qeyd' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="note" type="textarea" id="note"></textarea>
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
