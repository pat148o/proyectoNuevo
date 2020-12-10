<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;

class EmpleadosController extends Controller
{
  
    
    public function index(Request $request)
    {  
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {

            $empleados=Empleado::join('cargos','empleados.id_cargo','=','cargos.id')
            ->select('empleados.id','empleados.nombre','empleados.apellido','empleados.tel','empleados.dir','cargos.nombre as nomCar')
            ->orderBy('empleados.nombre','asc')->paginate(4);
        }else {
            $empleados=Empleado::join('cargos','empleados.id_cargo', '=','cargos.id') 
    ->select('empleados.id','empleados.nombre','empleados.apellido','empleados.tel','empleados.dir','cargos.nombre as nomCar')
    ->where('empleados.nombre',$buscar)
    ->orwhere('empleados.nombre','like','%'.$buscar.'%')
    ->orderBy('empleados.nombre','asc')->paginate(4);
        }

        
        return ['pagination'=>[

                'total'=>$empleados->total(),
                'current_page'=>$empleados->currentPage(),
                'per_page'=>$empleados->perPage(),
                'last_page'=>$empleados->lastPage(),
                'from'=>$empleados->firstItem(),
                'to'=>$empleados->lastItem(),

            ],'empleados' =>$empleados
     
        
        ];
    
    
    }

    public function store(Request $request)
    {
        //
        $empleados=new Empleado();
        $empleados->nombre=$request->nombre;
        $empleados->apellido=$request->apellido;
        $empleados->tel=$request->tel;
        $empleados->dir=$request->dir;
        
        $empleados->id_cargo= $request->idCargo;
        $empleados->save();
    }
    
    public function update(Request $request)
    {
    
        $empleados=Empleado::findOrFail($request->id);
        $empleados->nombre=$request->nombre;
        $empleados->apellido=$request->apellido;
        $empleados->tel=$request->tel;
        $empleados->dir=$request->dir;
        
        $empleados->id_cargo= $request->idCargo;
        $empleados->save();
    }
    
    public function destroy(Request $request)
    {
        $empleados=Empleado::findOrFail($request->id);
        $empleados->delete();
    }
    

    public function getEmpleados(Request $request){

      
        
    $empleados=Empleado::
    select('empleados.id','empleados.nombre')->get();
    
        return[
            'empleados'=>$empleados
        ];
    }
    
}

