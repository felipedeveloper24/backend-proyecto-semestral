<?php

namespace App\Http\Controllers;

use App\Http\Requests\medicamento\deleteRequest;
use App\Http\Requests\medicamento\insertRequest;
use App\Http\Requests\medicamento\updateRequest;
use App\Repositories\FarmacoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class medicamentoController extends Controller
{
    protected FarmacoRepository $repo;
    public function __construct(FarmacoRepository $repo){
        $this->repo = $repo;
    }
    public function listar_medicamentos(){
        return $this->repo->listar_medicamentos();
    }
    public function crear_medicamento(insertRequest $request){
        return $this->repo->crear_medicamento($request);
    }
    public function actualizar_medicamento(updateRequest $request){
        return $this->repo->actualizar_medicamento($request);
    }
    public function eliminar_medicamento(deleteRequest $request){
        return $this->repo->eliminar_medicamento($request);
    }
}
