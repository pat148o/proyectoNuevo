<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ent_producto;

class Ent_productosController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $ent_productos= Ent_producto::orderBy('nombre','asc')->paginate(4);
        }else {
            $ent_productos= Ent_producto::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(4);
        }

        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
                
        return [

            'pagination'=>[
                'total'=> $ent_productos -> total(),
                'current_page'=> $ent_productos -> currentPage(),
                'per_page'=> $ent_productos -> perPage(),
                'last_page'=> $ent_productos -> lastPage(),
                'from'=> $ent_productos -> firstItem(),
                'to'=> $ent_productos -> lastItem(),
            ],
            'ent_productos'=>$ent_productos
        ];
    }
    
    //guardar datos en la bd
    public function store(Request $request)
    {
        $ent_productos= new Ent_producto();
        $ent_productos->nombre = $request->nombre;
        $ent_productos->cant = $request->cant;
        $ent_productos->num_factura = $request->num_factura;
        $ent_productos->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $ent_productos= Ent_producto::findOrfail($request->id);
        $ent_productos->nombre = $request->nombre;
        $ent_productos->cant = $request->cant;
        $ent_productos->num_factura = $request->num_factura;
        $ent_productos->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $ent_productos= Ent_producto::findOrfail($request->id);
        $ent_productos->delete();
    }

    public function getEnt_productos(Request $request)
    {
        $ent_productos = Ent_producto::orderBy('nombre', 'asc')->get();
        return [
            'ent_productos'=>$ent_productos];
    }
}

