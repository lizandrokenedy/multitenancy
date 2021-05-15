<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome da Permissão"
            value="{{ $permission->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="description" class="required">Descrição</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Descrição da Permissão"
            value="{{ $permission->description ?? '' }}">
    </div>
</div>

<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.permissions.index" />
</div>
