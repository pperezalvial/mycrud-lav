<?php

namespace App\Http\Controllers;

use App\Empleados;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados']=Empleados::paginate(5);
        return view('empleados.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $datosEmpleado= request()->all();

        $campos=[
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mimes:jpeg,jpg,png'
        ];

        $Mensaje=["required "=>'El :attribute es requerido']; //VALIDA LOS ATRIBUTOS Y AGREGA EL MENSAJE

        $this->validate($request,$campos, $Mensaje);

        $datosEmpleado= request()->except('_token');

        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleados::insert($datosEmpleado);    
       // return response()->json($datosEmpleado);
       return redirect('empleados')->with('Mensaje','Empleado Agregado con éxito'); //esto tomara desde el index, la variable mensaje y cuando se utlice el storage
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleados::findOrFail($id);
        return view('empleados.edit',compact('empleado')); //accederemos retornando a edit.blade, enviamos la ifnromacion de empleado a través del retormno de la vista
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $campos=[
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
         
        ];

       
        if($request->hasFile('Foto'))   {
            $campos+=['Foto' => 'required|max:10000|mimes:jpeg,jpg,png'];
        }
        $Mensaje=["required "=>'El :attribute es requerido']; //VALIDA LOS ATRIBUTOS Y AGREGA EL MENSAJE

        $this->validate($request,$campos, $Mensaje);

        $datosEmpleado= request()->except(['_token','_method']); //recepcionamos los datos que no necesitamos realizando una excepcion y los colocamos en la variable 
        if($request->hasFile('Foto')){
            $empleado = Empleados::findOrFail($id); // copiamos esto mismo para consultar la información antigua
            Storage::delete('public/'.$empleado->Foto); // utilizo el metodo storage, le digo que necesito borrar y de donde la necesito tomar (en este caso borrar la foto antigua y poner la nueva) 
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public'); //agregamos esta seccion para poder reemplazar foto.
        }
        Empleados::where('id','=',$id)->update($datosEmpleado); //ejecutar la instruccion web, buscando el id en el puesto solicitado y luego realizamos un update
        //$empleado = Empleados::findOrFail($id);//para consultar la información actual
       // return view('empleados.edit',compact('empleado')); //accederemos retornando a edit.blade, enviamos la ifnromacion de empleado a través del retormno de la vista
        return redirect('empleados')->with('Mensaje','Empleado Modificado con éxito'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id) //aqui reemplazamos los objetos para recibir solo el id
    {
        $empleado = Empleados::findOrFail($id); // busco los registros correspondientes al id que estoy buscando
        if(Storage::delete('public/'.$empleado->Foto)){// y si el borrado se lleva a cabo ->
        Empleados::destroy($id); //eliminamos de la base de datos
        } 
        return redirect('empleados')->with('Mensaje','Empleado Eliminado');  //usamos un return para desplegar la informacion con el registro borrado
        //aqui enviamos un parametro id luego lo destruimos y finalmente actualizamos con el return los registros
    }
}
