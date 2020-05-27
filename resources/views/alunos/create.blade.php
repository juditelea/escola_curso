@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Adicionar Aluno</h2>
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
            <form action="{{route('alunos.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome..." value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email..." value="{{old('email')}}"
                           required>
                </div>
                <div class="form-group">
                    <label for="gender">Gênero:</label>
                    <input type="radio" name="gender" value="M"> Masculino
                    <input type="radio" name="gender" value="F"> Feminino
                    <input type="radio" name="gender" value="N"> Não Declarado
                </div>
                <div class="form-group">
                    <label for="birthday">Data Nascimento:</label>
                    <input type="text" name="birthday" id="birthday" class="form-control" placeholder="Data Nascimento..." value="{{old('birthday')}}" required>
                </div>
                <div class="form-group">
                    <label for="modalidade">Cursos:</label>
                    <select multiple name="curso[]" id="curso" class="form-control" required>
                        <option value="" selected disabled>SELECIONE</option>
                        @if(!empty($cursos))
                            @foreach($cursos as $c)
                                <option value="{{$c->id}}">{{$c->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar</button>

            </form>
        </div>
    </div>
@endsection