@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Lista de Alunos</h2>
            <a href="{{ route('alunos.create') }}" class="btn btn-primary">Cadastrar</a>
            <a href="{{ route('alunos.mostra') }}" class="btn btn-primary">Mostrar</a>
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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Gênero</th>
                    <th>Data Nascimento</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($alunos as $aluno)
                        <tr>
                            <td>{{$aluno->name}}</td>
                            <td>{{$aluno->email}}</td>
                            <td>{{$aluno->gender}}</td>
                            <td>{{ date('d/m/Y',strtotime($aluno->birthday)) }}</td>
                            <td>
                                @foreach($aluno->cursos as $curso)
                                    {{$curso->title}}<br>
                                @endforeach
                            </td>

                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{route('alunos.edit',[$aluno->id])}}" class="btn btn-warning">Editar</a>
                                     <form action="{{route('alunos.destroy',[$aluno->id])}}" method="post">
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