@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
            </div>
            <div class="col-lg-3 col-md-4">
                <button type="button" class="btn btn-dark ml-3 mb-3" data-toggle="modal" data-target="#limbocoinsMoveModal" data-whatever="@mdo">Agregar LimboCoins</button>
                <div class="modal fade" id="limbocoinsMoveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Agrega LimboCoins a el usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="newLimbocoinMove" method="POST" action="{{ route('limbocoinsMove.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Selecciona un usuario</label>
                                        <select name="userId" class="form-control" id="exampleFormControlSelect1">
                                            @foreach($allUsers as $user) 
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">LC</span>
                                                    </div>
                                                    <input name="libocoinsAmount" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required="true">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Descripcion</label>
                                                    <textarea name="description" class="form-control" id="message-text"></textarea>
                                                </div>                       
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button
                                    type="button"
                                    data-msg="Estas seguro que desea generar este nuevo movimiento de limboCoins?"
                                    data-form="newLimbocoinMove"
                                    class="btn btn btn-primary bootBoxConfirm"
                                >
                                    Crear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="row mt-2">
            <div class="col-12">
                <table class="table table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Monto</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allLimbocoinsMoveRecords as $limbocoinsMoveRecord)
                            <tr>
                                <th scope="row">{{ $limbocoinsMoveRecord->id }}</th>
                                <td>{{ $limbocoinsMoveRecord->user->name }}</td>
                                <td>{{ $limbocoinsMoveRecord->description }}</td>
                                <td>{{ $limbocoinsMoveRecord->amount }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary text-white" data-toggle="modal" data-target="#limbocoinsMoveRecord_{{ $limbocoinsMoveRecord->id }}" data-whatever="@mdo">Actualizar</button>
                                    <div class="modal fade" id="limbocoinsMoveRecord_{{ $limbocoinsMoveRecord->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar la adjudicación</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="updateLimbocoinsMoveRecord_{{ $limbocoinsMoveRecord->id }}" method="POST" action="{{ route('limbocoinsMove.update', $limbocoinsMoveRecord->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Actualizar monto</label>
                                                            <textarea name="amount" class="form-control" id="message-text">{{ $limbocoinsMoveRecord->amount }}</textarea>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                        <textarea name="description" class="form-control" required="true">{{ $limbocoinsMoveRecord->description }}</textarea>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">Description</span>
                                                            </div>
                                                        </div>  
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button
                                                        type="button"
                                                        data-msg="Estas seguro que desea actualizar este movimiento de limboCoins?"
                                                        data-form="updateLimbocoinsMoveRecord_{{ $limbocoinsMoveRecord->id }}"
                                                        class="btn btn-primary bootBoxConfirm "
                                                    >
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form id="deleteLimboCoinsMove_{{ $limbocoinsMoveRecord->id }}" action="{{ route('limbocoinsMove.destroy', $limbocoinsMoveRecord->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            type="button"
                                            data-msg="Estas seguro que desea eliminar este movimiento de limboCoins?"
                                            data-form="deleteLimboCoinsMove_{{ $limbocoinsMoveRecord->id }}"
                                            class="btn btn-outline-danger bootBoxConfirm text-white"
                                        >
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if( $allLimbocoinsMoveRecords->isEmpty() )
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container text-center">
                            <h1 class="display-4">No existen Adjudicaciones de LimboCoins</h1>
                            <p class="lead">Agrega limbocoins a un usuario cuando sea requerido</p>
                        </div>
                    </div>
                @endif

                <div class="col-12 text-center">
                    
                </div>
            </div>
        </div>                        
    </div>

    <script>
        var allUsers = {!! json_encode($allUsers) !!};
        var allLimbocoinsMoveRecords = {!! json_encode($allLimbocoinsMoveRecords) !!};
        console.log(allUsers, allLimbocoinsMoveRecords);

        $('#exampleFormControlSelect1').select2({
            theme: 'bootstrap',
        });
    </script>

@endsection



