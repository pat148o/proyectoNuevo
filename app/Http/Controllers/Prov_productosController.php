<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prov_producto;

class Prov_productosController extends Controller
{
  
    
    public function index(Request $request)
    {  
        $buscar=$request->buscar;
        // $criterio=$request->criterio;

        if ($buscar=='') {

            $prov_productos=Prov_producto::join('proveedores','prov_productos.id_proveedor','=','proveedores.id')
            ->join('productos','prov_productos.id_producto','=','productos.id')
            ->select('prov_productos.id','proveedores.nombre as nomProv','productos.nombre as nomProd')
            ->orderBy('prov_productos.id','asc')->paginate(4);
        }else {
            $prov_productos=Prov_producto::join('proveedores','prov_productos.id_proveedor','=','proveedores.id') 
            ->join('productos','prov_productos.id_producto','=','productos.id')
    ->select('prov_productos.id','proveedores.nombre as nomProv','productos.nombre as nomProd')
    ->where('prov_productos.id',$buscar)
    ->orwhere('prov_productos.id','like','%'.$buscar.'%')
    ->orderBy('prov_productos.id','asc')->paginate(4);
        }

        
        return ['pagination'=>[

                'total'=>$prov_productos->total(),
                'current_page'=>$prov_productos->currentPage(),
                'per_page'=>$prov_productos->perPage(),
                'last_page'=>$prov_productos->lastPage(),
                'from'=>$prov_productos->firstItem(),
                'to'=>$prov_productos->lastItem(),

            ],'prov_productos' =>$prov_productos
     
        
        ];
    
    
    }

    public function store(Request $request)
    {
        //
        $prov_productos=new Prov_producto ();

        $prov_productos->id_proveedor= $request->idProv;
        $prov_productos->id_producto= $request->idProd;
        $prov_productos->save();
    }
    
    public function update(Request $request)
    {
    
        $prov_productos= Prov_producto::findOrFail($request->id);
        $prov_productos->id_proveedor= $request->idProv;
        $prov_productos->id_producto= $request->idProd;
        $prov_productos->save();
    }
    
    public function destroy(Request $request)
    {
    
        $prov_productos=Prov_producto::findOrFail($request->id);
        $prov_productos->delete();
    }
    
    public function getProv_productos(Request $request){
        
    $prov_productos=Prov_producto::
    select('prov_productos.id','prov_productos.id')->get();
    
        return[
            'prov_productos'=>$prov_productos
        ];
    }
    
}

