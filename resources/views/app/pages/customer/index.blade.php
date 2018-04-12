@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Customer
                        <a href="{{ url('/customer/create') }}" class="btn btn-success btn-xs" title="Add New customer">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <a href="{{ url('/customer-export?'. request()->getQueryString()) }}" class="btn btn-success btn-xs pull-right">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel to export
                        </a>
                    </div>
                    <div class="panel-body">
                        
                        <div class="col-md-1">
                            <label class="control-label">&nbsp;</label>
                            <a href="{{ url('/customer') }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Təmizlə
                            </a>
                        </div>

                        <form action="{{route('customer.index')}}" method="get">
                            <div class="col-md-10">
                                <div class="col-md-2">
                                    <label class="control-label">Ad soyad</label>
                                    <input class="form-control" name="full_name" type="text" value="{{request('full_name')}}">
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Email</label>
                                    <input class="form-control" name="email" type="text" value="{{request('email')}}">
                                </div>
                                <div class="col-md-2">
                                        <label class="control-label">Telefon</label>
                                        <input class="form-control" name="phone" type="text" value="{{request('phone')}}">
                                    </div>
                                <div class="col-md-2">
                                    <label class="control-label">Cins</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('gender') == '1'  ? 'selected' : ''}} value="1">Kişi</option>
                                        <option {{ request('gender') == '0'  ? 'selected' : ''}} value="0">Qadın</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Tip</label>
                                    <select class="form-control" name="type">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('type') == '0'  ? 'selected' : ''}} value="0">VIP</option>
                                        <option {{ request('type') == '1'  ? 'selected' : ''}} value="1">Standart</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Seçim edin</option>
                                        <option {{ request('status') == '0'  ? 'selected' : ''}} value="0">Nəzarətdə</option>
                                        <option {{ request('status') == '1'  ? 'selected' : ''}} value="1">Maraqlandı</option>
                                        <option {{ request('status') == '2'  ? 'selected' : ''}} value="2">Sifariş</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <label class="control-label col-md-12">&nbsp;</label>
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i> Axtar
                                </button>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Birth date</th>
                                        <th>Gender</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($customer as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->birth_date }}</td>
                                        <td>{{ config('staticData')['gender'][$item->gender] }}</td>
                                        <td>{{ config('staticData')['customerType'][$item->type] }}</td>
                                        <td>{{ config('staticData')['customerStatus'][$item->status] }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>
                                            <a href="{{ url('/customer/' . $item->id) }}" title="View customer"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/customer/' . $item->id . '/edit') }}" title="Edit customer"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            @role('admin')
                                            <form method="POST" action="{{ url('/customer' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete customer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            @endrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $customer->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
