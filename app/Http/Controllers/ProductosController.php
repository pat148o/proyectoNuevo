<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductosController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
       
        if ($buscar=='') {
            $productos=Producto::join('tipo_productos','productos.id_tipo_producto','=','tipo_productos.id')
            ->select('productos.id','productos.codigo','productos.nombre','productos.cant','productos.precio','productos.prec_venta','productos.is_insumo','tipo_productos.nombre as nomTpro')
            ->orderBy('productos.nombre','asc')->paginate(4);
   
        }else { 
            $productos=Producto::join('tipo_productos','productos.id_tipo_producto','=','tipo_productos.id')
            ->select('productos.id','productos.codigo','productos.nombre','productos.cant','productos.precio','productos.prec_venta','productos.is_insumo','tipo_productos.nombre as nomTpro')
            ->where('productos.nombre','like','%'.$buscar.'%')
            ->orwhere('productos.codigo','like','%'.$buscar.'%')
            ->orderBy('productos.nombre','asc')->paginate(4);
        }

        
        
        return [ 'pagination'=>[
                  'total'=>$productos->total(),
                   'current_page'=>$productos->currentPage(),
                   'per_page'=>$productos->perPage(),
                   'last_page'=>$productos->lastPage(),
                   'from'=>$productos->firstItem(),
                   'to'=>$productos->lastItem(),

                
        
                ],'productos'=>$productos
            
            ];
    }
    
    
    

    public function store(Request $request)
    {
        //
        $productos=new Producto();
        $productos->codigo=$request->codigo;
        $productos->nombre=$request->nombre;
        $productos->cant=$request->cant;
        $productos->precio=$request->precio;
        $productos->prec_venta=$request->prec_venta;
        $productos->is_insumo=$request->is_insumo;

        $productos->id_tipo_producto = $request->idTi_pro;
        
        $productos->save();
    }
    
    public function update(Request $request)
    {
        //
        $productos=Producto::findOrFail($request->id);
        $productos->codigo=$request->codigo;
        $productos->nombre=$request->nombre;
        $productos->cant=$request->cant;
        $productos->precio=$request->precio;
        $productos->prec_venta=$request->prec_venta;
        $productos->is_insumo=$request->is_insumo;

        $productos->id_tipo_producto = $request->idTi_pro;
        
        $productos->save();
    } 
    
    public function destroy(Request $request)
    {
        //
        $productos=Producto::findOrFail($request->id);
        $productos->delete();
    }
    
    public function getProductos(Request $request){
        
        $productos=Producto::
        select('productos.id','productos.nombre')->get();
        
            return[
                'productos'=>$productos
            ];
        }
}

