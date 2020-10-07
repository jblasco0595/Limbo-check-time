@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">       
            <div class="input-group mb-3">
                <input id="mGoal" type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Montly Goal</span>
                </div>
            </div>
        </div>

        <div class="row"> 
            <div class="input-group mb-3">
                <input id="limboCoins" type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">LimboCoins Usd Price</span>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary btn-lg btn-block">Block level button</button>
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
