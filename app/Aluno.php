<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['name', 'email', 'gender', 'birthday'];

    public function cursos()
    {
        return $this->belongsToMany('App\Curso', "alunos_cursos", "aluno_id", "curso_id");
    }

    public function cursoArray()
    {
        foreach ($this->cursos as $c)
        {
            $cursos[] = $c->id;
        }
        return $cursos;
    }
}
