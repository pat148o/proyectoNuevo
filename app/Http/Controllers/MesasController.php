<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa; 

class MesasController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar; 
        $criterio=$request->criterio;

        if ($buscar=='') {
            $mesas=Mesa::orderBy('nombre','asc')->paginate(4);
            // todo...
        }else {
            $mesas=Mesa::where($criterio,'like','%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

        
        
        return [ 'pagination'=>[
                  'total'=>$mesas->total(),
                   'current_page'=>$mesas->currentPage(),
                   'per_page'=>$mesas->perPage(),
                   'last_page'=>$mesas->lastPage(),
                   'from'=>$mesas->firstItem(),
                   'to'=>$mesas->lastItem(),

                
        
                ],'mesas'=>$mesas
            
            ];
    }
   //guarda datos
    public function store(Request $request)
    {
        
        $mesas=new Mesa();
        $mesas->nombre=$request->nombre;
        $mesas->ubicacion=$request->ubicacion;
        $mesas->save();
    }
   //actualiza datos
    public function update(Request $request)
    {
        
        $mesas=Mesa::findOrFail($request->id);
        $mesas->nombre=$request->nombre;
        $mesas->ubicacion=$request->ubicacion;
        $mesas->save();
    }
   //elimina datos 
    public function destroy(Request $request)
    {
        
        $mesas=Mesa::findOrFail($request->id);
        $mesas->delete();

    }
    public function getMesas(Request $request){
        $mesas=Mesa::orderBy('nombre','asc')->get();
        return[
            'mesas'=>$mesas
        ];
    }
    
}
