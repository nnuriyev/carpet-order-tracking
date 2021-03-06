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
                <option value="">Yoxdur</option>
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
                <option value="">Yoxdur</option>
            @foreach ($casesList as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($order->case_id) && $order->case_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('case_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('paid_cash') ? 'has-error' : ''}}">
    <label for="paid_cash" class="col-md-4 control-label">{{ 'Ödənilmış məbləğ(Nağd)' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="paid_cash" type="text" id="paid_cash"
               value="{{ $order->paid_cash or 0}}">
        {!! $errors->first('paid_cash', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('paid_terminal') ? 'has-error' : ''}}">
    <label for="paid_terminal" class="col-md-4 control-label">{{ 'Ödənilmış məbləğ(Terminal)' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="paid_terminal" type="text" id="paid_terminal"
               value="{{ $order->paid_terminal or 0 }}">
        {!! $errors->first('paid_terminal', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('paid_online') ? 'has-error' : ''}}">
    <label for="paid_online" class="col-md-4 control-label">{{ 'Ödənilmış məbləğ(Online)' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="paid_online" type="text" id="paid_online"
               value="{{ $order->paid_online or 0}}">
        {!! $errors->first('paid_online', '<p class="help-block">:message</p>') !!}
    </div>
</div>--}}
<div class="form-group {{ $errors->has('discount_amount') ? 'has-error' : ''}}">
    <label for="discount_amount" class="col-md-4 control-label">{{ 'Endirim məbləği' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="discount_amount" type="text" id="discount_amount"
               value="{{ $order->discount_amount or 0}}">
        {!! $errors->first('discount_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--@if(isset($order))
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
@endif--}}
{{--<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
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
@endif--}}

<div class="form-group {{ $errors->has('sale_id') ? 'has-error' : ''}}">
    <label for="sale_id" class="col-md-4 control-label">{{ 'Kampaniya' }}</label>
    <div class="col-md-6">
        <select name="sale_id" class="form-control js-example-basic-single" id="sale_id">
                <option value="">Yoxdur</option>
            @foreach ($saleList as $optionKey => $optionValue)
                <option value="{{ $optionKey }}" {{ (isset($order->sale_id) && $order->sale_id == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
            @endforeach
        </select>
        {!! $errors->first('sale_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('wanted_date') ? 'has-error' : ''}}">
    <label for="wanted_date" class="col-md-4 control-label">{{ 'Arzuolunan tarix' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="wanted_date" type="date" id="wanted_date"
               value="{{ $order->wanted_date or null}}">
        {!! $errors->first('wanted_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

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
