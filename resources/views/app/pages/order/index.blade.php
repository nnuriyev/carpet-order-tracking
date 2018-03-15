@extends('app.main-layout')

@section('page-content')

    @php
        $adminAndSales = 'admin|sales';
    @endphp

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Order
                        @hasanyrole($adminAndSales)
                        <a href="{{ url('/order/create') }}" class="btn btn-success btn-xs" title="Add New order">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yeni sifariş
                        </a>
                        @endhasanyrole
                    </div>
                    <div class="panel-body">
                        
                        <div class="col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <a href="{{ url('/order') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Tməmizlə
                            </a>
                        </div>
                        
                        <form action="{{route('order.index')}}" method="get">
                            <div class="col-md-10">
                                <div class="col-md-2">
                                    <label class="col-md-4 control-label">Müştəri</label>
                                    <input class="form-control" name="customer" type="text" value="{{request('customer')}}">
                                </div>
                                <div class="col-md-2">
                                    <label class="col-md-4 control-label">Məhsul</label>
                                    <input class="form-control" name="product" type="text" value="{{request('product')}}">
                                </div>
                                <div class="col-md-2">
                                    <label class="col-md-4 control-label">Çərçivə</label>
                                    <select class="form-control" name="frame">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('frame') == '1'  ? 'selected' : ''}} value="1">Var</option>
                                        <option {{ request('frame') == '0'  ? 'selected' : ''}} value="0">Yoxdur</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="col-md-4 control-label">Çanta</label>
                                    <select class="form-control" name="case">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('case') == '1'  ? 'selected' : ''}} value="1">Var</option>
                                        <option {{ request('case') == '0'  ? 'selected' : ''}} value="0">Yoxdur</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="paid_cash" class="col-md-4 control-label">Eskiz</label>
                                    <select class="form-control" name="sketch">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('sketch') == '1'  ? 'selected' : ''}} value="1">Var</option>
                                        <option {{ request('sketch') == '0'  ? 'selected' : ''}} value="0">Yoxdur</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="paid_cash" class="col-md-12 control-label">Sifariş m.</label>
                                    <select class="form-control" name="order_level">
                                        <option value="">Seçim edin</option>
                                        @foreach ($orderLevels as $optionKey => $optionValue)
                                            <option value="{{ $optionKey }}" {{ request('order_level') == $optionKey  ? 'selected' : ''}}>{{ $optionValue }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label class="control-label col-md-12">&nbsp;</label>
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i> Axtar
                                </button>
                            </div>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    @hasanyrole($adminAndSales)
                                    <th>Müştəri</th>
                                    @endhasanyrole

                                    <th>Məhsul</th>
                                    <th>Çərçivə</th>
                                    <th>Çanta</th>

                                    @hasanyrole('admin|workshop')
                                    <th>Maya dəyəri</th>
                                    <th>Kargo (Emalatxana)</th>
                                    @endhasanyrole

                                    @hasanyrole($adminAndSales)
                                    <th>Qiymət</th>
                                    <th>Ödənilmış məbləğ</th>
                                    <th>Endirim məbləği</th>
                                    <th>Status</th>
                                    @endhasanyrole

                                    <th>Mərhələ</th>
                                    <th>Şəkil</th>
                                    <th>Eskiz</th>

                                    @hasanyrole($adminAndSales)
                                    <th>Əməliyyatlar</th>
                                    @endhasanyrole

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        @hasanyrole($adminAndSales)
                                        <td>{{ isset($item->customer) ? $item->customer->full_name : null }}</td>
                                        @endhasanyrole
                                        <td>{{ isset($item->product) ? $item->product->name : null }}</td>
                                        <td>{{ isset($item->frame) ? $item->frame->name : null }}</td>
                                        <td>{{ isset($item->case) ? $item->case->name : null }}</td>
                                        @hasanyrole('admin|workshop')
                                        <td>{{ $item->product_cost }}</td>
                                        <td>{{ $item->cargo_cost }}</td>
                                        @endhasanyrole
                                        @hasanyrole($adminAndSales)
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->totalPaidAmount() }}</td>
                                        <td>{{ $item->discount_amount }}</td>
                                        <td>{{ config('staticData')['orderStatus'][$item->status] }}</td>
                                        @endhasanyrole
                                        <td>{{ isset($item->lastOrderlevel)?$item->lastOrderlevel->name: null }}</td>
                                        <td>
                                            @if(!is_null($item->image))
                                                <a href="{{Storage::url($item->image)}}" class="btn btn-xs btn-default"
                                                   download>
                                                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!is_null($item->sketch))
                                                <a href="{{Storage::url($item->sketch)}}"
                                                   class="btn btn-xs btn-default">
                                                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/order/' . $item->id) }}" title="View order">
                                                <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/order/' . $item->id . '/edit') }}" title="Edit order">
                                                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            @hasanyrole($adminAndSales)
                                            <form method="POST" action="{{ url('/order' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete order"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                            @endhasanyrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $orders->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
