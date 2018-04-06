@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">workshopDebt {{ $workshopdebt->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/workshop-debt') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/workshop-debt/' . $workshopdebt->id . '/edit') }}" title="Edit workshopDebt"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('workshopdebt' . '/' . $workshopdebt->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete workshopDebt" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $workshopdebt->id }}</td>
                                    </tr>
                                    <tr><th> Workshop Id </th><td> {{ $workshopdebt->workshop_id }} </td></tr>
                                    <tr><th> Order Id </th><td> {{ $workshopdebt->order_id }} </td></tr>
                                    <tr><th> Note </th><td> {{ $workshopdebt->note }} </td></tr>
                                    <tr><th> Debt </th><td> {{ $workshopdebt->debt }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
