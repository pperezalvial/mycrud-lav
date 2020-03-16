
<div class="form-group">
    <label for="Nombre" class="control-label">{{'Nombre'}}</label>
    <input type="text" class="form-control {{$errors->has('Nombre')?'is-invalid':''}}" name="Nombre" id="nombre" 
    value="{{isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}">{{-- se agrega en el value el motodo para traer los valores guardados de empleados--}}
    {!! $errors->first('Nombre','<div class="invalid-feedback">:message</div>')   !!} {{-- trabaj con la impresion, alerta un ataque xss, no envia informacion en formato de script --}}
    
    <div class="invalid-feedback">Por favor ingrese el nombre</div>

</div>
<div class="form-group">
<label for="ApellidoPaterno" class="control-label">{{'Apellido Paterno'}}</label>
<input type="text" class="form-control {{$errors->has('ApellidoPaterno')?'is-invalid':''}}"name="ApellidoPaterno" id="ApellidoPaterno" 
value="{{isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno')}}">
{!! $errors->first('ApellidoPaterno','<div class="invalid-feedback">:message</div>')   !!} {{-- trabaj con la impresion, alerta un ataque xss, no envia informacion en formato de script --}}
    
<div class="invalid-feedback">Por favor ingrese el Apellido Paterno</div>


</div>
<div class="form-group">
<label for="ApellidoMaterno" class="control-label">{{'Apellido Materno'}}</label>
<input type="text"  class="form-control {{$errors->has('ApellidoMaterno')?'is-invalid':''}}"  name="ApellidoMaterno" id="ApellidoMaterno" 
value="{{isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno')}}">
{!! $errors->first('ApellidoMaterno','<div class="invalid-feedback">:message</div>')   !!} {{-- trabaj con la impresion, alerta un ataque xss, no envia informacion en formato de script --}}
    
<div class="invalid-feedback">Por favor ingrese el Apellido Manterno    </div>


</div>
<div class="form-group">
<label for="Correo" class="control-label">{{'Correo'}}</label>
<input type="email"  class="form-control {{$errors->has('Correo')?'is-invalid':''}}" name="Correo" id="Correo"
value="{{isset($empleado->Correo)?$empleado->Correo:old('Correo')}}">
{!! $errors->first('Correo','<div class="invalid-feedback">:message</div>')   !!} {{-- trabaj con la impresion, alerta un ataque xss, no envia informacion en formato de script --}}
    
<div class="invalid-feedback">Por favor ingrese el Correo</div>

</div>

<div class="form-group">
<label for="Foto" class="control-label">{{'Foto'}}</label>
@if(@isset($empleado->Foto))
<br/>
<img  class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="200"> 
@endif
<input type="file" class="form-control {{$errors->has('Foto')?'is-invalid':''}}" name="Foto" id="Foto" value="">
{!! $errors->first('Foto','<div class="invalid-feedback">:message</div>')   !!} {{-- trabaj con la impresion, alerta un ataque xss, no envia informacion en formato de script --}}
    
<div class="invalid-feedback">Por favor agregue foto</div>
</div>

<input type="submit" class="btn btn-success" value="{{$Modo=='crear' ? 'Agregar':'Modificar'}}"> {{-- valida si modo es iguala crear le muestra el usuario el valor en el boton va atener el valor de agregar o de lo contrario de modficiar --}}   
<a class="btn btn-primary"  href="{{url('empleados')}}">Regresar</a> 