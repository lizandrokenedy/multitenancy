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


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Tela</th>
            <th>Permissão</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($modules as $module)
            <tr>
                <td>{{ $module->name }}</td>
                <td>
                    <div class="row">
                        @foreach ($module->permissions as $permission)
                            <div class="col-md-2">
                                <input type="checkbox" class="" id="{{ $permission->slug }}" name="permissions[]"
                                    value="{{ $permission->slug }}">
                                <label for="{{ $permission->slug }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach

                        <div class="col-md-2">
                            <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                                value="todos-{{ $module->id }}">
                            <label for="name">Todas</label>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>


<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.roles.index" />
</div>
