@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Alterar Aluno</h2>
            <ul class="nav">
                <li class="nav-item"><a href="{{route('alunos.index')}}">Listar Alunos</a> </li>
            </ul>
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
            <form action="{{route('alunos.update',[$aluno->id])}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome..." value="{{$aluno->name}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email..." value="{{$aluno->email}}"
                           required>
                </div>
                <div class="form-group">
                    <label for="birthday">Data Nascimento:</label>
                    <input type="text" name="birthday" id="birthday" class="form-control" placeholder="Data Nascimento..." value="{{ date('d/m/Y',strtotime($aluno->birthday))}}" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gênero:</label>
                    <input type="text" name="gender" id="gender" class="form-control" placeholder="Gênero:" value="{{ $aluno->gender }}">
                </div>
                <div class="form-group">
                    <label for="curso">Cursos:</label>
                    <select multiple name="curso[]" id="curso" class="form-control" required>
                        @if(!empty($cursos))
                            @foreach($cursos as $c)
                                @if(in_array($c->id,$aluno->cursoArray()))
                                    <option value="{{$c->id}}" selected>{{$c->title}}</option>
                                @else
                                    <option value="{{$c->id}}">{{$c->title}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Alterar</button>

            </form>
        </div>
    </div>
@endsection