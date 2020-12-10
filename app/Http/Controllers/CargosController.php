<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo; 

class CargosController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar; 
        $criterio=$request->criterio;

        if ($buscar=='') {
            $cargos=Cargo::orderBy('nombre','asc')->paginate(4);
            // todo...
        }else {
            $cargos=Cargo::where($criterio,'like','%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

        
        
        return [ 'pagination'=>[
                  'total'=>$cargos->total(),
                   'current_page'=>$cargos->currentPage(),
                   'per_page'=>$cargos->perPage(),
                   'last_page'=>$cargos->lastPage(),
                   'from'=>$cargos->firstItem(),
                   'to'=>$cargos->lastItem(),

                
        
                ],'cargos'=>$cargos
            
            ];
    }
   //guarda datos
    public function store(Request $request)
    {
        
        $cargos=new Cargo();
        $cargos->nombre=$request->nombre;
        $cargos->save();
    }
   //actualiza datos
    public function update(Request $request)
    {
        
        $cargos=Cargo::findOrFail($request->id);
        $cargos->nombre=$request->nombre;
        $cargos->save();
    }
   //elimina datos 
    public function destroy(Request $request)
    {
        
        $cargos=Cargo::findOrFail($request->id);
        $cargos->delete();

    }
    public function getCargo(Request $request){
        $cargos=Cargo::orderBy('nombre','asc')->get();
        return[
            'cargos'=>$cargos
        ];
    }
    
}
