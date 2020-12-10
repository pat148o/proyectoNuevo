<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClientesController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $clientes= Cliente::orderBy('nombre','asc')->paginate(4);
        }else {
            $clientes= Cliente::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombre','asc')->paginate(4);
        }

        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
                
        return [

            'pagination'=>[
                'total'=> $clientes -> total(),
                'current_page'=> $clientes -> currentPage(),
                'per_page'=> $clientes -> perPage(),
                'last_page'=> $clientes -> lastPage(),
                'from'=> $clientes -> firstItem(),
                'to'=> $clientes -> lastItem(),
            ],
            'clientes'=>$clientes
        ];
    }
    
    //guardar datos en la bd
    public function store(Request $request)
    {
        $clientes= new Cliente();
        $clientes->nombre = $request->nombre;
        $clientes->cedula = $request->cedula;
        $clientes->tel = $request->tel;
        $clientes->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $clientes= Cliente::findOrfail($request->id);
        $clientes->nombre = $request->nombre;
        $clientes->cedula = $request->cedula;
        $clientes->tel = $request->tel;
        $clientes->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $clientes= Cliente::findOrfail($request->id);
        $clientes->delete();
    }

    public function getCliente(Request $request)
    {
        $clientes = Cliente::orderBy('nombre', 'asc')->get();
        return [
            'clientes'=>$clientes];
    }
}
