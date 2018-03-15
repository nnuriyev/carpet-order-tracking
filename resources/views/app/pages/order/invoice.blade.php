@extends('app.main-layout')

@section('page-content')

@php
$adminAndSales = 'admin|sales';
@endphp

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Sifariş #{{$order->id}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <section class="content invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12 invoice-header">
                                    <h1>
                                        Faktura
                                        <small class="pull-right">Tarix: {{date('d.m.Y')}}</small>
                                    </h1>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    İcraçı
                                    <address>
                                        <strong>Xalca toxuma(test)</strong>
                                        <br>Heydər Əliyev pr. 34
                                        <br>Azerbaycan, Bakı, AZ1000
                                        <br>Telefon: +994 12 123 45 67
                                        <br>Email: info@domain.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Sifarişçi
                                    <address>
                                        <strong>{{$order->customer->full_name}}</strong>
                                        <br>Phone: {{$order->customer->phone}}
                                        <br>Email: {{$order->customer->email}}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Faktura #{{$order->id}}</b>
                                    <br>
                                    <br>
                                    <b>Sifariş ID:</b> {{$order->id}}
                                    <br>
                                    <b>Sifariş tarixi:</b> {{$order->created_at}}
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Miqdar</th>
                                            <th>Məhsul</th>
                                            <th>Məhsul kodu</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$order->product->name}}</td>
                                            <td>{{$order->product->code}}</td>
                                        </tr>
                                        @if(isset($order->frame) && $order->frame_id != null )
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $order->frame->name }}</td>
                                            <td>{{$order->frame->code}}</td>
                                        </tr>
                                        @endif
                                        @if(isset($order->case) && $order->case_id != null )
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $order->case->name }}</td>
                                                <td>{{$order->case->code}}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-xs-6">

                                </div>
                                <!-- /.col -->
                                <div class="col-xs-6">
                                    {{--<p class="lead">Tamamlanma vaxtı: {{$order->lastOrderLevel()->pivot->created_at}}</p>--}}
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th style="width:50%">Qiymət:</th>
                                                <td>{{$order->price}} AZN</td>
                                            </tr>
                                            <tr>
                                                <th>Endirim:</th>
                                                <td>-{{$order->discount_amount != null ? $order->discount_amount : 0}} AZN</td>
                                            </tr>
                                            <tr>
                                                <th>Yekun qiymət:</th>
                                                <td>{{$order->price}} AZN</td>
                                            </tr>
                                            <tr>
                                                <th>Ödənilib:</th>
                                                <td><b>{{$order->paid_cash +
                                                 $order->paid_online +
                                                 $order->paid_terminal }} AZN</b></td>
                                            </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
    @media print {
        footer *, .top_nav *,  .no-print *, .sidebar *, .x_title{
            display: none;
        }
    }
</style>

@endsection