@extends('app.main-layout')

@section('page-content')

@php
$adminAndSales = 'admin|sales';
@endphp

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Order</div>
                    <div class="panel-body">
                        <form method="GET" action="{{ url('/order') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
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

                                        @hasanyrole($adminAndSales)
                                        <th>Qiymət</th>
                                        <th>Ödənilmış məbləğ</th>
                                        <th>Endirim məbləği</th>
                                        <th>Status</th>
                                        @endhasanyrole

                                        <th>Şəkil</th>
                                        <th>Eskiz</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $item)
                                    @if($item->checkLastOrderLevelAccess($access))
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        @hasanyrole($adminAndSales)
                                        <td>{{ $item->customer->full_name }}</td>
                                        @endhasanyrole
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->frame->name }}</td>
                                        <td>{{ $item->case->name }}</td>
                                        @hasanyrole($adminAndSales)
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->totalPaidAmount() }}</td>
                                        <td>{{ $item->discount_amount }}</td>
                                        <td>{{ config('staticData')['orderStatus'][$item->status] }}</td>
                                        @endhasanyrole
                                        <td>
                                            @if(!is_null($item->image))
                                                <a href="{{Storage::url($item->image)}}" class="btn btn-xs btn-default" download>
                                                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!is_null($item->sketch))
                                                <a href="{{Storage::url($item->sketch)}}" class="btn btn-xs btn-default">
                                                    <i class="fa fa-cloud-download" aria-hidden="true"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/order/' . $item->id) }}" title="View order"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/order/' . $item->id . '/edit') }}" title="Edit order"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            @hasanyrole($adminAndSales)
                                            <form method="POST" action="{{ url('/order' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete order" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            @endhasanyrole
                                        </td>
                                    </tr>
                                    @endif
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
