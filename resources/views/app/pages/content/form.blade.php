<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Başlıq', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{!! Form::hidden('view_count', null) !!}

<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'İstifadəçi', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
    {!! Form::label('is_active', 'Aktivlik', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('is_active', [ 1=>'Aktiv', 0=>' Deaktiv'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    {!! Form::label('content', 'Kontent', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('content', null, ['class' => 'form-control mceEditor']) !!}
        {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
    </div>
</div>



<div class="form-group">
    <div class="col-md-offset-2 col-md-2">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

