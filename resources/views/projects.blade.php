@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-lg-9 col-md-8">
         </div>
         <div class="col-lg-3 col-md-4">
            <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#projectModal" data-whatever="@mdo">Nuevo Proyecto</button>
            <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Generar nuevo proyecto</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body">
                           <form id="newProject" method="POST" action="{{ route('projects.store') }}">
                              @csrf
                              <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre</label>
                                    <input name="name" type="text" class="form-control" id="recipient-name" required="true">
                              </div>
                              <div class="form-group">
                                    <label for="message-text" class="col-form-label">Descripcion</label>
                                    <textarea name="description" class="form-control" id="message-text" required="true"></textarea>
                              </div>
                           </form>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                           <button
                              type="button"
                              data-msg="Estas seguro?"
                              data-form="newProject"
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
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-10">        
            <table class="table">
               <thead class="thead-dark">
                  <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">&nbsp;</th>
                  <th scope="col">&nbsp;</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($allProjectsRecords as $projectRecord)
                     <tr>
                        <th scope="row">{{ $projectRecord->id }}</th>
                        <td>{{ $projectRecord->name }}</td>
                        <td>{{ $projectRecord->description }}</td>
                        <td> 
                           <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#updateProjectsModal{{ $projectRecord->id }}" data-whatever="@mdo">Actualizar</button>
                           <div class="modal fade" id="updateProjectsModal{{ $projectRecord->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Actualizar Proyecto</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <form id="updateProject_{{ $projectRecord->id }}" method="POST" action="{{ route('projects.update', $projectRecord->id) }}">
                                             @csrf
                                             @method('PUT')
                                             <div class="form-group">
                                                   <label for="recipient-name" class="col-form-label">Actualizar Nombre</label>
                                                   <input name="name" type="text" class="form-control" id="recipient-name" value="{{ $projectRecord->name }}">
                                             </div>
                                             <div class="form-group">
                                                   <label for="message-text" class="col-form-label">Actualizar Descripcion</label>
                                                   <textarea name="description" class="form-control" id="message-text">{{ $projectRecord->description }}</textarea>
                                             </div>
                                          </form>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                          <button
                                             type="button"
                                             data-msg="Estas seguro?"
                                             data-form="updateProject_{{ $projectRecord->id }}"
                                             class="btn btn-primary bootBoxConfirm"
                                          >
                                             Actualizar
                                          </button>
                                       </div>
                                 </div>
                              </div>
                           </div>
                        </td>
                        <td> 
                           <form id="deleteExtraTime_{{ $projectRecord->id }}" action="{{ route('projects.destroy', $projectRecord->id) }}" method="POST">
                              @method('DELETE')
                              @csrf
                                 <button
                                    type="button"
                                    data-msg="Estas seguro?"
                                    data-form="deleteExtraTime_{{ $projectRecord->id }}"
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
            </table>
         </div>
      </div>

      @if( $allProjectsRecords->isEmpty() )
         <div class="jumbotron jumbotron-fluid">
            <div class="container text-center">
                  <h1 class="display-4">No existen Registros de Proyectos aun</h1>
                  <p class="lead">Genera un nuevo proyecto cuando tengas la posibilidad</p>
            </div>
         </div>
      @endif

      <div class="row">
         <div class="col-12 text-center">
            {{ $allProjectsRecords->links() }} 
         </div>
      </div>
   </div>

@endsection
