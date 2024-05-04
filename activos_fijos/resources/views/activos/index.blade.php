@extends('layouts.app')

@section('content')
    <h1>Lista de Activos Fijos</h1>
    <div class="form-group">
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre o código">
    </div>
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#nuevoActivoModal">Agregar Nuevo
        Activo</button>
    @if (session('success'))
        <div id="successAlert" style="display: none;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div id="errorAlert" style="display: none;">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Stock actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activos as $activo)
                <tr>
                    <td>{{ $activo->code }}</td>
                    <td>{{ $activo->name }}</td>
                    <td>{{ $activo->description }}</td>
                    <td>{{ $activo->stockActual() }}</td>
                    <td>
                        <a href="{{ route('bajas.create', $activo->id) }}" class="btn btn-sm btn-warning"
                            data-toggle="modal" data-target="#bajaActivoModal_{{ $activo->id }}">Dar de baja</a>
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#editarActivoModal_{{ $activo->id }}">
                            Editar
                        </button>
                        <form action="{{ route('activos.destroy', $activo->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger deleteButton"
                                data-id="{{ $activo->id }}">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal para dar de baja un activo -->
                @include('bajas.create')
                <!-- Modal para la edición de activos -->
                @include('activos.edit')
            @endforeach
        </tbody>
    </table>

    <!-- Modal para agregar un nuevo activo -->
    <div class="modal fade" id="nuevoActivoModal" tabindex="-1" role="dialog" aria-labelledby="nuevoActivoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nuevoActivoModalLabel">Agregar Nuevo Activo Fijo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('activos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="initial_amount">Cantidad Inicial:</label>
                            <input type="number" name="initial_amount" id="initial_amount" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Activo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();

                $('tbody tr').each(function() {
                    var rowText = $(this).text()
                        .toLowerCase();
                    $(this).toggle(rowText.indexOf(searchText) !== -1 || searchText === '');
                });
            });
            var successMessage = $('#successAlert').text();
            var errorMessage = $('#errorAlert').text();

            if (successMessage) {
                Swal.fire({
                    title: successMessage,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }

            if (errorMessage) {
                Swal.fire({
                    title: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
            $('.deleteButton').on('click', function(event) {
                event.preventDefault();
                var activoId = $(this).data('id');
                var form = $(this).closest('form');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Una vez eliminado, no podrás recuperar este activo.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>
@endsection
