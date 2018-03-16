@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Xərclər {{ $generalcost->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/general-cost') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/general-cost/' . $generalcost->id . '/edit') }}" title="Edit generalCost"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('generalcost' . '/' . $generalcost->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete generalCost" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $generalcost->id }}</td>
                                    </tr>
                                    <tr><th> Tip </th><td> {{ $generalcost->typeName() }} </td></tr>
                                    <tr><th> Məbləğ </th><td> {{ $generalcost->amount }} </td></tr>
                                    <tr><th> Qeyd </th><td> {{ $generalcost->note }} </td></tr>
                                    <tr><th> Tarix </th><td> {{ $generalcost->created_at }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
