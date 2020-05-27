@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Adicionar Curso</h2>
            <ul class="nav">
                <li class="nav-item"><a href="{{route('cursos.index')}}">Listar Cursos</a> </li>
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
            <form action="{{route('cursos.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nome">Título:</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Título..." value="{{old('title')}}" required>
                </div>
                <div class="form-group">
                    <label for="horario">Descrição:</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Descrição..." value="{{old('description')}}">
                </div>
                <button type="submit" class="btn btn-primary">Adicionar</button>

            </form>
        </div>
    </div>
@endsection