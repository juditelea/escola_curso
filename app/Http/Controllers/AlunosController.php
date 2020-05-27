<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::all();
        return view('alunos.index', ['alunos' => $alunos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('alunos.create', ['cursos' => $cursos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = str_replace('/', '-', $request->birthday);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:alunos',
            'birthday' => 'required',
            'curso' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $aluno = new Aluno();
            $aluno->name = $request->name;
            $aluno->email = $request->email;
            $aluno->gender = $request->gender;
            $aluno->birthday = date("Y-m-d", strtotime($date));
            $aluno->save();

            if(is_array($request->curso)) {
                foreach ($request->curso as $c) {
                    $curso = Curso::find($c);
                    $aluno->cursos()->attach($curso);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', "Aluno Adicionado com sucesso");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    public function mostra()
    {
        $alunos = Aluno::all();
        foreach ($alunos as $aluno) {
            $dataNascimento = $aluno->birthday;
            $date = new DateTime($dataNascimento);
            print_r($date);
            echo "<br />";
            $interval = $date->diff(new DateTime(date('Y-m-d')));
            $ages[] = (int)($interval->format('%Y'));
        }
            
        return view('outros.mostra', ['alunos' => $alunos,'ages' => $ages]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cursos = Curso::all();
        $aluno = Aluno::find($id);
        return view('alunos.edit',['aluno'=>$aluno,'cursos'=>$cursos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $date = str_replace('/', '-', $request->birthday);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'curso' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $aluno = Aluno::find($id);
            $aluno->name = $request->name;
            $aluno->email = $request->email;
            $aluno->gender = $request->gender;
            $aluno->birthday = date("Y-m-d", strtotime($date));
            $aluno->save();
            $aluno->cursos()->detach();
            if(is_array($request->curso)) {
                foreach ($request->curso as $m) {
                    $curso = Curso::find($m);
                    $aluno->cursos()->attach($curso);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', "aluno Alterado com sucesso");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $aluno = Aluno::find($id);
            $aluno->delete();
            return redirect()->back()->with('success', "Aluno Excluído com sucesso");

        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }
}
