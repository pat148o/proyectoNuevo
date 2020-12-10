<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;

class EmpresasController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $empresas= Empresa::orderBy('nombre','asc')->paginate(4);
        }else {
            $empresas= Empresa::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(4);
        }

        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
                
        return [

            'pagination'=>[
                'total'=> $empresas -> total(),
                'current_page'=> $empresas -> currentPage(),
                'per_page'=> $empresas -> perPage(),
                'last_page'=> $empresas -> lastPage(),
                'from'=> $empresas -> firstItem(),
                'to'=> $empresas -> lastItem(),
            ],
            'empresas'=>$empresas
        ];
    }
    
    //guardar datos en la bd
    public function store(Request $request)
    {
        $empresas= new Empresa();
        $empresas->nombre = $request->nombre;
        $empresas->propietario = $request->propietario;
        $empresas->nit = $request->nit;
        $empresas->regimen = $request->regimen;
        $empresas->dir = $request->dir;
        $empresas->tel = $request->tel;
        
        $empresas->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $empresas= Empresa::findOrfail($request->id);
        $empresas->nombre = $request->nombre;
        $empresas->propietario = $request->propietario;
        $empresas->nit = $request->nit;
        $empresas->regimen = $request->regimen;
        $empresas->dir = $request->dir;
        $empresas->tel = $request->tel;
        
        $empresas->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $empresas= Empresa::findOrfail($request->id);
        $empresas->delete();
    }

    public function getEmpresas(Request $request)
    {
        $empresas = Empresa::orderBy('nombre', 'asc')->get();
        return [
            'empresas'=>$empresas];
    }
}
