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

                        <a href="{{ url('/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        @hasanyrole($adminAndSales)
                        @if($order->status == 2)
                            <a href="{{ url('/order/invoice/' . $order->id) }}" title="View order"><button class="btn btn-info btn-xs"><i class="fa fa-paperclip" aria-hidden="true"></i> Invoice</button></a>
                        @endif
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
                            <table class="table table-borderless">
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
                                        <th> Ödənilmış məbləğ</th>
                                        <td> {{ $order->totalPaidAmount() }} AZN</td>
                                    </tr>
                                    <tr>
                                        <th> Endirim məbləği</th>
                                        <td> {{ $order->discount_amount }} AZN</td>
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
                                    <tr>
                                        <th> Şəkil</th>
                                        <td>
                                            <a href="{{Storage::url($order->image)}}" download>
                                                <img src="{{Storage::url($order->image)}}" height="150">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Eskiz</th>
                                        <td>
                                            @if(!is_null($order->sketch))
                                            <a href="{{Storage::url($order->sketch)}}" download>
                                                <img src="{{Storage::url($order->sketch)}}" height="150">
                                            </a>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Sifariş mərhələləri</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
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
                                        <td>{{ $item->pivot->created_at }}</td>
                                        <td>{{ $item->pivot->due_date }}</td>
                                        <td>{{ $item->pivot->note }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Sifariş ödənişləri</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
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
                                        <td>{{ $item->created_at }}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
