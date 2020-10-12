@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-center">Projects Payments</h5>
            <div class="card-body">
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
                                    <input name="paymentAmount" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input name="paymentDate" id="datapicker" autocomplete="off" type="text" class="form-control" placeholder="¿Cuando se valido el pago?" aria-label="¿Cuando se valido el pago?" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Fecha</span>
                                    </div>
                                </div>                           
                            </div>
                        </div>
                    </div>
                </form>
                <div class="container text-center">
                    <h5 class="card-title">Agrega Fechas y Precios de los proyectos</h5>
                    <button type="submit" class="btn btn-success" form="newProjectPayment">Crear</b>
                </div>
            </div>
        </div>
    </div>

    <script>
        var projectsForPayments = {!! json_encode($projectsForPayments) !!};
        console.log(projectsForPayments);

        $('#datapicker').datetimepicker({
            format: "Y-m-d H:i:s",
        });
    </script>

@endsection