@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
            </div>
            <div class="col-lg-3 col-md-4">
                <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#paidProjectModal" data-whatever="@mdo">Nuevo Pago de Proyecto</button>
                <div class="modal fade" id="paidProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Generar nuevo proyecto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="newProjectPayment" method="POST" action="{{ route('projectsPayment.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Selecciona un Proyecto</label>
                                        <select name="projectId" class="form-control" id="exampleFormControlSelect1">
                                            @foreach($projectsForPayments as $projectForPayment) 
                                                <option value="{{ $projectForPayment->id }}">{{ $projectForPayment->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input name="paymentAmount" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" required="true">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group mb-3">
                                                    <input name="paymentDate" id="datapicker" autocomplete="off" type="text" class="form-control" placeholder="¿Cuando se valido el pago?" aria-label="¿Cuando se valido el pago?" aria-describedby="basic-addon2" required="true">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">Fecha</span>
                                                    </div>
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
                                    data-msg="Estas seguro que desea generar un nuevo pago de proyecto?"
                                    data-form="newProjectPayment"
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
        
        <div class="row mt-2">
            <div class="col-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allPaidProjects as $paidProject)
                            <tr>
                            <th scope="row">{{ $paidProject->id }}</th>
                            <td>{{ $paidProject->project->name }}</td>
                            <td>{{ $paidProject->date }}</td>
                            <td>{{ $paidProject->amount }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#updatePaidProjectsModal_{{ $paidProject->id }}" data-whatever="@mdo">Actualizar</button>
                                <div class="modal fade" id="updatePaidProjectsModal_{{ $paidProject->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Actualizar Pago de Proyecto</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="updatePaidProject_{{ $paidProject->id }}" method="POST" action="{{ route('projectsPayment.update', $paidProject->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="message-text" class="col-form-label">Actualizar Monto</label>
                                                        <textarea name="amount" class="form-control" id="message-text">{{ $paidProject->amount }}</textarea>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                    <textarea name="paymentDate" id="updateDatapicker" class="form-control" required="true">{{ $paidProject->date }}</textarea>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">Fecha</span>
                                                        </div>
                                                    </div>  
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                <button
                                                    type="button"
                                                    data-msg="Estas seguro de que desea actualizar este pago?"
                                                    data-form="updatePaidProject_{{ $paidProject->id }}"
                                                    class="btn btn btn-primary bootBoxConfirm"
                                                >
                                                Actualizar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form id="deletProjectPayment" action="{{ route('projectsPayment.destroy', $paidProject->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button
                                        type="button"
                                        data-msg="Estas seguro que desea eliminar este pago?"
                                        data-form="deletProjectPayment"
                                        class="btn btn-outline-danger bootBoxConfirm"
                                    >
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if( $allPaidProjects->isEmpty() )
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container text-center">
                            <h1 class="display-4">No existen Registros de Pagos Proyectos aun</h1>
                            <p class="lead">Genera un nuevo proyecto cuando tengas la posibilidad</p>
                        </div>
                    </div>
                @endif

                <div class="col-12 text-center">
                    {{ $allPaidProjects->links() }} 
                </div>
            </div>
        </div>            
    </div>

    <script>
        var projectsForPayments = {!! json_encode($projectsForPayments) !!};
        console.log(projectsForPayments);

        var allPaidProjects = {!! json_encode($allPaidProjects) !!};
        console.log(allPaidProjects);

        $('#datapicker, #updateDatapicker').datetimepicker({
            format: "Y-m-d H:i:s",
        });
    </script>

@endsection