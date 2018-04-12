@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Xərclər 
                        <a href="{{ url('/general-cost/create') }}" class="btn btn-success btn-xs" title="Add New generalCost">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <a href="{{ url('/general-cost-export?'. request()->getQueryString()) }}" class="btn btn-success btn-xs pull-right">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel to export
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <a href="{{ url('/general-cost') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Təmizlə
                            </a>
                        </div>
                        
                        <form action="{{route('general-cost.index')}}" method="get">
                            <div class="col-md-10">
                                <div class="col-md-4">
                                    <label class="control-label">Tip</label>
                                    <select class="form-control" name="type">
                                        <option value="">Seçim edin</option>
                                        @foreach (config('staticData')['costType'] as $optionKey => $optionValue)
                                            <option value="{{ $optionKey }}" {{ request('type') == $optionKey ? 'selected' : ''}}>{{ $optionValue }}</option>
                                        @endforeach
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
                        <div class="row top_tiles" style="margin: 10px 0;">
                            @php
                                $totalAmount = $generalcost->sum('amount');
                            @endphp
                            <div class="col-md-3 tile red">
                                <span>Ümumi xərc</span>
                                <h2>{{ $totalAmount }} AZN</h2>
                            </div>
                            <div class="col-md-3 tile">
                                <span>Nəticə sayı</span>
                                <h2>{{ $generalcost->count() }}</h2>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tip</th>
                                        <th>Məbləğ</th>
                                        <th>Qeyd</th>
                                        <th>Tarix</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($generalcost as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->typeName() }}</td>
                                        <td class="red">{{ $item->amount }} AZN</td>
                                        <td>{{ $item->note }}</td>
                                        <td>{{ date('d-m-Y h:i', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('/general-cost/' . $item->id) }}" title="View generalCost"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/general-cost/' . $item->id . '/edit') }}" title="Edit generalCost"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/general-cost' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete generalCost" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $generalcost->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
