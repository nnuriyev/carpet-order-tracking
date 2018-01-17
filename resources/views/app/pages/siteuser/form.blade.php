<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Ad', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('surname') ? 'has-error' : ''}}">
    {!! Form::label('surname', 'Soyad', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('surname', null, ['class' => 'form-control']) !!}
        {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
    {!! Form::label('company', 'Şirkət adı', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('company', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Şifrə', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('activty_date') ? 'has-error' : ''}}">
    {!! Form::label('activty_date', 'Aktivlik tarixi', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('activty_date', \Carbon\Carbon::now(),['class' => 'form-control']) !!}
        {!! $errors->first('activty_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
    {!! Form::label('is_active', 'Aktivlik', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('is_active', [ 1=>'Aktiv', 0=>' Deaktiv'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>