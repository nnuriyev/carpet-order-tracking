@extends('app.main-layout')

@section('page-content')


@php
$adminAndSales = 'admin|sales';
@endphp

@hasanyrole($adminAndSales)
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading">Bu gün ofisə gəlməli sifarişlər -> {{ date('d-m-Y') }}</div>
                <div class="panel-body">
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Müştəri</th>
                                    <th>Məhsul</th>
                                    <th>Çərçivə</th>
                                    <th>Çanta</th>
                                    <th>Arzuolunan tarix</th>
                                    <th>Eskizin tesdiq tarixi</th>
                                    <th>Şəkil</th>
                                    <th>Eskiz</th>
                                    <th>Əməliyyatlar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($actualOrders as $item)
                                
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ isset($item->customer) ? $item->customer->full_name : null }}</td>
                                    <td>{{ isset($item->product) ? $item->product->name : null }}</td>
                                    <td>{{ isset($item->frame) ? $item->frame->name : null }}</td>
                                    <td>{{ isset($item->case) ? $item->case->name : null }}</td>
                                    <td>{{  $item->wanted_date != null ? date('d-m-Y', strtotime($item->wanted_date)): null }}</td>
                                    <td>{{  $item->getSketchConfirmDate() != null ? date('d-m-Y', strtotime($item->getSketchConfirmDate())): null }}</td>
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
                                    </td>
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
@endhasanyrole
@endsection

@section('page-scripts')
<script>
    setInterval(function(){
        window.location.reload();
    }, 60000);
</script>
@endsection