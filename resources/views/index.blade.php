@extends('header')
@section('content')

<a class="btn btn-primary " href="{{ route('crear.farmaco') }}">CREAR NUEVO FÁRMACO</a>

<div class="row">
    <div class="col pt-2">
        <div class="card ">
            <h4 class="card-header">LISTA DE LOS FÁRMACOS</h4>
            <div class="card-body ">
                <div class="row">
                    <div class="col-sm-12">


                        @if($mensaje = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{$mensaje}}
                        </div>
                        @endif


                    </div>
                </div>

                <table id="farmaco" class="table table-striped responsive" style="width:100%" style="white-space: nowrap; overflow-x: auto;">
                    <thead>
                        <tr>
                            <th>FARMACO</th>
                            <th>MECANISMO</th>
                            <th>EFECTO</th>
                            <!-- <th>BIBLIOGRAFIA</th> -->
                            <th>GRUPO</th>
                            <th>ESTADO</th>
                            <th>ACCIÓN</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($farmacos))
                        @foreach($farmacos as $far)
                        <tr>
                            <td>{{$far->farmaco}}</td>
                            <td>{{$far->mecanismo}}</td>
                            <td>{{$far->efecto}}</td>
                            <td>{{$far->grupo}}</td>
                            <td id="resp{{$far->id}}">
                                <br>
                                @if($far->status == 1 )
                                <button type="button" class="btn btn-sm btn-success">Activo</button>
                                @else
                                <button type="button" class="btn btn-sm btn-danger">Inactivo</button>
                                @endif
                            </td>
                            <td>
                                <br>
                                <div class="form-check form-switch">
                                    <label class="switch form-check-label">
                                        <input data-id="{{ $far->id }}" class="form-check-input mi_checkbox" type="checkbox" data-onstyle="success" role="switch" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $far->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <!-- <div class="form-check form-switch">

                                    <label class="form-check-label mi-switch" for="checkbox">
                                        <input id="checkbox" data-id="{{$far->id}}" class="form-check-input mi-switch" type="checkbox" 
                                        role="switch" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" 
                                        data-off="InActive" {{ $far->status ? 'checked' : ''}}>
                                    </label>
                                </div> -->

                            </td>
                            <td>
                                <div class="text-start">
                                    <a href="{{route('edit.farmaco',$far->id)}}" class="btn btn-warning btnEditar btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="text-start">
                                    <!-- {{route('show.farmaco',$far->id)}} -->
                                    <a href="{{route('show.farmaco',$far->id)}}" class="btn btn-danger btnDelete btn-sm" data-bs-target="#staticBackdrop">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                                    <!-- <button type="button" class="btn btn-danger btnDelete btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-trash3-fill"></i>
                        </button> -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>FARMACO</th>
                            <th>MECANISMO</th>
                            <th>EFECTO</th>
                            <!-- <th>BIBLIOGRAFIA</th> -->
                            <th>GRUPO</th>
                            <th>ESTADO</th>
                            <th>ACCIÓN</th>
                            <th>EDITAR</th>
                            <th>ELIMINAR</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.mi_checkbox').change(function() {
            //Verifico el estado del checkbox, si esta seleccionado sera igual a 1 de lo contrario sera igual a 0
            var estatus = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            console.log(estatus);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                method: "GET",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                //url: '/StatusNoticia',
                url: '{{ route("activar.farmaco") }}',
                data: {
                    'estatus': estatus,
                    'id': id,
                    //  "_token": $("meta[name='csrf-token']").attr("content"),
                },
                success: function(data) {
                    $('#resp' + id).html(data.var);
                    console.log(data.var)

                }
            });
        })

    });
</script>
<!-- Modal -->
<div class="modal fade " id="mostrarInter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">FÁRMACO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="">
                    <div class="row">
                        <div class="col">
                            <div class="col-md-7">
                                <label for="farmacoN" class="form-label">FÁRMACO</label>
                                <input type="text" class="form-control" id="farmacoN">
                            </div>
                            <div class="col-md-7">
                                <label for="mecanismo" class="form-label">MECANISMO</label>
                                <input type="text" class="form-control" id="mecanismoN">
                            </div>
                            <div class="col-md-7">
                                <label for="imagenF">IMAGEN</label>
                                <img src="" id="imagenF" class="img-fluid img-thumbnail" alt="Imagen Farmaco">
                            </div>
                        </div>
                        <div class="col">

                            <div class="col-7">
                                <label for="titulo" class="form-label">EFECTO</label>
                                <input type="text" class="form-control" id="efectoN">
                            </div>
                            <div class="col-7">
                                <label for="titulo" class="form-label">BIBLIOGRAFÍA</label>
                                <input type="text" class="form-control" id="bibliografiaN">
                            </div>

                        </div>

                        <div class="col">
                            <div class="col-7">
                                <label for="grupo" class="form-label">GRUPO</label>
                                <input type="text" class="form-control" id="grupoN">
                            </div>

                            <div class="col-md-7">
                                <label for="interaccion" class="form-label">INTERACCIÓN</label>
                                <input type="text" class="form-control" id="interaccionN" placeholder="Interaccion">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>




@endsection