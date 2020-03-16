@extends('layouts.app') {{-- cortamos este extend desde login.blade --}}


@section('content')

<div class="container"> {{-- agregamos este div para que la informacion apareza dentro de la clase container --}}


@if(Session::has('Mensaje'))

<div class="alert alert-success" role="alert"> {{-- agregamos la sesscion get mensaje, dentro de una alerta para que aparezca un mensaje --}}

    {{
        Session::get('Mensaje') 
    }}
</div>

{{-- Asigna la varable Mensaje para tomarla desde el controlador --}}

@endif

<a href="{{url('empleados/create')}}" class="btn btn-success">Agregar Empleado</a> {{-- link a la plagina de agregar empleado create.blade --}}
<br>
<br>
<table class="table table-light table-hover" >
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
        
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado){{-- designar todos los  registros, unificarlos y manternerlos en la variable empleado , la 
            variable $empleado es la que se va a mantener para consultar por las colummnas de mas abajo, como nombre foto etc.--}}
            
        
        <tr>
        <td>{{$loop->iteration}}</td>  
        <td>
            <img src="{{asset('storage').'/'.$empleado->Foto}}" class="img-thumbnail img-fluid" alt="" width="100"> {{-- se agrega la foto visualmente al index el 
                asset indica la ruta y le indicamos q en la carpeta storage se encuentran las imagenes no olvidar realizar en link al storage
                con un php artisan storage:link --}}
            
            
        </td>
        <td>{{$empleado->Nombre}} {{$empleado->ApellidoPaterno}} {{$empleado->ApellidoMaterno}}</td> {{-- Esto concatena las columnas de la tabla sin alterar las demàs, como el create y el edit --}}
        
        
        <td>{{$empleado->Correo}}</td>
     
        <td><a class="btn btn-warning" href="{{ url('/empleados/' .$empleado->id. '/edit' )}}"> Editar</a> {{-- se crea el link para editar enviando el dato unico de id --}}
        
            <form method ="POST" action="{{ url('/empleados/' .$empleado->id) }}" style="display:inline">  {{-- se utuliza para borrar y enviar el dato id unico style="display:inline alinea el boton --}}
        {{ csrf_field() }}
        {{method_field('DELETE')}}    {{-- METODO QUE SOLICITA UN DELETE, ES DECIR QUE ENVIAREMOS EL CAMPO NECESARIO PARA IDENTIFICAR EL BORRADO Y PODER ACCEDER AL METODO DESTROY EN EL CONTROLER  --}}
        <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');" >Borrar</button>
        </form></td>
        </tr>
        @endforeach
    </tbody>
</table>  
{{ $empleados->links()}}
</div> {{-- aqui cerramos el div --}}

@endsection