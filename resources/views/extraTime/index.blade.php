@extends('layouts.app')

@section('content')
    <div class="container">
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
                                        <form action="{{ route('extraTime.approved', $extraTimeRecord->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" id="custId" name="custId" value="1">
                                            <button type="submit" class="btn btn-outline-success" value="1" onclick="return confirm('¿Desea actualiza el ExtraTime?')">Aprobar</button>
                                        </form>                                    
                                    @else 
                                        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="top" data-content="ExtraTime Aprobado">
                                            Aprobado
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if( $extraTimeRecord->approved == 0)
                                        <form action="{{ route('extraTime.destroy', $extraTimeRecord->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Eliminar Extra Time Record?')">Eliminar</button>
                                        </form>
                                    @else
                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Eliminar Extra Time Record?')" disabled="disabled">Eliminar</button>
                                    @endif
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
