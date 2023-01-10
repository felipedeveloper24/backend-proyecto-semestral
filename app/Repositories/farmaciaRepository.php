<?php

namespace App\Repositories;

use App\Models\farmacia;
use Exception;
use Illuminate\Support\Facades\Log;

class FarmaciaRepository{
    public function listar_farmacias(){
        if(farmacia::all()->count()!=0){
            return response( farmacia::all(),200);
        }
        return response()->json([
            "mensaje"=>"No hay registros"
        ],400);
    }
    public function crear_farmacia($request){
        $farmacia = new farmacia();
        $farmacia->farm_nombre = $request->farm_nombre;
        $farmacia->farm_direccion = $request->farm_direccion;
        $farmacia->farm_mail = $request->farm_mail;

        $response = $farmacia->save();

        if($response){
            return response()->json([
                "farmacia"=> $farmacia,
                "mensaje"=>"farmacia creada correctamente"

            ],200);
        }
        return response()->json([
            "mensaje"=>"la farmacia no fué creada"

        ],404);
    }
    public function actualizar_farmacia($request){
        try{
            $farmacia = farmacia::findorFail($request->id);
            isset($request->farm_nombre) && $farmacia->farm_nombre = $request->farm_nombre;
            isset($request->farm_direccion) && $farmacia->farm_direccion = $request->farm_direccion;
            isset($request->farm_mail) && $farmacia->farm_mail = $request->farm_mail;
            $farmacia->save();
            return response()->json([
                "mensaje"=> "Farmacia actualizada correctamente",
                "farmacia"=>$farmacia
            ],200);
        }catch(Exception $e){
            return(response()->json([
                "mensaje" => $e->getMessage()
            ],404));
        }
    }
    public function eliminar_farmacia ($request){

        try{
            farmacia::find($request->id)->delete();
            return response()->json([
                "mensaje"=> "farmacia eliminada correctamente"
            ],200);
        }catch(Exception $e){
            return response()->json([
                "mensaje"=>$e->getMessage()
            ],400);
        }

    }

}
