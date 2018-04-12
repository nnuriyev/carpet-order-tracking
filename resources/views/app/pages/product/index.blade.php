@extends('app.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Product
                        <a href="{{ url('/product-export?'. request()->getQueryString()) }}" class="btn btn-success btn-xs pull-right">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel to export
                        </a>
                    </div>
                    <div class="panel-body">
                        @role('admin')
                        <a href="{{ url('/product/create') }}" class="btn btn-success btn-sm" title="Add New product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        @endrole
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        @role('admin')
                                        <th>Cost</th>
                                        @endrole
                                        <th>Price</th>
                                        @role('admin')
                                        <th>Actions</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ isset($item->category->name) ? $item->category->name : null }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->name }}</td>
                                        @role('admin')
                                        <td>{{ $item->cost }}</td>
                                        @endrole
                                        <td>{{ $item->price }}</td>
                                        @role('admin')
                                        <td>
                                            <a href="{{ url('/product/' . $item->id) }}" title="View product"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/product/' . $item->id . '/edit') }}" title="Edit product"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/product' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
