@extends('admin.main-layout')

@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Kontent</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/content/' . $content->id . '/edit') }}" class="btn btn-primary btn-xs"
                           title="Edit content"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/content', $content->id],
                            'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'Delete content',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>


                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $content->id }}</td>
                                </tr>
                                <tr>
                                    <th> Başlıq</th>
                                    <td> {{ $content->title }} </td>
                                </tr>
                                <tr>
                                    <th> İstifadəçi</th>
                                    <td> {{ isset($content->user)? $content->user->name .' '.$content->user->surname : null }} </td>
                                </tr>
                                <tr>
                                    <th> Baxış sayı</th>
                                    <td> {!! $content->view_count !!}</td>
                                </tr>
                                <tr>
                                    <th> Aktivlik</th>
                                    <td>
                                        @if($content->is_active==1)
                                            <span class="label label-success">Aktiv</span>
                                        @else
                                            <span class="label label-danger">Deaktiv</span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <br>
                            <br>

                            {!! $content->content !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection