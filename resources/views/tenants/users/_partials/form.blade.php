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

<div class="form-row" id="div-check-alter-password">
    <div class="form-group col-sm-12 col-md-6">
        <input type="checkbox" name="alter-password" id="alter-password" value="">
        <label class="form-check-label">Alterar Senha</label>
    </div>
</div>


<div class="text-center">

    <button type="button" id="salvar" class="btn btn-primary">
        <i class="far fa-save mr-2"></i>
        Salvar
    </button>
    <a href="{{ route('users.index') }}" class="btn btn-danger">
        <i class="fa fa-chevron-left mr-2"></i>
        Voltar
    </a>
</div>
