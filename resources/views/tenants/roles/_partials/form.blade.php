<div class="form-row d-flex justify-content-center">
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



<h4 class="text-center">Selecione as permissões</h4>
<div class="row d-flex justify-content-center">

    @foreach ($modules as $module)
        <div class="col-sm-12 col-md-4 col-lg-3">
            <div class="card bg-light callout callout-info">
                {{-- <blockquote> --}}
                <div class="card-header text-center">
                    <h5>{{ $module->name }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($module->permissions as $permission)

                            <li class="list-group-item">
                                <input type="checkbox" class="mr-2 checkbox check" id="{{ $permission->id }}"
                                    name="permissions[]" value="{{ $permission->id }}">
                                <label for="{{ $permission->slug }}">{{ $permission->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <input type="checkbox" class="mr-2 checkall" id="" value="{{ $module->permissions }}">
                            <label>Todas</label>
                        </li>
                    </ul>
                </div>
                {{-- </blockquote> --}}
            </div>
        </div>
    @endforeach
</div>



{{-- <table class="table table-striped table-hover">
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

</table> --}}

<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.roles.index" />
</div>
