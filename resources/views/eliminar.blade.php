@extends('header')
@section('content')


<div class="row">
    <div class="col pt-4">
        <div class="card ">
            <h4 class="card-header">ELIMINAR FARMACO {{$farmacos->farmacos}}</h4>
            <div class="card-body">
                <div class="alert alert-danger container" role="alert">
                    <h3>Estas seguro de eliminar este registro!!!</h3>
                    <h5>Se eliminara las interacciones relacionadas con este farmaco</h5>
                    <table class="table table-sm table-hover responsive ">
                        <thead>
                            <tr>
                                <th>FARMACO</th>
                                <th>MECANISMO</th>
                                <th>PUBLIC ID</th>
                                <th class="container-fluid">IMG</th>
                                <th>EFECTO</th>
                                <th>ID_BIBLIOGRAFIA</th>
                                <th>ID_GRUPO</th>
                                <th>ESTATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-ligth ">
                                <td>{{$farmacos->farmaco}}</td>
                                <td>{{$farmacos->mecanismo}}</td>
                                <td>{{$farmacos->public_id}}</td>
                                <td>
                                    <img src="{{$farmacos->url}}" alt="imagen farmaco" width="25%" height="25%" class="img-fluid img-thumbnail">
                                </td>
                                <td>{{$farmacos->id_bibliografia}}</td>
                                <td>{{$farmacos->id_grupo}}</td>
                                <td>{{$farmacos->status}}</td>

                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <form action="{{route('destroy.farmaco',$farmacos->id)}}" method="post">
                        @csrf
                        @method("DELETE")
                        <a href="{{route('inicio')}}" class="btn btn-info">REGRESAR</a>
                        <button class="btn btn-danger">ELIMINAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection