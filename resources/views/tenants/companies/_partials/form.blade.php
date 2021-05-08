<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" required class="form-control" id="name" name="name" placeholder="Nome da Empresa"
            value="{{ $company->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="domain" class="required">Domínio</label>
        <input type="text" required class="form-control" id="domain" name="domain" placeholder="Domínio da Empresa"
            value="{{ $company->domain ?? '' }}">
    </div>
</div>
<div class="form-row">
    {{-- <div class="form-group col-sm-12 col-md-6">
        <label for="bd_database" class="required">BD Nome</label>
        <input type="text" required class="form-control" id="bd_database" name="bd_database"
            placeholder="Nome da Base de Dados" value="{{ $company->bd_database ?? '' }}">
    </div> --}}
    {{-- <div class="form-group col-sm-12 col-md-6">
        <label for="bd_hostname" class="required">BD Host</label>
        <input type="text" required class="form-control" id="bd_hostname" name="bd_hostname"
            placeholder="Hostname da Base De Dados" value="{{ $company->bd_hostname ?? env('DB_HOST') }}">
    </div> --}}
</div>
{{-- <div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="bd_username" class="required">BD Usuário</label>
        <input type="text" required class="form-control" id="bd_username" name="bd_username"
            placeholder="Usuário da Base de Dados" value="{{ $company->bd_username ?? env('DB_USERNAME')}}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="bd_password" class="required">BD Senha</label>
        <input type="password" required class="form-control" id="bd_password" name="bd_password"
            placeholder="Senha da Base De Dados">
    </div>
</div>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="create_tables" name="create_tables">
        <label class="form-check-label" for="create_tables">
            Deseja apenas criar as tabelas?
        </label>
    </div>
</div> --}}
<div class="text-center">

    <button type="button" id="salvar" class="btn btn-primary">
        <i class="far fa-save mr-2"></i>
        Salvar
    </button>
    <a href="{{ route('companies.index') }}" class="btn btn-danger">
        <i class="fa fa-chevron-left mr-2"></i>
        Voltar
    </a>
</div>
