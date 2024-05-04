<div class="modal fade" id="bajaActivoModal_{{ $activo->id }}" tabindex="-1" role="dialog"
    aria-labelledby="bajaActivoModalLabel_{{ $activo->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bajaActivoModalLabel_{{ $activo->id }}">Dar de baja el activo
                    {{ $activo->nombre }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bajaForm_{{ $activo->id }}" action="{{ route('bajas.store', $activo->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="activo_id" value="{{ $activo->id }}">
                    <div class="form-group">
                        <label for="quantity_{{ $activo->id }}">Cantidad a dar de baja:</label>
                        <input type="number" name="quantity" id="quantity_{{ $activo->id }}" class="form-control"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="reason_{{ $activo->id }}">Motivo:</label>
                        <select name="reason" id="reason_{{ $activo->id }}" class="form-control" required>
                            <option value="Pérdida">Pérdida</option>
                            <option value="Fin vida útil">Fin vida útil</option>
                            <option value="Deshuso">Deshuso</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_{{ $activo->id }}">Fecha:</label>
                        <input type="date" name="date" id="date_{{ $activo->id }}" class="form-control"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Baja</button>
                </form>
            </div>
        </div>
    </div>
</div>
