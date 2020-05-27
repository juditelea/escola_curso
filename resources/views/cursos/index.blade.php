@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Lista de Cursos</h2>
            <a href="{{ route('cursos.create') }}" class="btn btn-primary">Cadastrar</a>
            @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-responsive table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $c)
                        <tr>
                            <td style="width:200px">{{$c->title}}</td>
                            <td style="overflow: hidden; text-overflow: ellipsis; max-width: 35ch; white-space: nowrap;">
                                {{ $c->description }} 
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{route('cursos.edit',[$c->id])}}" class="btn btn-warning">Editar</a>
                                     <form action="{{route('cursos.destroy',[$c->id])}}" method="post">
                                        {{csrf_field()}}{{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection