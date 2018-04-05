@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Emalatxana hesabatı
                        @role('admin')
                        <a href="{{ url('/workshop-debt/create') }}" class="btn btn-success btn-xs" title="Add New workshopDebt">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yeni ödəniş
                        </a>
                        @endrole
                    </div>
                    <div class="panel-body">

                        <div class="col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <a href="{{ url('/workshop-debt') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Tməmizlə
                            </a>
                        </div>
                        
                        <form action="{{route('workshop-debt.index')}}" method="get">
                            <div class="col-md-10">
                                @role('admin')
                                <div class="col-md-2">
                                    <label class="col-md-12 control-label">Emalatxana</label>
                                    <select class="form-control" name="workshop_id">
                                        <option value="">Seçim edin</option>
                                        @foreach ($workshops as $optionKey => $optionValue)
                                            <option value="{{ $optionKey }}" {{ request('workshop_id') == $optionKey  ? 'selected' : ''}}>{{ $optionValue }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Sifariş id</label>
                                    <input class="form-control" name="order_id" type="text" value="{{request('order_id')}}">
                                </div>
                                @endrole
                                <div class="col-md-2">
                                    <label class="control-label">Borc/Ödəniş</label>
                                    <select class="form-control" name="type">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('type') == '0'  ? 'selected' : ''}} value="0">Borc</option>
                                        <option {{ request('type') == '1'  ? 'selected' : ''}} value="1">Ödəniş</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Tarix(Başlanğıc)</label>
                                    <input class="form-control" name="date_from" type="date" value="{{request('date_from')}}">
                                </div>
                                <div class="col-md-3">
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
                        <div class="row top_tiles" style="margin: 10px 0;">
                            @php
                                $totalDebt = $workshopdebt->sum('debt');
                                $totalPaid = $workshopdebt->sum('paid');
                                $currentDebt = $totalDebt - $totalPaid;
                            @endphp
                            <div class="col-md-3 tile blue">
                                <span>Ödənilməli məbləğ</span>
                            <h2>{{ $totalDebt }} AZN</h2>
                            </div>
                            <div class="col-md-3 tile green">
                                <span>Ödənilmiş məbləğ</span>
                                <h2>{{ $totalPaid }} AZN</h2>
                            </div>
                            <div class="col-md-3 tile red">
                                <span>Cari borc</span>
                                <h2>{{ $currentDebt }} AZN</h2>
                            </div>
                            <div class="col-md-3 tile">
                                    <span>Nəticə sayı</span>
                                    <h2>{{ $workshopdebt->count() }}</h2>
                                </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Emalatxana</th>
                                        <th>Sifariş Id</th>
                                        <th>Borc</th>
                                        <th>Ödəniş</th>
                                        <th>Tarix</th>
                                        @role('admin')
                                        <th>Əməliyyatlar</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($workshopdebt as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->workshop->name }}</td>
                                        <td>{{ $item->order_id }}</td>
                                        <td class="red">{{ $item->debt != null ? $item->debt . ' AZN': null }}</td>
                                        <td class="green">{{ $item->paid != null ? $item->paid . ' AZN': null }}</td>
                                        <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }}</td>
                                        @role('admin')
                                        <td>
                                            @if($item->paid != null)
                                            {{--  <a href="{{ url('/workshop-debt/' . $item->id) }}" title="View workshopDebt"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>  --}}
                                            
                                            <a href="{{ url('/workshop-debt/' . $item->id . '/edit') }}" title="Edit workshopDebt"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            
                                            {{--  <form method="POST" action="{{ url('/workshop-debt' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete workshopDebt" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>  --}}
                                            @endif
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $workshopdebt->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
