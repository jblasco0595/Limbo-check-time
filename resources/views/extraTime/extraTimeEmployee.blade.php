@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
            </div>
            <div class="col-lg-3 col-md-4">
                <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Nuevo Extra Time</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Solicitud de Extra Time</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="newExtraTime" method="POST" action="{{ route('extraTime.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Cantidad de Horas</label>
                                        <input name="hours" type="text" class="form-control" id="recipient-name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Descripcion de la tarea</label>
                                        <textarea name="description" class="form-control" id="message-text" required="true"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" form="newExtraTime">Crear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-10">        
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Horas</th>
                        <th scope="col">Aprobada</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $userExtraTimes as $userExtraTime )
                            <tr>
                                <td scope="row">{{ $userExtraTime->id }}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ $userExtraTime->description }}</td>
                                <td>{{ $userExtraTime->hours }} </td>
                                <td>{{ $userExtraTime->approved }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#updateExampleModal" data-whatever="@mdo">Actualizar</button>
                                    <div class="modal fade" id="updateExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar ExtraTime</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="updateExtraTime_{{ $userExtraTime->id }}" method="POST" action="{{ route('extraTime.update', $userExtraTime->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Actualizar Cantidad de Horas</label>
                                                            <input name="hours" type="text" class="form-control" id="recipient-name" value="{{ $userExtraTime->hours }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Actualizar Descripcion de la tarea</label>
                                                            <textarea name="description" class="form-control" id="message-text">{{ $userExtraTime->description }}</textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" form="updateExtraTime_{{ $userExtraTime->id }}">Actualizar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>           
                                </td>
                                <td>
                                    <form action="{{ route('extraTime.destroy', $userExtraTime->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Eliminar Extra Time Record?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                {{ $userExtraTimes->links() }}
            </div>
        </div>
    </div>

    <script>
     
    </script>
@endsection