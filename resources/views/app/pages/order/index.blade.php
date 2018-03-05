@extends('app.main-layout')

@section('page-content')

<<<<<<< HEAD
=======
@php
    $adminAndSales = 'admin|sales';
@endphp

>>>>>>> 334f57bbf75847883fc6d0ba8b280452b207b8b9
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Order</div>
                    <div class="panel-body">
                        @hasanyrole($adminAndSales)
                        <a href="{{ url('/order/create') }}" class="btn btn-success btn-sm" title="Add New order">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        @endhasanyrole

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
<<<<<<< HEAD
                                        @role('admin', 'sales')
                                        <th>Müştəri</th>
                                        @endrole
                                        <th>Məhsul</th>
                                        <th>Çərçivə</th>
                                        <th>Çanta</th>
                                        @role('admin', 'sales')
=======
                                        @hasanyrole($adminAndSales)
                                        <th>Müştəri</th>
                                        @endhasanyrole

                                        <th>Məhsul</th>
                                        <th>Çərçivə</th>
                                        <th>Çanta</th>

                                        @role('admin')
                                        <th>Maya dəyəri</th>
                                        @endrole
                                        @hasanyrole($adminAndSales)
>>>>>>> 334f57bbf75847883fc6d0ba8b280452b207b8b9
                                        <th>Qiymət</th>
                                        <th>Ödənilmış məbləğ</th>
                                        <th>Endirim məbləği</th>
                                        <th>Status</th>
<<<<<<< HEAD
                                        @endrole
                                        <th>Şəkil</th>
                                        <th>Eskiz</th>
                                        @role('admin', 'sales')
                                        <th>Əməliyyatlar</th>
                                        @endrole
=======
                                        @endhasanyrole

                                        <th>Şəkil</th>
                                        <th>Eskiz</th>

                                        @hasanyrole($adminAndSales)
                                        <th>Əməliyyatlar</th>
                                        @endhasanyrole
>>>>>>> 334f57bbf75847883fc6d0ba8b280452b207b8b9
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
<<<<<<< HEAD
                                        @role('admin', 'sales')
                                        <td>{{ $item->customer->full_name }}</td>
                                        @endrole
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->frame->name }}</td>
                                        <td>{{ $item->case->name }}</td>
                                        @role('admin', 'sales')
=======
                                        @hasanyrole($adminAndSales)
                                        <td>{{ $item->customer->full_name }}</td>
                                        @endhasanyrole
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->frame->name }}</td>
                                        <td>{{ $item->case->name }}</td>
                                        @role('admin')
                                        <td>{{ $item->product_cost }}</td>
                                        @endrole
                                        @hasanyrole($adminAndSales)
>>>>>>> 334f57bbf75847883fc6d0ba8b280452b207b8b9
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->totalPaidAmount() }}</td>
                                        <td>{{ $item->discount_amount }}</td>
                                        <td>{{ config('staticData')['orderStatus'][$item->status] }}</td>
<<<<<<< HEAD
                                        @endrole
=======
                                        @endhasanyrole
>>>>>>> 334f57bbf75847883fc6d0ba8b280452b207b8b9
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
                                        @role('admin', 'sales')
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
<<<<<<< HEAD
                                        @endrole
=======
                                        
>>>>>>> 334f57bbf75847883fc6d0ba8b280452b207b8b9
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $order->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
