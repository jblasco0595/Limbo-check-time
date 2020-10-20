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
                                <h5 class="modal-title" id="exampleModalLabel">Solicitud de extraTime</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="newExtraTime" method="POST" action="{{ route('extraTime.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Cantidad de horas</label>
                                        <input name="hours" type="text" class="form-control" id="recipient-name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Descripcion de la tarea</label>
                                        <textarea name="description" class="form-control" id="message-text" required="true"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button
                                    type="button"
                                    data-msg="Estas seguro de que deseas solicitar un extraTime?"
                                    data-form="newExtraTime"
                                    class="btn btn-primary bootBoxConfirm"
                                >
                                    Crear
                                </button>
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
                                <td>
                                    @if ( $userExtraTime->approved == 0)
                                        Por Aprobar
                                    @else
                                        Aprobado
                                    @endif
                                </td>
                                <td>
                                    @if( $userExtraTime->approved == 0)
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#updateExampleModal_{{ $userExtraTime->id }}" data-whatever="@mdo">Actualizar</button>
                                        <div class="modal fade" id="updateExampleModal_{{ $userExtraTime->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Actualizar extraTime</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="updateExtraTime_{{ $userExtraTime->id }}" method="POST" action="{{ route('extraTime.update', $userExtraTime->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Actualizar cantidad de horas</label>
                                                                <input name="hours" type="text" class="form-control" id="recipient-name" value="{{ $userExtraTime->hours }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text" class="col-form-label">Actualizar descripcion de la tarea</label>
                                                                <textarea name="description" class="form-control" id="message-text">{{ $userExtraTime->description }}</textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                        <button
                                                            type="button"
                                                            data-msg="Estas seguro de de que desea actualizar este extraTime?"
                                                            data-form="updateExtraTime_{{ $userExtraTime->id }}"
                                                            class="btn btn-primary bootBoxConfirm"
                                                        >
                                                            Actualizar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#updateExampleModal" data-whatever="@mdo" disabled="disabled">Actualizar</button>              
                                    @endif
                                </td>
                                <td>
                                    @if( $userExtraTime->approved == 0)
                                        <form id="deleteExtraTimeRecord_{{ $userExtraTime->id }}" action="{{ route('extraTime.destroy', $userExtraTime->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                type="button"
                                                data-msg="Estas seguro de que desea eliminar esta solicitud de extraTime?"
                                                data-form="deleteExtraTimeRecord_{{ $userExtraTime->id }}"
                                                class="btn btn-outline-danger bootBoxConfirm"
                                            >
                                                Eliminar
                                            </button>
                                        </form>
                                    @else 
                                        <button
                                            type="button"
                                            data-msg="Estas seguro de que desea eliminar esta solicitud de extraTime?"
                                            data-form="deleteExtraTimeRecord_{{ $userExtraTime->id }}"
                                            class="btn btn-outline-danger bootBoxConfirm"
                                            disabled="disabled"
                                        >
                                            Eliminar
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </table>
            </div>
        </div>

        @if( $userExtraTimes->isEmpty() )
            <div class="jumbotron jumbotron-fluid">
                <div class="container text-center">
                    <h1 class="display-4">No existen extraTime aun</h1>
                    <p class="lead">Genera la solicitud de uno cuando tengas la disponibilidad</p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12 text-center">
                {{ $userExtraTimes->links() }}
            </div>
        </div>
    </div>

    <script>
     
    </script>
@endsection