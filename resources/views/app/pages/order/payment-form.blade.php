<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label class="col-md-4 control-label">Məbləğ</label>
    <div class="col-md-6">
        <input class="form-control" name="amount" type="text">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">Ödəniş tipi</label>
    <div class="col-md-6">
        <select name="type" class="form-control">
            @foreach (config('staticData')['paymentType'] as $optionKey => $optionValue)
                <option value="{{ $optionKey }}">{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>