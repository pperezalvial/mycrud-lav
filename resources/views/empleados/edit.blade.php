@extends('layouts.app') {{-- cortamos este extend desde login.blade --}}


@section('content')

<div class="container"> {{-- agregamos este div para que la informacion apareza dentro de la clase container --}}

<form action="{{url('/empleados/' . $empleado->id) }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{method_field('PATCH')}} {{-- metodo que recibe envía el update --}}
    @include('empleados.form',['Modo'=>'editar'])

   

   </form>
</div> {{-- aqui cerramos el div --}}

@endsection