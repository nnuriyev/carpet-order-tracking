@extends('admin.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Kontent</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/content/create') }}" class="btn btn-primary btn-xs" title="Add New content"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <form action="{{route('admin.contentSearch')}}" method="GET">
                                    <div class="col-md-3"><input type="text" name="name" value="{{app('request')->input('name')}}" class="form-control" placeholder="Ad"></div>
                                    <div class="col-md-3"><input type="text" name="surname" value="{{app('request')->input('surname')}}" class="form-control" placeholder="Soyad"></div>
                                    <div class="col-md-3"><input type="text" name="company" value="{{app('request')->input('company')}}" class="form-control" placeholder="Şirkət"></div>
                                    <div class="col-md-2"><button class="btn btn-primary">Search</button></div>
                                    <div class="col-md-1"><a href="{{ route('content.index') }}" class="btn btn-warning">Clear</a></div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Başlıq</th>
                                        <th>İstifadəçi</th>
                                        <th>Şirkət</th>
                                        <th>Baxış sayı</th>
                                        <th>Aktivlik</th>
                                        <th>Əməliyyatlar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($content as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ isset($item->user)?$item->user->name .' '.$item->user->surname: null }}</td>
                                        <td>{{ isset($item->user)?$item->user->company:null}}</td>
                                        <td>{{ $item->view_count }}</td>
                                        <td>
                                            @if($item->is_active==1)
                                                <span class="label label-success">Aktiv</span>
                                            @else
                                                <span class="label label-danger">Deaktiv</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/content/' . $item->id) }}" class="btn btn-success btn-xs" title="View content"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/content/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit content"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/content', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Content" />', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'title' => 'Delete content',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $content->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection