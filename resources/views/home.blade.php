@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">        
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
            <div class="col-2">        
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header" style="font-size:20px;">
                        LimboCoins
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Precio Actualizado</h5>
                        <p class="card-text" style="font-size:40px;">$138</p>
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
        console.log(timeRecords);
    
    
    </script>
@endsection
