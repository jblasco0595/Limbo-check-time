@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">        
                <table class="table table-striped table-dark">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User</th>
                        <th scope="col">Rango de tiempo</th>
                        <th scope="col">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allRecords as $timeRecord)
                            <tr>
                            <th scope="row">{{ $timeRecord->id }}</th>
                            <td>{{ $timeRecord->user->name }}</td>
                            <td>
                                <form id="editTimeForm_{{ $timeRecord->id }}" method="POST" action="{{ route('updateTimeRange', $timeRecord->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="datapicker" name="initTimeEdit" class="form-control form-control-sm user-time-range" type="text" value="{{ $timeRecord->init_time }}"> 
                                                    </div>
                                                </div>
                                           </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="updateDatapicker" name="endTimeEdit" class="form-control form-control-sm user-time-range" type="text" value="{{ $timeRecord->end_time }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </form>   
                            </td>
                            <td> 
                                <button
                                    type="button"
                                    data-msg="Estas seguro de actualizar este rango de tiempo?"
                                    data-form="editTimeForm_{{ $timeRecord->id }}"
                                    class="btn btn-outline-primary text-white bootBoxConfirm"
                                >
                                    Actualizar
                                </button>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </table>

                @if( $allRecords->isEmpty() )
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container text-center">
                            <h1 class="display-4">No existen rangos de tiempo aun</h1>
                            <p class="lead">Pasa mas tarde y veamos si hay alguna novedad</p>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-2 col-md-4">        
                
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header text-center" style="font-size:20px">
                        LimboCoins
                    </div>
                    <div class="card-body" style="font-size:20px; color:white; background-color:#343a40">
                        <h5 class="card-title text-center">Precio actualizado</h5>
                        <p id="limboCoinPrice" class="card-text text-center" style="font-size:30px;">$10</p>
                    </div>
                </div>
                  
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                {{ $allRecords->links() }}
            </div>
        </div>
    </div>

    <script>
        var timeRecords = {!! json_encode($allRecords) !!};
        var accumulatedHour = {!! json_encode($extraTimeAccumulatedHours) !!};
        var settingPriceLimboCoin = {!! json_encode($settingPriceLimboCoin) !!};

        $('#extraTime').text( accumulatedHour + " H"  );
        $('#limboCoinPrice').text(  "$"+settingPriceLimboCoin.limbocoin_ars_price  );

        $('#datapicker, #updateDatapicker').datetimepicker({
            format: "Y-m-d H:i:s",
        });
     
    </script>
@endsection
