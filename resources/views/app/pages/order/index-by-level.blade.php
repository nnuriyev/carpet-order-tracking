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
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @hasanyrole($adminAndSales)
                                        <th>Müştəri</th>
                                        @endhasanyrole

                                        <th>Məhsul</th>
                                        @hasanyrole($adminAndSales)
                                        <th>Çərçivə</th>
                                        <th>Çanta</th>
                                        @endhasanyrole
                                        @hasanyrole('admin|workshop')
                                        <th>Maya dəyəri</th>
                                        <th>Kargo (Emalatxana)</th>
                                        @endhasanyrole

                                        @hasanyrole($adminAndSales)
                                        <th>Qiymət</th>
                                        <th>Ödənilmış məbləğ</th>
                                        <th>Endirim məbləği</th>
                                        <th>Ödənilməli məbləğ</th>
                                        @endhasanyrole

                                        <th>Arzuolunan tarix</th>
                                        <th>Eskizin tesdiq tarixi</th>
                                        <th>Mərhələ</th>
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
                                        <td>{{ isset($item->customer) ? $item->customer->full_name : null }}</td>
                                        @endhasanyrole

                                        <td>{{ isset($item->product) ? $item->product->name : null }}</td>
                                        @hasanyrole($adminAndSales)
                                        <td>{{ isset($item->frame) ? $item->frame->name : null }}</td>
                                        <td>{{ isset($item->case) ? $item->case->name : null }}</td>
                                        @endhasanyrole
                                        @hasanyrole('admin|workshop')
                                        <td>{{ $item->product_cost }}</td>
                                        <td>{{ $item->cargo_cost }}</td>
                                        @endhasanyrole
                                        @hasanyrole($adminAndSales)
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->totalPaidAmount() }}</td>
                                        <td>{{ $item->discount_amount }}</td>
                                        <td>{{ $item->restOfAmount() }}</td>
                                        @endhasanyrole
                                        <td>{{  $item->wanted_date != null ? date('d-m-Y', strtotime($item->wanted_date)): null }}</td>
                                        <td>{{  $item->getSketchConfirmDate() != null ? date('d-m-Y', strtotime($item->getSketchConfirmDate())): null }}</td>
                                        <td>{{ isset($item->lastOrderlevel)?$item->lastOrderlevel->name: null }}</td>
                                        <td>
                                            @if(count($item->images)>0)
                                                <a href="{{Storage::url($item->getImage())}}" download>
                                                    <img height="50" src="{{ url('/') . '/resizer.php?src=' . Storage::url($item->getImage()) .'&zc=3&w=70&h=70'}}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(count($item->images)>0)
                                                <a href="{{Storage::url($item->getSketch())}}" download>
                                                    <img height="50" src="{{url('/').'/resizer.php?src='. Storage::url($item->getSketch()) .'&zc=3&w=70&h=70'}}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/order/' . $item->id) }}" title="View order"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/order/' . $item->id . '/edit') }}" title="Edit order"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            {{-- @hasanyrole($adminAndSales)
                                            <form method="POST" action="{{ url('/order' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete order" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            @endhasanyrole --}}
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
