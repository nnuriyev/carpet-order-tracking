@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Maliyyə hesabatı
                    </div>
                    <div class="panel-body">

                        <div class="col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <a href="{{ url('/customer-payment') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Təmizlə
                            </a>
                        </div>
                        
                        <form action="{{route('customerPayment.index')}}" method="get">
                            <div class="col-md-10">
                                <div class="col-md-4">
                                    <label class="control-label">Ödəniş tipi</label>
                                    <select class="form-control" name="type">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('type') == '1'  ? 'selected' : ''}} value="1">Nağd</option>
                                        <option {{ request('type') == '3'  ? 'selected' : ''}} value="3">Terminal</option>
                                        <option {{ request('type') == '2'  ? 'selected' : ''}} value="2">Online</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Tarix(Başlanğıc)</label>
                                    <input class="form-control" name="date_from" type="date" value="{{request('date_from')}}">
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Tarix(Bitmə)</label>
                                    <input class="form-control" name="date_to" type="date" value="{{request('date_to')}}">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label class="control-label col-md-12">&nbsp;</label>
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i> Axtar
                                </button>
                            </div>
                        </form>

                        <hr>
                        @role('admin')
                        <div class="row top_tiles" style="margin: 10px 0;">
                            @php
                                $totalAmount = $customerPayments->sum('amount');
                                $cash = $customerPayments->where('type', 1)->sum('amount');
                                $online = $customerPayments->where('type', 2)->sum('amount');
                                $terminal = $customerPayments->where('type', 3)->sum('amount');
                            @endphp
                            <div class="col-md-3 tile green">
                                <span>Ümumi Ödəniş</span>
                            <h2>{{ $totalAmount }} AZN</h2>
                            </div>
                            <div class="col-md-2 tile blue">
                                <span>Nağd ödəniş</span>
                                <h2>{{ $cash }} AZN</h2>
                            </div>
                            <div class="col-md-2 tile blue">
                                <span>Terminal ilə ödəniş</span>
                                <h2>{{ $terminal }} AZN</h2>
                            </div>
                            <div class="col-md-2 tile blue">
                                <span>Online ödəniş</span>
                                <h2>{{ $online }} AZN</h2>
                            </div>
                            <div class="col-md-2 tile">
                                <span>Nəticə sayı</span>
                                <h2>{{ $customerPayments->count() }}</h2>
                            </div>
                        </div>
                        <hr>
                        @endrole
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Müştəri</th>
                                        <th>Sifariş id</th>
                                        <th>Kateqoriya</th>
                                        <th>Məhsul</th>
                                        <th>Status</th>
                                        <th>Ödəniş</th>
                                        <th>Ödəniş tipi</th>
                                        <th>Tarix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customerPayments as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ isset($item->order->customer->full_name) ? $item->order->customer->full_name : null }}</td>
                                        <td>{{ isset($item->order->id) ? $item->order->id : null }}</td>
                                        <td>{{ isset($item->order->product->category->name) ? $item->order->product->category->name : null }}</td>
                                        <td>{{ isset($item->order->product->name) ? $item->order->product->name : null }}</td>
                                        <td>{{ isset($item->order->status) ? $item->order->statusName() : null }}</td>
                                        <td class="green">{{ $item->amount . ' AZN' }}</td>
                                        <td>{{ $item->typeName() }}</td>
                                        <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $customerPayments->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
