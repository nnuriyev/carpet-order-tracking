@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">order {{ $order->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/order/' . $order->id . '/edit') }}" title="Edit order"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('order' . '/' . $order->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete order" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Customer</th>
                                        <td> {{ $order->customer->full_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Product</th>
                                        <td> {{ $order->product->code . ' - ' . $order->product->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Frame</th>
                                        <td> {{ $order->frame->code . ' - ' . $order->frame->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Case</th>
                                        <td> {{ $order->case->code . ' - ' . $order->case->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Price</th>
                                        <td> {{ $order->price }} AZN</td>
                                    </tr>
                                    <tr>
                                        <th> Paid amount</th>
                                        <td> {{ $order->paid_amount }} AZN</td>
                                    </tr>
                                    <tr>
                                        <th> Discount amount</th>
                                        <td> {{ $order->discount_amount }} AZN</td>
                                    </tr>
                                    <tr>
                                        <th> Status</th>
                                        <td> {{ config('staticData')['orderStatus'][$order->status] }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
