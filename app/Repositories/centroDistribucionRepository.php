<?php
namespace App\Repositories;

use App\Models\centro_distribucion;
use App\Models\stock;
use Exception;
use Illuminate\Support\Facades\DB;
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
    public function mostrar_centro($id){
        $centro = centro_distribucion::find($id);
        if(!empty($centro)){
            return response([$centro],200);
        }
        return response(["mensaje"=>"No existe ese centro"],200);
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
         try{
            $centro = centro_distribucion::findorFail($request->id);
            $response = $centro->delete();
            if($response){
                return response()->json(["mensaje"=>"Centro de distribucion eliminado correctamente"],200);
            }
            return response()->json(["mensaje"=>"Error al eliminar"],400);

        }catch(Exception $e){
            return response()->json(["mensaje"=>"Error al eliminar".$e->getMessage()],400);
        }

    }
    public function asignarStock($request){

        if($request->scd_cantidad>0){
            $stock = new stock();
            $stock -> scd_id_medicamento = $request->scd_id_medicamento;
            $stock -> scd_cantidad = $request->scd_cantidad;
            $stock -> scd_centro_dist = $request->scd_centro_dist;
            $stock -> scd_lote = $request->scd_lote;

            $response = $stock->save();
            if($response){
                return response()->json([
                    "mensaje" => "Stock Registrado correctamente"
                ],200);
            }else{
                return response()->json([
                    "mensaje" => "Error de registrar stock"
                ],400);
            }
        }else{
            return response()->json([
                "mensaje" => "El stock debe ser un numero positivo"
            ],400);
        }
    }
    public function mostrarStock($id){
        $sql = "select s.scd_lote as lote, m.med_nombre as nombre , m.med_compuesto as compuesto , s.scd_cantidad as stock  from centro_distribucions c,
        stocks s, medicamentos m where s.scd_id_medicamento = m.id and
        s.scd_centro_dist = c.id and c.id = $id";
        $stocks = DB::select($sql);
        if(!empty($stocks)){
            return response()->json([
                "stock" => $stocks
            ],200);
        }
        return response(["mensaje"=>"Este centro de distribucion no tiene stock",200]);
    }
}


?>
