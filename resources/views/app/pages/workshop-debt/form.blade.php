<div class="form-group {{ $errors->has('workshop_id') ? 'has-error' : ''}}">
    <label for="workshop_id" class="col-md-4 control-label">Emalatxana</label>
    <div class="col-md-6">
        <select name="workshop_id" class="form-control" id="workshop_id" >
        @foreach ($workshops as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($workshopdebt->workshop_id) && $workshopdebt->workshop_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
        </select>
        {!! $errors->first('workshop_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('paid') ? 'has-error' : ''}}">
    <label for="paid" class="col-md-4 control-label">Ödənilmiş məbləğ</label>
    <div class="col-md-6">
        <input class="form-control" name="paid" type="text" id="paid" value="{{ $workshopdebt->paid or ''}}" >
        {!! $errors->first('paid', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Əlavə et' }}">
    </div>
</div>
