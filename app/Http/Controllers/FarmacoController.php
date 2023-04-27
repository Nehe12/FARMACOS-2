<?php

namespace App\Http\Controllers;

use App\Models\Bibliografias;
use App\Models\GrupoFarmaco;
use App\Models\Farmacos;
use App\Models\Interacciones;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Google\Service\Storage as ServiceStorage;
//  use Google\Service\Storage;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Filesystem;



class FarmacoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sql = "SELECT `farmacos`.`id`, `farmacos`.`farmaco`, `farmacos`.`mecanismo`, `farmacos`.`url`, `farmacos`.`efecto`, `farmacos`.`status`, `grupo_farmacos`.`grupo`
        FROM `farmacos` 
            LEFT JOIN `grupo_farmacos` ON `farmacos`.`id_grupo` = `grupo_farmacos`.`id`";
        $farmacos = DB::select($sql);
        $interacciones = Interacciones::all();
        $interacciones->toJson();
        return view("index", compact('farmacos', 'interacciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bibliografia = Bibliografias::all();
        $grupo = GrupoFarmaco::all();
        $farmacos = Farmacos::all();
        // $itemfarmaco = Farmacos::latest()->first();
        return view('farmaco', compact('bibliografia', 'grupo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $farmaco = new Farmacos();
        $path = Storage::disk('google')->put('farmacos_img', $request->file('image'));
        $url = Storage::disk('google')->url($path);

        // $image = $request->file('image');
        // $path  = $image->store('farmacoImg','google');
        // $url = Storage::disk('google')->url($path);
        $farmaco->farmaco = $request->farmaco;
        $farmaco->mecanismo = $request->mecanismo;
        $farmaco->public_id = '$public_id';
        $farmaco->url = $url;
        $farmaco->efecto = $request->efecto;
        $id_bibliografia = $request->bibliografia;

        $farmaco->id_grupo = $request->grupo;
        // if (isset($request->estatus)) {
        //     $farmaco->status = $request->input('estatus');
        // } else {
        //     $farmaco->status = 0;
        // }
        $farmaco->save();
        $farmaco->bibliografias()->attach($id_bibliografia);

        $itemfarmaco = Farmacos::latest()->first();
        $biblioselect = Farmacos::select('bibliografias.*')
            ->join('farmacobibliografia', 'farmacos.id', '=', 'farmacobibliografia.farmacos_id')
            ->join('bibliografias', 'farmacobibliografia.bibliografias_id', '=', 'bibliografias.id')
            ->where('farmacos.id', $itemfarmaco)
            ->get();
        $bibliografia = Bibliografias::all();
        $id = $itemfarmaco;
        return redirect()->route('edit.farmaco', compact('id', 'itemfarmaco', 'bibliografia'))->with('success', 'Agregado con exito!!');
    }
    // Guardar usando Cloudinary
    /*public function store(Request $request)
    {

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
        // if (isset($request->estatus)) {
        //     $farmaco->status = $request->input('estatus');
        // } else {
        //     $farmaco->status = 0;
        // }
        $farmaco->save();
        $farmaco->bibliografias()->attach($id_bibliografia);

        $itemfarmaco = Farmacos::latest()->first();
        $biblioselect = Farmacos::select('bibliografias.*')
            ->join('farmacobibliografia', 'farmacos.id', '=', 'farmacobibliografia.farmacos_id')
            ->join('bibliografias', 'farmacobibliografia.bibliografias_id', '=', 'bibliografias.id')
            ->where('farmacos.id', $itemfarmaco)
            ->get();
        $bibliografia = Bibliografias::all();
        $id = $itemfarmaco;
        return redirect()->route('edit.farmaco', compact('id', 'itemfarmaco', 'bibliografia'))->with('success', 'Agregado con exito!!');
    }*/

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
        $biblioselect = Farmacos::select('bibliografias.*')
            ->join('farmacobibliografia', 'farmacos.id', '=', 'farmacobibliografia.farmacos_id')
            ->join('bibliografias', 'farmacobibliografia.bibliografias_id', '=', 'bibliografias.id')
            ->where('farmacos.id', '=', $farmacos->id)
            ->get();
        // dd($biblioselect); 
        // $biblioselect = DB::table('bibliografias')
        //       ->join('farmacobibliografia', 'farmacos.id', '=', 'farmacobibliografia.farmacos_id')
        //       ->join('bibliografias', 'farmacobibliografia.bibliografias_id', '=', 'bibliografias.id')
        //       ->select('bibliografias.*')
        //       ->where('farmacos.id','=', $farmacos->id)
        //       ->get();
        //      dd($biblioselect);
        //   $idS=$farmacos->id;
        //   $sql_B= " SELECT `bibliografias`.* FROM `farmacos` 
        //   INNER JOIN `farmacobibliografia` ON `farmacos`.`id` = `farmacobibliografia`.`farmacos_id` 
        //   INNER JOIN `bibliografias` ON `farmacobibliografia`.`bibliografias_id` = `bibliografias`.`id` WHERE `farmacos`.`id` = $idS ";
        //   $biblioselect=DB::select($sql_B);
        //   print_r($biblioselect);
        return view('editarFarmaco', compact('farmacos', 'bibliografia', 'grupo', 'interacciones', 'biblioselect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $farmaco = Farmacos::find($id);
        $id = $farmaco->id;
        $url = $farmaco->url;

        if ($request->hasFile('image')) {
            // $get_url = Storage::get($url);
            Storage::delete($url);
           
            // dd(Storage::delete('farmacos_img',$url));
            $path = Storage::disk('google')->put('farmacos_img', $request->file('image'));
            $url = Storage::disk('google')->url($path);
            // dd($url);
        } 
        $farmaco->farmaco = $request->farmaco;
        $farmaco->mecanismo = $request->mecanismo;
        $farmaco->public_id = '$public_id';
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
        $farmaco->bibliografias()->sync($id_bibliografia);
        $biblioselect = Farmacos::select('bibliografias.*')
            ->join('farmacobibliografia', 'farmacos.id', '=', 'farmacobibliografia.farmacos_id')
            ->join('bibliografias', 'farmacobibliografia.bibliografias_id', '=', 'bibliografias.id')
            ->where('farmacos.id', $id)
            ->get();
        $bibliografia = Bibliografias::all();
        return redirect()->route('edit.farmaco', compact('id', 'biblioselect', 'bibliografia'))->with('success', 'Actualizado con exito!!');
    }
    // Update con Cloudinary
    /*public function update(Request $request, string $id)
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
        $farmaco->bibliografias()->sync($id_bibliografia);
        $biblioselect = Farmacos::select('bibliografias.*')
            ->join('farmacobibliografia', 'farmacos.id', '=', 'farmacobibliografia.farmacos_id')
            ->join('bibliografias', 'farmacobibliografia.bibliografias_id', '=', 'bibliografias.id')
            ->where('farmacos.id', $id)
            ->get();
        $bibliografia = Bibliografias::all();
        return redirect()->route('edit.farmaco', compact('id', 'biblioselect', 'bibliografia'))->with('success', 'Actualizado con exito!!');
    }*/

    public function activo(Request $request, $id)
    {
        $farmaco = Farmacos::find($id);
        // dd($request->input('estatus'));
        if ($request->input('estatus') == 1) {
            $nuevoEstatus = $request->input('estatus') == 'checked' ? 1 : 0;
        } else {
            $nuevoEstatus = $request->input('estatus') == 'checked' ? 0 : 1;
        }

        $farmaco->status = $nuevoEstatus;
        $farmaco->save();

        $sql = "SELECT `farmacos`.`id`, `farmacos`.`farmaco`, `farmacos`.`mecanismo`, `farmacos`.`url`, `farmacos`.`efecto`, `farmacos`.`status`, `grupo_farmacos`.`grupo`
        FROM `farmacos` 
            LEFT JOIN `grupo_farmacos` ON `farmacos`.`id_grupo` = `grupo_farmacos`.`id`";
        $farmacos = DB::select($sql);


        return view("index", compact('farmacos'));
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
