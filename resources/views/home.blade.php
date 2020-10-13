@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">        
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User</th>
                        <th scope="col">Rango de tiempo</th>
                        <th scope="col">segundos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allTimeRecords as $timeRecord)
                            <tr>
                            <th scope="row">{{ $timeRecord->id }}</th>
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ $timeRecord->init_time }} / {{ $timeRecord->end_time }}</td>
                            <td>{{ $timeRecord->seconds_difference }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </table>
            </div>
            <div class="col-lg-2 col-md-4">        
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header text-center" style="font-size:20px;">
                        LimboCoins
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Precio Actualizado</h5>
                        <p id="limboCoinPrice" class="card-text text-center" style="font-size:30px;">$10</p>
                    </div>
                </div>      
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header text-center" style="font-size:20px;">
                        Extra Time
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Acumulado</h5>
                        <p id="extraTime" class="card-text text-center" style="font-size:30px;">1H</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                {{ $allTimeRecords->links() }}
            </div>
        </div>
    </div>
    
    <script>
        var timeRecords = {!! json_encode($allTimeRecords) !!};
        var accumulatedHour = {!! json_encode($extraTimeAccumulatedHours) !!};
        var settingPriceLimboCoin = {!! json_encode($settingPriceLimboCoin) !!};


        $('#extraTime').text( accumulatedHour + " H"  );
        $('#limboCoinPrice').text(  "$"+settingPriceLimboCoin.limbocoin_ars_price  );
    </script>
@endsection
