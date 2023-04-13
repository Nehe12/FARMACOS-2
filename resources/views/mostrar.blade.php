@extends('header')
@section('content')

<div class="card">
  <h5 class="card-header">FARMACO {{$farmacos2->farmaco}} CON NUMERO DE REGISTRO {{$farmacos2->id}}</h5>
  <div class="card-body">
    <!-- @php
    print_r($farmacos2)
    @endphp -->
    <form class="">
      <div class="row">
        <div class="col">
          <div class="col-md-7">
            <label for="imagenF">IMAGEN</label>
            <img src="{{$farmacos2->url}}" class="img-fluid img-thumbnail" alt="Imagen Farmaco">
          </div>

        </div>
        <div class="col">
          <div class="col-md-7">
            <label for="farmacoN" class="form-label">FARMACO</label>
            <input type="text" class="form-control" id="farmacoN" value="{{$farmacos2->farmaco}}">
          </div>
          <div class="col-md-7">
            <label for="mecanismo" class="form-label">MECANISMO</label>
            <input type="text" class="form-control" id="mecanismo" value="{{$farmacos2->mecanismo}}">
          </div>
          <div class="col-7">
            <label for="titulo" class="form-label">BIBLIOGRAFIA</label>
            @foreach($bibliografia as $biblios)
            @if($farmacos2->id_bibliografia == $biblios->id)
            <input type="text" class="form-control" id="titulo" value="{{$biblios->titulo}}">
            @endif
            @endforeach
          </div>

        </div>
        <div class="col">
          <div class="col-7">
            <label for="grupo" class="form-label">GRUPO</label>
            @foreach($grupo as $grup)
            @if($farmacos2->id_grupo == $grup->id)
            <input type="text" class="form-control" id="grupo" value="{{$grup->grupo}}">
            @endif
            @endforeach
          </div>

          <div class="col-md-7">
            <label for="interaccion" class="form-label">INTERACCION</label>
            @foreach($interacciones as $inter)
            @if($farmacos2->id == $inter->id_farmaco)
            <input type="text" class="form-control" id="interaccion" value="{{$inter->id}}.- {{$inter->interaccion}}" placeholder="Interaccion">
            @endif
            @endforeach
          </div>

        </div>
      </div>
    </form>
    <a href="{{route('inicio')}}" class="btn btn-info boton-select  ">REGRESAR</a>
  </div>
</div>



@endsection