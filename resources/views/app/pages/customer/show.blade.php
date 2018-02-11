@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">customer {{ $customer->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/customer') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/customer/' . $customer->id . '/edit') }}" title="Edit customer"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('customer' . '/' . $customer->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete customer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $customer->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Full Name </th>
                                        <td> {{ $customer->full_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $customer->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Phone </th>
                                        <td> {{ $customer->phone }} </td>
                                    </tr>
                                    <tr>
                                        <th> Birth date </th>
                                        <td> {{ $customer->birth_date }} </td>
                                    </tr>
                                    <tr>
                                        <th> Gender </th>
                                        <td> {{ config('staticData')['gender'][$customer->gender] }} </td>
                                    </tr>
                                    <tr>
                                        <th> Type </th>
                                        <td> {{ config('staticData')['customerType'][$customer->type] }} </td>
                                    </tr>
                                    <tr>
                                        <th> Status </th>
                                        <td> {{ config('staticData')['customerStatus'][$customer->status] }} </td>
                                    </tr>
                                    <tr>
                                        <th> Note </th>
                                        <td> {{ $customer->note }} </td>
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
