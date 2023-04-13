<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FarmacoResource;
use App\Models\Farmacos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmacoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FarmacoResource::collection(Farmacos::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(farmacos $farmaco)
    {
        return new FarmacoResource($farmaco);
    }
    
    public function search(Request $request){
        $sql="SELECT `farmacos`.`farmaco`,`farmacos`.`mecanismo`,`farmacos`.`efecto` FROM `farmacos` 
        WHERE `farmacos`.`farmaco` 
        LIKE '%$request->consulta%'";
        $sql_Farm=DB::select($sql);
        // $sql_Farm->toJson();
        // return response()->tojson($sql_Farm);
        return $sql_Farm;
        

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farmacos $farmaco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(farmacos $farmaco)
    {
        if ($farmaco->delete()) {
            return response()->json([
                'message' => 'Success'
            ], 204);
        }
        return response()->json([
            'message' => 'Not found'
        ], 404);
    }
}
