<?php

namespace App\Http\Controllers;

use App\Models\Farmacos;
use App\Models\Interacciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InteraccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farmacos = Farmacos::all();

        return view('interacciones', compact('farmacos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $interaccion = new Interacciones();

        $interaccion->interaccion = $request->interaccion;
        $interaccion->id_farmaco = $request->id_interaccion;
        if (isset($request->estatus)) {
            $interaccion->status = $request->input('estatus');
        } else {
            $interaccion->status = 0;
        }
        $interaccion->save();
        return redirect()->route('crear.farmaco')->with('msg', 'Interaccion agregada para ');
    }

    public function store2(Request $request)
    {
        $interaccion2 = new Interacciones();
        $interaccion2->interaccion = $request->interaccionA;
        $interaccion2->id_farmaco = $request->input('id_farmaco');
        $id = $request->input('id_farmaco');
        if (isset($request->estatus)) {
            $interaccion2->status = $request->input('estatus');
        } else {
            $interaccion2->status = 0;
        }

        $interaccion2->save();
        // $id=$interaccion2->id_farmaco=$request->input('id_farmaco');

        return redirect()->route('edit.farmaco', compact('id'))->with('msg', 'Interaccion agregada');
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
        $UP_Interaccion = Interacciones::find($request->id_interaccion);
        $UP_Interaccion->interaccion = $request->interaccion;
        if (isset($request->estatus)) {
            $UP_Interaccion->status = $request->input('estatus');
        } else {
            $UP_Interaccion->status = 0;
        }
        $UP_Interaccion->save();
        $id = $request->input('id_farmaco');
        return redirect()->route('edit.farmaco', compact('id'))->with('msgi', 'Interaccion Actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        $interaccion = Interacciones::find($id);
        $interaccion->delete();
        $id = $request->input('farm_id');
        return redirect()->route('edit.farmaco', compact('id'))->with('eliminar','Eliminado Correctamente');
    }
}
