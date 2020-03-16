@extends('layouts.app') {{-- cortamos este extend desde login.blade --}}


@section('content')

<div class="container"> {{-- agregamos este div para que la informacion apareza dentro de la clase container --}}
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
<ul>
    @foreach ($errors->all() as $error)
<li>{{ $error }}</li> 
    @endforeach
</ul>
</div>
@endif
<form action="{{url('/empleados')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
 {{ csrf_field() }}
 @include('empleados.form',['Modo'=>'crear'])

</form>
</div> {{-- aqui cerramos el div --}}

@endsection