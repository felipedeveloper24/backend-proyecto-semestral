<?php

namespace App\Http\Controllers;

use App\Http\Requests\farmacia\deleteRequest;
use App\Http\Requests\farmacia\insertRequest;
use App\Http\Requests\farmacia\updateRequest;
use App\Models\farmacia;
use App\Repositories\FarmaciaRepository;
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    protected FarmaciaRepository $farmaciarepo;
    public function __construct(FarmaciaRepository $farmaciarepo){
        $this -> farmaciarepo = $farmaciarepo;
    }
    public function listar_farmacias(){
        return $this->farmaciarepo->listar_farmacias();
    }
    public function crear_farmacia(insertRequest $request){
        return $this->farmaciarepo->crear_farmacia($request);
    }
    public function actualizar_farmacia(updateRequest $request){
        return $this->farmaciarepo->actualizar_farmacia($request);
    }
    public function eliminar_farmacia(deleteRequest $request){
        return $this->farmaciarepo->eliminar_farmacia($request);
    }
}
