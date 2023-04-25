@extends('header')
@section('content')






<div class="card pt-2">
  <div class="card-header ">
    <h4 class="register card-title">Editar {{$farmacos->farmaco}}</h4>
  </div>
  <div class="card-body py-3">
    <div class="col-sm-12 ">
      @if($mensaje = Session::get('msg'))
      <div class="alert alert-success" role="alert">
        {{$mensaje}}
      </div>
      @endif
    </div>
    <form class="" action="{{route('update.farmaco',$farmacos->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method("PUT")
      <input name="id" value="{{$farmacos->id}}" hidden>
      <div class="row">
        <div class="col">
          <div class="col-md-9">
            <label for="farmaco" class="form-label">Fármaco </label>
            <input type="text" class="form-control " name="farmaco" value="{{$farmacos->farmaco}}">
            <div class="invalid-feedback">
            </div>
          </div><!-- -->
          <div class="col-md-9">
            <label for="mecanismo" class="form-label">Mecanismo </label>
            <input type="text" class="form-control " id="mecanismo" name="mecanismo" value="{{$farmacos->mecanismo}}" required>
            <div class="valid-feedback">
            </div>
          </div><!-- -->
          <div class="col-md-9">
            <label for="efecto" class="form-label">Efecto </label>
            <input type="text" class="form-control " id="efecto" name="efecto" value="{{$farmacos->efecto}}" required>
            <div class="valid-feedback">
            </div>
          </div><!-- -->



        </div>
        <div class="col">
          <div class="py-3 col-md-9">
            <label for="mecanismo" class="form-label">Imagen Actual </label><br>
            <img src="{{$farmacos->url}}" alt="" name="" class="rounded float-start img-fluid img-thumbnail">
          </div><!-- -->
          <div class="py-3 col-md-9">
            <label for="mecanismo" class="form-label">Agregar Imagen </label>
            <input type="file" class="form-control" value="image" aria-label="file example" name="image">
            <div class="invalid-feedback">
            </div>
          </div><!-- -->




          <!--<div class="col-md-9">
            <label for="estatus">Estatus</label>
            <input type="number" class="form-control " name="estatus" id="estatus" required value="{{$farmacos->status}}">
            <div class="valid-feedback">
            </div>
          </div> -->


        </div>
        <div class="py-2 ">
          <label for="" class="form-label">Grupo</label>
          <select class="form-control selectpicker" data-style="btn btn-secondary" name="grupo" id="grupo">
            @if(isset($grupo))
            @foreach($grupo as $grupos)
            @if($farmacos->id_grupo == $grupos->id)
            <option value="{{$grupos->id}}">{{$grupos->grupo}}</option>
            @endif
            @endforeach
            @foreach($grupo as $itemGrup)
            <option value="{{$itemGrup->id}}">{{$itemGrup->grupo}}</option>
            @endforeach
            @endif
          </select>
        </div><!-- -->
        <div class="py-2 ">
          <label for="" class="form-label">Bibliografía</label>
          <!-- <textarea name="" id="" cols="30" rows="10">{{$biblioselect}}</textarea> -->
          <select class="form-control selectpicker" data-style="btn btn-secondary" title="Seleccionar Bibliografia" name="bibliografia[]" id="bibliografia" multiple>

            @foreach($bibliografia as $biblios)
            @php
            $selected = in_array($biblios->id,$biblioselect->pluck('id')->toArray());

            @endphp
            <option value="{{$biblios->id}}" {{ $selected ? 'selected' : ''   }}>{{$biblios->titulo}}</option>
            @endforeach

          </select>
        </div><!-- -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
          <button class="btn btn-warning mb-3 " type="submit">ACTUALIZAR</button>
        </div>

    </form>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a class="btn btn-primary " href="{{ route('crear.farmaco') }}"> NUEVO FÁRMACO</a>
      <a class=" btn btn-success " href="" data-bs-toggle="modal" data-bs-target="#AgregarInter">AGREGAR INTERACCIÓN</a>
    </div>


  </div>


</div>
<div class="row">
  <div>
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">INTERACCIONES</h5>
      </div>
      <div class="card-body">



        <table id="tabla_interacciones" class="table table-striped responsive" style="width:100%" style="white-space: nowrap; overflow-x: auto;">
          <thead>
            <tr>
              <th>ID</th>
              <th>INTERACCIÓN</th>
              <th>FARMACO</th>
              <th>EDITAR</th>
              <th>ELIMINAR</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($interacciones))
            @foreach($interacciones as $inteFm)
            @if($inteFm->id_farmaco==$farmacos->id)
            <tr>
              <td>{{$inteFm->id}}</td>
              <td>{{$inteFm->interaccion}}</td>
              <td>{{$farmacos->farmaco}}</td>
              <td>
                <button type="button" class="btn btn-info" id="bt-modal" data-bs-toggle="modal" data-bs-target="#editarInter" data-id_inter="{{$inteFm->id}}" data-inter="{{$inteFm->interaccion}}" data-id_far="{{$inteFm->id_farmaco}}"><i class="bi bi-arrow-counterclockwise"></i></button>
              </td>
              <td>

                <form class="delete_interaccion" action="{{route('destroy.interaccion',$inteFm->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="text" value="{{$farmacos->id}}" name="farm_id" hidden>
                  <button type="submit" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>

                </form>

              </td>
            </tr>
            @endif
            @endforeach
            @endif
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>INTERACCIÓN</th>
              <th>FARMACO</th>
              <th>EDITAR</th>
              <th>ELIMINAR</th>
            </tr>
          </tfoot>
        </table>

      </div>
    </div>
  </div>
</div>

</div>


</div>
</div>
</div>


<!-- Agregar Interaccion -->
<div class="modal fade" id="AgregarInter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR INTERACCIÓN</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{route('store2.interacciones')}}" method="post">
          @csrf

          <input type="text" value="{{$farmacos->id}}" name="id_farmaco" hidden>


          <div class=" col-md">
            <label for="interaccionA" class="form-label">Interacción</label>
            <textarea class="form-control" name="interaccionA" id="interaccionA" cols="10" rows="5" required placeholder="Interacción"></textarea>

            <div class="valid-feedback">
            </div>

          </div>

          <div class="mb-3 col-md-9 pt-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" id="estatus" name="estatus" hidden>
              <!-- <label class="form-check-label" for="flexCheckDefault">Estatus</label> -->
            </div>

          </div>
          <input type="submit" class="btn btn-primary " value="Guardar">

        </form>
      </div>

    </div>
  </div>
</div>

<!-- ACTUALIZAR INTERACCION -->

<div class="modal fade" id="editarInter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ACTUALIZAR INTERACCIÓN</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('update.interacciones')}}" method="post">
          @csrf
          @method("PUT")
          <input type="text" id="id_interaccion" value="" name="id_interaccion" hidden>
          <input type="text " id="id_farmaco" name="id_farmaco" value="" hidden>
          <div class="row g-3">
            <div class="col col-md">
              <label for="interaccion" class="form-label pt-0">Interacción</label>
              <textarea class="form-control" name="interaccion" id="inter" cols="10" rows="5"></textarea>
              <!-- <input type="text" class="form-control " name="interaccion" id="inter" value=""> -->
            </div>
          </div>
          <div class="mb-3 col-md-9 py-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="estatus" hidden>
              <!-- <label class="form-check-label" for="flexCheckDefault">Estatus</label> -->
            </div>
          </div>


          <input type="submit" class="btn btn-primary " value="Guardar">


        </form>
      </div>

    </div>
  </div>
</div>
<!-- <script>
  @if($mensaje = Session :: get('msg'))
  Swal.fire(
    'Good job!',
    '{{ $mensaje }}',
    'success'
  )
  @endif
</script>
<script>
  @if($message = session('succes_message'))
  Swal.fire(
    'Good job!',
    '{{ $message }}',
    'success'
  )
  @endif
</script> -->
@endsection