<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do Perfil"
            value="{{ $role->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="description" class="required">Descrição</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Descrição do perfil"
            value="{{ $role->description ?? '' }}">
    </div>
</div>

<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.roles.index" />
</div>
