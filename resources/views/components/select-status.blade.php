<select class="form form-control" name="status">
    <option {{ $status == 1 ? 'selected' : '' }} value="1">Ativo</option>
    <option {{ $status == 0 ? 'selected' : '' }} value="0">Inativo</option>
</select>
