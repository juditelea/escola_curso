@extends('layouts.template')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h2>Alunos por Faixa Etária</h2>
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
                    <th>Menor que 15 anos</th>
                    <th>Entre 15 e 18 anos</th>
                    <th>Entre 19 e 24 anos</th>
                    <th>Entre 25 e 30 anos</th>
                    <th>Maior que 30 anos</th>
                    <th>Gênero</th>
                    <th>Data Nascimento</th>
                    <th>Curso</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                    <tr>
                        <td>{{$aluno->name}}</td>  
                    
                         {{-- @switch($ages)
                            @case($age < 15)

                            
                                @break
                            @case($age >= 15 && $age <= 18)
                                
                                @break
                            @case($age >= 19 && $age <= 24)
                                
                                @break
                            @case($age >= 25 && $age <= 29)
                                
                                @break
                            @default 
                                
                        @endswitch  --}}
                         </tr>
                        <tr>
                            <td>
                                @foreach($aluno->cursos as $curso)
                                    {{$curso->title}}<br>
                                @endforeach
                            </td>

                            
                        </tr>
                        @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection