@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        <div class="card text-center">
            <div class="card-header">
                <h3>Ajustes</h3> 
            </div>
            <div class="card-body"> 
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-sm-10 offset-lg-2 offset-md-1">  
                            <form id="settingsForm" method="POST" action="{{ route('settings') }}">
                                @csrf
                                <div class="form-group">            
                                    <div class="row">       
                                        <div class="input-group mb-3">
                                            <input name="montlyGoal" id="mGoal" type="text" class="form-control" placeholder="Meta esperada" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2" style="width: 170px">Meta Mensual</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <div class="row"> 
                                        <div class="input-group mb-3">
                                            <input name="limboCoinsArsPrice" id="limboCoins" type="text" class="form-control" placeholder="Precio LimboCoins" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2" style="width: 170px">LimboCoins precio USD</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>  
                    </div>  
                </div>  
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-secondary btn-lg" form="settingsForm" >Actualiza</button>
            </div>
        </div>

    <script>
        var lastSettingsRecord = {!! json_encode($lastSettingsRecord) !!};
        console.log(lastSettingsRecord);

        $( document ).ready(function() {
            $("#mGoal").attr("placeholder", lastSettingsRecord.montly_goal)
            $("#limboCoins").attr("placeholder", lastSettingsRecord.limbocoin_ars_price);  
        });
    </script>
@endsection
