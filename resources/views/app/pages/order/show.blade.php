@extends('app.main-layout')

@section('page-content')

@php
$adminAndSales = 'admin|sales';
@endphp

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Sifariş {{ $order->id }}</div>
                    <div class="panel-body">
                        @role('workshop')
                            <a href="{{ url('/current-order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @endrole
                        @hasanyrole($adminAndSales)
                            <a href="{{ url('/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                            <a href="{{ url('/order/invoice/' . $order->id) }}" title="View order"><button class="btn btn-info btn-xs"><i class="fa fa-paperclip" aria-hidden="true"></i> Invoice</button></a>

                        @endhasanyrole
                        <a href="{{ url('/order/' . $order->id . '/edit') }}" title="Edit order"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        @hasanyrole($adminAndSales)
                        <form method="POST" action="{{ url('order' . '/' . $order->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete order" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        @endhasanyrole
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $order->id }}</td>
                                    </tr>
                                    @hasanyrole($adminAndSales)
                                    <tr>
                                        <th> Müştəri</th>
                                        <td> {{ isset($order->customer)? $order->customer->full_name : null }} </td>
                                    </tr>
                                    @endhasanyrole
                                    <tr>
                                        <th> Məhsul</th>
                                        <td> {{ isset($order->product) ? $order->product->code . ' - ' . $order->product->name : null}} </td>
                                    </tr>
                                    <tr>
                                        <th> Çərçivə</th>
                                        <td> {{ isset($order->frame)? $order->frame->code . ' - ' . $order->frame->name : null }} </td>
                                    </tr>
                                    <tr>
                                        <th> Çanta</th>
                                        <td> {{ isset($order->case)? $order->case->code . ' - ' . $order->case->name : null }} </td>
                                    </tr>
                                    @hasanyrole('admin|workshop')
                                    <tr>
                                        <th> Maya dəyəri</th>
                                        <td> {{ $order->product_cost }} AZN</td>
                                    </tr>
                                    <tr>
                                        <th> Kargo (Emalatxana)</th>
                                        <td> {{ $order->cargo_cost }} AZN</td>
                                    </tr>
                                    @endhasanyrole
                                    @hasanyrole($adminAndSales)
                                    <tr>
                                        <th> Qiymət</th>
                                        <td> {{ $order->price }} AZN</td>
                                    </tr>
                                    <tr>
                                        <th> Endirim məbləği</th>
                                        <td> {{ $order->discount_amount }} AZN</td>
                                    </tr>
                                    <tr class="green">
                                        <th> Ödənilmış məbləğ</th>
                                        <td> {{ $order->totalPaidAmount() }} AZN</td>
                                    </tr>
                                    <tr class="red">
                                        <th> Ödənilməli məbləğ</th>
                                        <td> {{ $order->restOfAmount() }} AZN</td>
                                    </tr>
                                    <tr>
                                        <th> Status</th>
                                        <td> {{ config('staticData')['orderStatus'][$order->status] }} </td>
                                    </tr>
                                    @endhasanyrole
                                    <tr>
                                        <th> Qeyd</th>
                                        <td> {{ $order->note }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Şəkilər və eskizlər
                        @hasanyrole($adminAndSales)
                        <a href="{{ url('/order-image/'.$order->id.'/create') }}" title="Yeni şəkil"><button class="btn btn-success btn-xs"><i class="fa fa-plus" aria-hidden="true"></i> Yeni şəkil</button></a>
                        @endhasanyrole
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tarix</th>
                                    <th>Şəkil</th>
                                    <th>Eskiz</th>
                                    <th>Qeyd</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->images as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if(!is_null($item->image))
                                            <a href="{{Storage::url($item->image)}}" download>
                                                <img src="{{Storage::url($item->image)}}" height="70">
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!is_null($item->sketch))
                                            <a href="{{Storage::url($item->sketch)}}" download>
                                                <img src="{{Storage::url($item->sketch)}}" height="70">
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{ $item->note }}</td>
                                        <td>{!! $item->status == 1 ? '<span class="green">Təsdiqlənib</span>' : '' !!}</td>
                                        <td>
                                            <a href="{{ url('/order-image/' . $item->id . '/edit') }}" title="Edit"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Sifariş mərhələləri</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mərhələ</th>
                                    <th>Daxil edilmə tarixi</th>
                                    <th>Tamamlanma tarixi</th>
                                    <th>Qeyd</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->orderLevels as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ date('d-m-Y h:i', strtotime($item->pivot->created_at)) }}</td>
                                        <td>{{ $item->pivot->due_date != null ? date('d-m-Y', strtotime($item->pivot->due_date)):null }}</td>
                                        <td>{{ Auth::user()->hasRole('sales') && $item->key == 'emalatxanadan_cixdi'? '' : $item->pivot->note  }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @hasanyrole($adminAndSales)
                <div class="panel panel-default">
                    <div class="panel-heading">Sifariş ödənişləri</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nəbləğ</th>
                                    <th>Ödəniş tipi</th>
                                    <th>Ödəniş tarixi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->cutomerPayments as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->amount }} AZN</td>
                                        <td>{{ config('staticData')['paymentType'][$item->type] }}</td>
                                        <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endhasanyrole
            </div>
        </div>
    </div>
@endsection
