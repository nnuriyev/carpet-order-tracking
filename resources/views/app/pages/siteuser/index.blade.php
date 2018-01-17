@extends('admin.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">İstifadəçilər</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/siteuser/create') }}" class="btn btn-primary btn-xs" title="Add New User"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Ad </th>
                                        <th> Soyad </th>
                                        <th> Şirkət adı </th>
                                        <th> Email </th>
                                        <th> Kontent sayı </th>
                                        <th> Aktivlik tarixi </th>
                                        <th> Aktivlik </th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($siteuser as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->surname }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->contents->count() }}</td>
                                        <td>{{ $item->activty_date }}</td>
                                        <td>
                                            @if($item->is_active==1)
                                                <span class="label label-success">Aktiv</span>
                                            @else
                                                <span class="label label-danger">Deaktiv</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/siteuser/' . $item->id) }}" class="btn btn-success btn-xs" title="View Admin"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/siteuser/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Admin"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/siteuser', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete user',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $siteuser->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection