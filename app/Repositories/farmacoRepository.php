<?php
namespace App\Repositories;
use App\Models\medicamento;
use Exception;
use Illuminate\Support\Facades\Log;

    class FarmacoRepository{

        public function listar_medicamentos(){

            $listado = medicamento::all();
            if($listado->count()!=0){
                return response(["data"=>$listado],200);
            }

            return response([
                "mensaje"=> "No hay farmacos registrados en la base de datos"
            ],200);
        }
        public function mostrar_medicamento($id){
            $medicamento = medicamento::find($id);
            if(!empty($medicamento)){
                return response([$medicamento],200);
            }
            return response(["mensaje"=>"No existe ese medicamento"],200);
        }
        public function crear_medicamento($request){
            $medicamento = new medicamento();
            $medicamento->med_nombre = $request-> med_nombre;
            $medicamento->med_compuesto = $request->med_compuesto;
            $response = $medicamento->save();
            if($response){
                return response()->json([
                    "mensaje" => "Medicamento creado correctamente"
                ],200);
            }
            return response()->json([
                "mensaje"=> "Error al crear un medicamento, intentelo nuevamente"
            ],400);
        }
        public function actualizar_medicamento($request){
            try{
                $medicamento = medicamento::findorFail($request->id);
                isset($request->med_nombre) && $medicamento->med_nombre = $request->med_nombre;
                isset($request->med_compuesto) && $medicamento->med_compuesto = $request->med_compuesto;
                $response = $medicamento->save();
                if($response){
                    return response()->json([
                        "mensaje"=>"medicamento actualizado correctamente"
                    ],200);
                }
                return response()->json([
                    "mensaje"=>"El medicamento no fue actualizado correctamente"
                ],400);

            }catch(Exception $e){
                return response()->json([
                    "mensaje"=>"Error al actualizar".$e->getMessage()
                ]);
            }
        }
        public function eliminar_medicamento($request){
            try{
                $medicamento = medicamento::findorFail($request->id);
                $response = $medicamento-> delete();
                if($response){
                    return response()->json([
                        "mensaje"=>"Medicamento eliminado correctamente"
                    ],200);
                }
                return response()->json([
                    "mensaje"=>"Error al eliminar"
                ],400);

            }catch(Exception $e){
                return response()->json([
                    "mensaje"=>"Error al eliminar".$e->getMessage()
                ]);
            }
        }
    }


?>
