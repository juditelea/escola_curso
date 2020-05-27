<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index',['cursos'=>$cursos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
        ]);

        try {
            Curso::create(['title' => $request->title,'description'=>$request->description]);
            return redirect()->back()->with('success',"Curso adicionado com sucesso");
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage()." ".$e->getFile()." ".$e->getLine());
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::find($id);
        return view('cursos.edit',['curso'=>$curso]);
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
        $request->validate([
            'title'=>'required',
        ]);

        try {
            DB::beginTransaction();
            $curso = Curso::find($id);
            $curso->title = $request->title;
            $curso->description = $request->description;
            $curso->save();

            DB::commit();
            return redirect()->back()->with('success', "Curso Alterado com sucesso");
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
        //
    }
}
