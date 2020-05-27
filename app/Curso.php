<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['title', 'description'];

    public function alunos()
    {
        return $this->belongsToMany('App\Aluno', "alunos_cursos", "aluno_id", "curso_id");
    }

}
