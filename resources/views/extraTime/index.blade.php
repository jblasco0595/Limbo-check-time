@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-10">
                <table class="table table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Horas</th>
                        <th scope="col">Aprobada</th>
                        <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $extraTimeRecords as $extraTimeRecord )
                            <tr>
                                <td scope="row">{{ $extraTimeRecord->id }}</td>
                                <td>{{ $extraTimeRecord->user->name }}</td>
                                <td>{{ $extraTimeRecord->description }}</td>
                                <td>{{ $extraTimeRecord->hours }}</td>
                                <td>
                                    @if( $extraTimeRecord->approved == 0)
                                        <form id="approbeExtraTime_{{ $extraTimeRecord->id }}" action="{{ route('extraTime.approved', $extraTimeRecord->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" id="custId" name="custId" value="1">
                                            <!-- call to bootbox confirm (data-form = form -> id) -->
                                            <button
                                                type="button"
                                                data-msg="Estas seguro de aprobar esta solicitud de horas extra?"
                                                data-form="approbeExtraTime_{{ $extraTimeRecord->id }}"
                                                class="btn btn-outline-success bootBoxConfirm text-white"
                                            >
                                                Aprobar
                                            </button>
                                        </form>
                                    @else
                                        <button 
                                            type="button" 
                                            class="btn btn-secondary" 
                                            data-container="body" 
                                            data-toggle="popover" 
                                            data-placement="top" 
                                            data-content="ExtraTime Aprobado"
                                        >
                                            Aprobado
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if( $extraTimeRecord->approved == 0)
                                        <form id="deleteExtraTime_{{ $extraTimeRecord->id }}" action="{{ route('extraTime.destroy', $extraTimeRecord->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <!-- call to bootbox confirm (data-form = form -> id) -->
                                            <button
                                                type="button"
                                                data-msg="Estas seguro de que deseas eliminar esta solicitud de horas extra?"
                                                data-form="deleteExtraTime_{{ $extraTimeRecord->id }}"
                                                class="btn btn-outline-danger bootBoxConfirm text-white"
                                            >
                                                Eliminar
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-outline-danger text-white" disabled="disabled">Eliminar</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </table>
            </div>
        </div>

        @if( $extraTimeRecords->isEmpty() )
        <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                <h1 class="display-4">No existen extraTime aun</h1>
                <p class="lead">Pasa mas tarde y veamos si hay alguna novedad</p>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-12 text-center">
                {{ $extraTimeRecords->links() }}
            </div>
        </div>
    </div>
@endsection
