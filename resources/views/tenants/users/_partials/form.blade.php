<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do Usuário"
            value="{{ $user->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="email" class="required">E-mail</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="E-mail do Usuário"
            value="{{ $user->email ?? '' }}">
    </div>
</div>

<div class="form-row" id="div-alter-password">
    <div class="form-group col-sm-12 col-md-6">
        <label for="password" class="required">Senha</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Senha do Usuário"
            value="">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="password_confirmation" class="required">Confirmação de Senha</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
            placeholder="Senha de Confirmação do Usuário" value="">
    </div>
</div>

<div class="form-row" id="div-role">
    <div class="form-group col-sm-12 col-md-6">
        <label for="role_id" class="required">Perfil</label>
        <select class="form-control" name="role_id" id="role_id">
            <option value="">Selecione</option>
            @foreach ($roles as $role)
                <option {{ isset($user) && $user->roles->contains('id', $role->id) ? 'selected' : '' }}
                    value="{{ $role->id }}">
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row" id="div-check-alter-password">
    <div class="form-group col-sm-12 col-md-6">
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" name="alter-password" id="alter-password" value="">
            <label class="custom-control-label" for="alter-password">Alterar Senha</label>
        </div>
    </div>
</div>

<div class="form-row">
    <div class="custom-control custom-switch ml-1">
        <input type="hidden" name="admin" id="admin">
        <input type="checkbox" class="custom-control-input" id="is-admin"
            {{ isset($user) && $user->admin ? 'checked' : '' }}>
        <label class="custom-control-label" for="is-admin">Administrador</label>
    </div>
</div>


<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.users.index" />
</div>
