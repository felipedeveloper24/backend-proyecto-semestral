<?php
namespace App\Repositories;

use App\Models\centro_distribucion;
use Exception;
use Illuminate\Support\Facades\Log;

class CentroDistribucionRepository{

    public function listar_centros(){
        $listado = centro_distribucion::all();
        if($listado->count()!=0){
            return response(["data"=>$listado],200);
        }
        return response([
            "mensaje"=> "No hay centros de distribucion registrados en la base de datos"
        ],200);
    }
    public function crear_centro($request){
        $centro = new centro_distribucion();
        $centro->cd_codigo = $request->cd_codigo;
        $centro->cd_direccion = $request->cd_direccion;
        $centro->cd_telefono = $request->cd_telefono;
        try{
            $response = $centro->save();
            Log::info($response);
            if($response){
                return(response()->json(["Mensaje"=>"Centro de distribucion creado correctamente","data"=>$centro],200));
            }
            return response()->json(["Mensaje"=>"Error al registrar un centro"]);
        }catch(Exception $e){
            Log::info($e->getMessage());
        }
    }
    public function actualizar_centro($request){
        try{
            $centro = centro_distribucion::findorFail($request->id);
            isset($request->cd_direccion) && $centro->cd_direccion = $request->cd_direccion;
            isset($request->cd_telefono) && $centro->cd_telefono = $request->cd_telefono;
            $response = $centro->save();
            if($response){
                return response()->json(["mensaje"=>"centro de distribucion actualizado","data"=>$centro]);
            }
            return response()->json(["mensaje"=>"Error al actualizar"],400);
        }catch(Exception $e){
            return response()->json(["mensaje"=>"Error al actualizar".$e->getMessage()],400);
        }

    }
    public function eliminar_centro($request){
        Log::info(["data"=>$request->id]);
        return response()->json([
            "data"=>$request->id],200);
        /*
         try{
            Log::info(["data"=>$request->id]);
            $centro = centro_distribucion::find($request->id);
            if(empty($centro)){
                return response()->json(["No se ha encontrado el centro",400]);
            }
            return response()->json(["Centro"=>$centro]);
            Log::info(["Centro"=>$centro]);

            if($centro->count()!=0){
                $centro->delete();
                return response()->json(["mensaje"=>"Centro de distribucion eliminado correctamente"],200);
            }
            return response()->json(["mensaje"=>"Error al eliminar"],400);

        }catch(Exception $e){
            return response()->json(["mensaje"=>"Error al eliminar".$e->getMessage()],400);
        }
        */

    }
}


?>
