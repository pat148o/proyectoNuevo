<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_producto; 

class Tipo_productosController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $tipo_productos=Tipo_producto::orderBy('nombre','asc')->paginate(4);
            // todo...
        }else {
            $tipo_productos=Tipo_producto::where($criterio,'like','%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

        
        
        return [ 'pagination'=>[
                  'total'=>$tipo_productos->total(),
                   'current_page'=>$tipo_productos->currentPage(),
                   'per_page'=>$tipo_productos->perPage(),
                   'last_page'=>$tipo_productos->lastPage(),
                   'from'=>$tipo_productos->firstItem(),
                   'to'=>$tipo_productos->lastItem(),

                
        
                ],'tipo_productos'=>$tipo_productos
            
            ];
    }
   //guarda datos
    public function store(Request $request)
    {
        
        $tipo_productos=new Tipo_producto();
        $tipo_productos->nombre=$request->nombre;
        $tipo_productos->save();
    }
   //actualiza datos
    public function update(Request $request)
    {
        
        $tipo_productos=Tipo_producto::findOrFail($request->id);
        $tipo_productos->nombre=$request->nombre;
        $tipo_productos->save();
    }
   //elimina datos 
    public function destroy(Request $request)
    {
        
        $tipo_productos=Tipo_producto::findOrFail($request->id);
        $tipo_productos->delete();

    }
    public function getTipo_productos(Request $request){
        $tipo_productos=Tipo_producto::orderBy('nombre','asc')->get();
        return[
            'tipo_productos'=>$tipo_productos
        ];
    }
    
}
