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
                                <form id="" method="POST" action="">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Cantidad de Horas</label>
                                        <input type="text" class="form-control" id="recipient-name" required="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Descripcion de la tarea</label>
                                        <textarea class="form-control" id="message-text" required="true"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
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
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $extraTimeRecords as $extraTimeRecord )
                            <tr>
                                <td scope="row">{{ $extraTimeRecord->id }}</td>
                                <td>{{ $extraTimeRecord->user->name }}</td>
                                <td>crear limbocheck</td>
                                <td> 2 </td>
                                <td>bolean</td>
                                <td>
                                    <button type="submit" class="btn btn-outline-primary" form="">Actualizar</button>
                                    <button type="submit" class="btn btn-outline-danger" form="">Actualizar</button>
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
                {{ $extraTimeRecords->links() }}
            </div>
        </div>
    </div>

    <script>
     
    </script>
@endsection
