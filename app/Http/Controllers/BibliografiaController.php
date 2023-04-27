<?php

namespace App\Http\Controllers;

use App\Models\Bibliografias;
use Illuminate\Http\Request;

class BibliografiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $biblios = Bibliografias::all();
        return view('editBibliografia',compact('biblios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $bibliografia = new Bibliografias();
        $bibliografia->titulo=$request->titulo;
        $bibliografia->descripcion=$request->descripcion;
        $bibliografia->autor=$request->autor;
        $bibliografia->anio=$request->año;
        $bibliografia->editorial=$request->editorial;
        if (isset($request->estatus)) {
            $bibliografia->estatus=$request->input('estatus');
           }else {
               $bibliografia->estatus=0;
           }
        $bibliografia->save();
        return redirect('/farmaco');
    }
    public function store2(Request $request)
    {
        
        $bibliografia = new Bibliografias();
        $bibliografia->titulo=$request->titulo;
        $bibliografia->descripcion=$request->descripcion;
        $bibliografia->autor=$request->autor;
        $bibliografia->anio=$request->año;
        $bibliografia->editorial=$request->editorial;
        if (isset($request->estatus)) {
            $bibliografia->estatus=$request->input('estatus');
           }else {
               $bibliografia->estatus=0;
           }
        $bibliografia->save();
        return redirect()->route('show.biblios');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $bibliografia = Bibliografias::find($request->biblioID);
        $bibliografia->titulo=$request->tituloU;
        $bibliografia->descripcion=$request->descripcionU;
        $bibliografia->autor=$request->autorU;
        $bibliografia->anio=$request->añoU;
        $bibliografia->editorial=$request->editorialU;
        if (isset($request->estatusU)) {
            $bibliografia->estatus=$request->input('estatusU');
           }else {
               $bibliografia->estatus=0;
           }
        $bibliografia->save();
        return redirect()->route('show.biblios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bibliografia = Bibliografias::find($id);
        $bibliografia->delete();
        return redirect()->route('show.biblios');
    }
}
