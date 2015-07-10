@extends('template')

@section('title')Uploads App @endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel-body">

            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Selecionar arquivos...</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files"
                    data-token="{!! csrf_token() !!}"
                    data-user-id="{!! $user->id !!}"/>
            </span>

            <!-- The global progress bar -->
            <div id="progress" class="progress" style="margin-top: 20px">
                <div class="progress-bar progress-bar-success"></div>
            </div>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {!! Session::get('success') !!}
                </div>
            @endif

            <div class="alert alert-success hide" id="upload-success">
                Upload realizado com sucesso!
            </div>

            <div id="erro"></div>

            <table class="table  table-striped table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Enviado em</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->files as $file)
                <tr>
                    <td>{!! $file->name !!}</td>
                    <td>{!! $file->created_at !!}</td>
                    <td>{!! $user->name !!}</td>
                    <td>
                        <a href="{!! route('files.download', [$user->id, $file->id]) !!}" class="btn btn-xs btn-success">download</a>
                    	<a href="{!! route('files.destroy', [$user->id, $file->id]) !!}" class="btn btn-xs btn-danger">excluir</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        </div>
    </div>
</div>
@stop

@section('scripts')
@parent
<script src="/js/app.js"></script>
@stop
