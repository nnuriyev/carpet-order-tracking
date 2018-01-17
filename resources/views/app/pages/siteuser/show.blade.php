@extends('admin.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">İstifadəçilər</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/siteuser/' . $siteuser->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Admin"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/siteuser', $siteuser->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Admin',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $siteuser->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Ad </th>
                                        <td> {{ $siteuser->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Soyad </th>
                                        <td> {{ $siteuser->surname }} </td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $siteuser->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Kontent sayı </th>
                                        <td> {{ $siteuser->contents->count() }} </td>
                                    </tr>
                                    <tr>
                                        <th> Aktivlik</th>
                                        <td>
                                            @if($siteuser->is_active==1)
                                                <span class="label label-success">Aktiv</span>
                                            @else
                                                <span class="label label-danger">Deaktiv</span>
                                            @endif
                                        </td>
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