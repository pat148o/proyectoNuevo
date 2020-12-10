<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedore;

class ProveedoresController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $proveedores= Proveedore::orderBy('nombre','asc')->paginate(4);
        }else {
            $proveedores= Proveedore::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(4);
        }

        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
                
        return [

            'pagination'=>[
                'total'=> $proveedores -> total(),
                'current_page'=> $proveedores -> currentPage(),
                'per_page'=> $proveedores -> perPage(),
                'last_page'=> $proveedores -> lastPage(),
                'from'=> $proveedores -> firstItem(),
                'to'=> $proveedores -> lastItem(),
            ],
            'proveedores'=>$proveedores
        ];
    }
    
    //guardar datos en la bd
    public function store(Request $request)
    {
        $proveedores= new Proveedore();
        $proveedores->nombre = $request->nombre;
        $proveedores->dir = $request->dir;
        $proveedores->tel = $request->tel;
        $proveedores->nom_empresa = $request->nom_empresa;
        $proveedores->email = $request->email;
        $proveedores->perso_contac = $request->perso_contac;
        $proveedores->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $proveedores= Proveedore::findOrFail($request->id);
        $proveedores->nombre = $request->nombre;
        $proveedores->dir = $request->dir;
        $proveedores->tel = $request->tel;
        $proveedores->nom_empresa = $request->nom_empresa;
        $proveedores->email = $request->email;
        $proveedores->perso_contac = $request->perso_contac;
        $proveedores->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $proveedores= Proveedore::findOrFail($request->id);
        $proveedores->delete();
    }

    public function getProveedores(Request $request)
    {
        $proveedores = Proveedore::orderBy('nombre', 'asc')->get();
        return [
            'proveedores'=>$proveedores];
    }
}
