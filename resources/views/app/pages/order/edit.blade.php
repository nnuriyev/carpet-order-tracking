@extends('app.main-layout')

@section('page-content')

@php
$adminAndSales = 'admin|sales';
@endphp

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Sifariş mərhələləri</div>
                    <div class="panel-body">
                        <a href="{{ url('/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        <form method="POST" action="{{ url('/order/attach-order-level/' . $order->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            @include ('app/pages.order.level-form', ['submitButtonText' => 'Update'])

                        </form>

                    </div>
                </div>
            </div>
            @hasanyrole('workshop|admin')
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Kargo xərci</div>
                    <div class="panel-body">
                        <a href="{{ url('/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        <form method="POST" action="{{ url('/order/cargo-cost/' . $order->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            @include('app.pages.order.cargo-cost-form',  ['submitButtonText' => 'Update'])

                        </form>

                    </div>
                </div>
            </div>
            @endhasanyrole

            @hasanyrole($adminAndSales)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Ödəniş</div>
                    <div class="panel-body">
                        <a href="{{ url('/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        <form method="POST" action="{{ url('/order/payment/add/' . $order->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}
                            @include('app.pages.order.payment-form',  ['submitButtonText' => 'Update'])
                        </form>
                    </div>
                </div>
            </div>
            @endhasanyrole

            @hasanyrole($adminAndSales)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit order #{{ $order->id }}
                        <a href="{{ url('/order-image/'. $order->id .'/create') }}"><button class="btn btn-success btn-xs"><i class="fa fa-plus" aria-hidden="true"></i> Şəkil və ya Eskiz əlavə et</button></a>
                    </div>
                    <div class="panel-body">
                        <a href="{{ url('/order') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/order/' . $order->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            @include ('app/pages.order.form', ['submitButtonText' => 'Update'])
                        </form>
                    </div>
                </div>
            </div>
            @endhasanyrole
        </div>
    </div>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".js-example-basic-single").select2();
        });
    </script>
@endsection