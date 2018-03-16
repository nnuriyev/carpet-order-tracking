@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Xərclər</div>
                    <div class="panel-body">
                        <a href="{{ url('/general-cost/create') }}" class="btn btn-success btn-sm" title="Add New generalCost">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Tip</th><th>Məbləğ</th><th>Qeyd</th><th>Tarix</th><th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($generalcost as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->typeName() }}</td><td>{{ $item->amount }}</td><td>{{ $item->note }}</td><td>{{ $item->created_at }}</td>
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
