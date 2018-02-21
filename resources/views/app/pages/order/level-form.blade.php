{{--
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="col-md-4 control-label">{{ 'Müştəri' }}</label>
    <div class="col-md-6">
        <select name="customer_id" class="form-control js-example-basic-single" id="customer_id">
            @foreach ($customerList as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($order->customer_id) && $order->customer_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="col-md-4 control-label">{{ 'Məhsul' }}</label>
    <div class="col-md-6">
        <select name="product_id" class="form-control js-example-basic-single" id="product_id">
            @foreach ($productList as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($order->product_id) && $order->product_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('frame_id') ? 'has-error' : ''}}">
    <label for="frame_id" class="col-md-4 control-label">{{ 'Çərçivə' }}</label>
    <div class="col-md-6">
        <select name="frame_id" class="form-control js-example-basic-single" id="frame_id">
            @foreach ($frameList as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($order->frame_id) && $order->frame_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('frame_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('case_id') ? 'has-error' : ''}}">
    <label for="case_id" class="col-md-4 control-label">{{ 'Çanta' }}</label>
    <div class="col-md-6">
        <select name="case_id" class="form-control js-example-basic-single" id="case_id">
            @foreach ($casesList as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($order->case_id) && $order->case_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('case_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('paid_amount') ? 'has-error' : ''}}">
    <label for="paid_amount" class="col-md-4 control-label">{{ 'Ödənilmış məbləğ' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="paid_amount" type="text" id="paid_amount"
               value="{{ $order->paid_amount or ''}}">
        {!! $errors->first('paid_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('discount_amount') ? 'has-error' : ''}}">
    <label for="discount_amount" class="col-md-4 control-label">{{ 'Endirim məbləği' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="discount_amount" type="text" id="discount_amount"
               value="{{ $order->discount_amount or ''}}">
        {!! $errors->first('discount_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select name="status" class="form-control" id="status">
            @foreach (config('staticData')['orderStatus'] as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($order->status) && $order->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Şəkil' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="image" type="file" id="image">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(isset($order))
    <div class="form-group {{ $errors->has('sketch') ? 'has-error' : ''}}">
        <label for="sketch" class="col-md-4 control-label">{{ 'Eskiz' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="sketch" type="file" id="sketch">
            {!! $errors->first('sketch', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif

<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="col-md-4 control-label">{{ 'Qeyd' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="note" type="textarea" id="note">{{ $order->note or ''}}</textarea>
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
--}}
