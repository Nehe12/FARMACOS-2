<?php

namespace App\Http\Controllers;

use App\Models\Bibliografias;
use App\Models\GrupoFarmaco;
use App\Models\Farmacos;
use App\Models\Interacciones;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



class FarmacoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql = "SELECT `farmacos`.`id`, `farmacos`.`farmaco`, `farmacos`.`mecanismo`,`farmacos`.`url`, `farmacos`.`efecto`,  `grupo_farmacos`.`grupo`, `bibliografias`.`titulo`
        FROM `farmacos` 
            LEFT JOIN `grupo_farmacos` ON `farmacos`.`id_grupo` = `grupo_farmacos`.`id` 
            LEFT JOIN `farmaco_bibliografia` ON `farmaco_bibliografia`.`farmacos_id` = `farmacos`.`id` 
            LEFT JOIN `bibliografias` ON `farmaco_bibliografia`.`bibliografias_id` = `bibliografias`.`id`";
        $farmacos = DB::select($sql);
        $interacciones= Interacciones::all();
        $interacciones->toJson();
        return view("index", compact('farmacos','interacciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bibliografia = Bibliografias::all();
        $grupo = GrupoFarmaco::all();
        $farmacos = Farmacos::all();
        $itemfarmaco = Farmacos::latest()->first();
        return view('farmaco', compact('bibliografia', 'grupo', 'itemfarmaco'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // $farmaco = new Farmacos();
        // if ($farmaco->id  == "") {
        //    /* $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
        //         'folder' => 'farmacos',
        //     ]);
        //     $url = $uploadedFileUrl->getSecurePath();
        //     $public_id = $uploadedFileUrl->getPublicId();
        //     //$url = Cloudinary::getUrl($publicId);*/

        //     $farmaco->farmaco="FARMACO";
        //     $farmaco->farmaco = $request->farmaco;
        //     $farmaco->mecanismo = $request->mecanismo;
        //     // $farmaco->public_id = '$public_id';
        //     // $farmaco->url = '$url';
        //     $farmaco->efecto = $request->efecto;
        //     $id_bibliografia = $request->bibliografia;
        //     $farmaco->id_grupo = $request->grupo;
        //     if (isset($request->estatus)) {
        //         $farmaco->status = $request->input('estatus');
        //     } else {
        //         $farmaco->status = 0;
        //     }
        //     $farmaco->save();
        //     $farmaco->bibliografias()->attach($id_bibliografia);
        //     $itemfarmaco = Farmacos::latest()->first();
        //     $ultimo = $itemfarmaco;
        // } else {
        //     $ultimo = $farmaco->id;
        //     $interacciones = new Interacciones();
        //     $interacciones->interacciones = $request->interaccion;

        //     $interacciones->id_farmaco = $ultimo = $farmaco->id;
        // }
        // $farmaquito = Farmacos::find($ultimo);
        // $bibliografia = Bibliografias::all();
        // $grupo = GrupoFarmaco::all();



        // // return redirect()->route('crear.farmaco');
        // return redirect()->route('crear.farmaco', compact('farmaquito', 'bibliografia', 'grupo'));*/
        $farmaco = new Farmacos();
         $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
             'folder' => 'farmacos2',
         ]);
         $url = $uploadedFileUrl->getSecurePath();
         $public_id = $uploadedFileUrl->getPublicId();
        $url = Cloudinary::getUrl($public_id);


        $farmaco->farmaco = $request->farmaco;
        $farmaco->mecanismo = $request->mecanismo;
        $farmaco->public_id = $public_id;
        $farmaco->url = $url;
        $farmaco->efecto = $request->efecto;
        $id_bibliografia = $request->bibliografia;
        
        $farmaco->id_grupo = $request->grupo;
        if (isset($request->estatus)) {
            $farmaco->status = $request->input('estatus');
        } else {
            $farmaco->status = 0;
        }
        $farmaco->save();
        $farmaco->bibliografias()->attach($id_bibliografia);
        return redirect()->route('crear.farmaco')->with('success', 'Agregado con exito!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $farmacos = Farmacos::find($id);
        /*$bibliografia = Bibliografia::all();
        $grupo =GrupoFarmaco::all();*/
        return view('eliminar', compact('farmacos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $sql_Inter ="SELECT `interacciones`.`ID`,`interacciones`.`interaccion`, `farmacos`.`farmaco`, `farmacos`.`id`
        // FROM `interacciones` 
        //     LEFT JOIN `farmacos` ON `interacciones`.`id_farmaco` = `farmacos`.`id`";
        // $interacciones_tabla=DB::select($sql_Inter);
        $farmacos = Farmacos::find($id);
        $bibliografia = Bibliografias::all();
        $grupo = GrupoFarmaco::all();
        $interacciones = Interacciones::all();
        return view('editarFarmaco', compact('farmacos', 'bibliografia', 'grupo', 'interacciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $farmaco = Farmacos::find($id);
        $id = $farmaco->id;
        $public_id = $farmaco->public_id;
        $url = $farmaco->url;

        if ($request->hasFile('image')) {
            Cloudinary::destroy($public_id);
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'farmacos2',
            ]);
            $url = $uploadedFileUrl->getSecurePath();
            $public_id = $uploadedFileUrl->getPublicId();
        }
        $farmaco->farmaco = $request->farmaco;
        $farmaco->mecanismo = $request->mecanismo;
        $farmaco->public_id = $public_id;
        $farmaco->url = $url;
        $farmaco->efecto = $request->efecto;
        $id_bibliografia = $request->bibliografia;
        $farmaco->id_grupo = $request->grupo;
        if (isset($request->estatus)) {
            $farmaco->status = $request->input('estatus');
        } else {
            $farmaco->status = 0;
        }
        $farmaco->save();
        $farmaco->bibliografias()->attach($id_bibliografia);
        return redirect()->route('edit.farmaco', compact('id'))->with('success', 'Actualizado con exito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //$interacciones = Interacciones::all();
         $farmaco = Farmacos::find($id);
         $public_id = $farmaco->public_id;
        //  Cloudinary::destroy($public_id);
         //$farmacos->$interacciones->delete();
         $farmaco->delete();
         return redirect()->route('inicio')->with('success', 'Eliminado con exito!!');
    }
      /*Mostrar  */
      public function mostrar($id)
      {
  
          $grupo = GrupoFarmaco::all();
          $interacciones = Interacciones::all();
          $bibliografia = Bibliografias::all();
          $sql2 = "SELECT `farmacos`.`id`,`farmacos`.`farmaco`, `farmacos`.`efecto`, `farmacos`.`mecanismo`, `farmacos`.`url`, `bibliografias`.`titulo`, `grupo_farmacos`.`grupo`,  `interacciones`.`interaccion`
                  FROM `farmacos`
                  LEFT JOIN `bibliografias` ON `farmacos`.`id_bibliografia` = `bibliografias`.`id`
                  LEFT JOIN `grupo_farmacos` ON `farmacos`.`id_grupo` = `grupo_farmacos`.`id`
                  LEFT JOIN `interacciones` ON `interacciones`.`id_farmaco` = `farmacos`.`id`";
          $farmacos2 = DB::select($sql2);
          $farmacos2 = Farmacos::find($id);
          $farmacos2->toArray();
          return view('mostrar', compact('farmacos2', 'grupo', 'interacciones', 'bibliografia'));
      }
}
