<div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}">
    <label for="full_name" class="col-md-4 control-label">{{ 'Full Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="full_name" type="text" id="full_name" value="{{ $customer->full_name or ''}}" >
        {!! $errors->first('full_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">{{ 'Email' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="email" type="text" id="email" value="{{ $customer->email or ''}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="col-md-4 control-label">{{ 'Phone' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="phone" type="text" id="phone" value="{{ $customer->phone or ''}}" >
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('birth_date') ? 'has-error' : ''}}">
    <label for="birth_date" class="col-md-4 control-label">{{ 'Birth Date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="birth_date" type="date" id="birth_date" value="{{ $customer->birth_date or ''}}" >
        {!! $errors->first('birth_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gender') ? 'has-error' : ''}}">
    <label for="gender" class="col-md-4 control-label">{{ 'Gender' }}</label>
    <div class="col-md-6">
        <select name="gender" class="form-control" id="gender" >
    @foreach (config('staticData')['gender'] as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($customer->gender) && $customer->gender == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('gender', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <select name="type" class="form-control" id="type" >
    @foreach (config('staticData')['customerType'] as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($customer->type) && $customer->type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select name="status" class="form-control" id="status" >
    @foreach (config('staticData')['customerStatus'] as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($customer->status) && $customer->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="col-md-4 control-label">{{ 'Note' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="note" type="textarea" id="note" >{{ $customer->note or ''}}</textarea>
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
