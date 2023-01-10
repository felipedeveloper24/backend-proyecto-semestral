<?php

namespace App\Http\Controllers;

use App\Http\Requests\centros\deleteRequest;
use App\Http\Requests\centros\insertRequest;
use App\Http\Requests\centros\updateRequest;
use App\Repositories\CentroDistribucionRepository;
use Illuminate\Http\Request;

class CentroDistribucionController extends Controller
{
    protected CentroDistribucionRepository $repo_centro;
    public function __construct(CentroDistribucionRepository $repo_centro){
        $this->repo_centro = $repo_centro;
    }
    public function listar_centros(){
        return $this-> repo_centro->listar_centros();
    }
    public function crear_centro(insertRequest $request){
        return $this-> repo_centro->crear_centro($request);
    }
    public function actualizar_centro(updateRequest $request){
        return $this-> repo_centro->actualizar_centro($request);
    }
    public function eliminar_centro(deleteRequest $request){
        return $this->repo_centro->eliminar_centro($request);
    }

}
