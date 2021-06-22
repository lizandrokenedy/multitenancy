<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do Módulo"
            value="{{ $data->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="status" class="required">Status</label>
        <x-select-status status="{{ $data->status ?? 1 }}" />
    </div>
</div>


<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="state" class="required">Estado</label>
        <select class="form-control" name="state_id" id="state_id">
            <option value="">Selecione</option>
            @foreach ($states as $state)
                <option
                    {{ isset($data->address->state_id) && $data->address->state_id == $state->id ? 'selected' : '' }}
                    value="{{ $state->id }}">
                    {{ $state->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="city_id" class="required">Cidade</label>
        <input type="hidden" id="city_selected" value="{{ $data->address->city_id ?? '' }}">
        <select class="form-control" name="city_id" id="city_id">
            <option value="">Selecione</option>

        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="address" class="required">Endereço</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Endereço do Usuário"
            value="{{ $data->address->address ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-3">
        <label for="district" class="required">Bairro</label>
        <input type="text" class="form-control" id="district" name="district" placeholder="Município do Usuário"
            value="{{ $data->address->district ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-3">
        <label for="number" class="required">Número</label>
        <input type="text" class="form-control" id="number" name="number" placeholder="Número do Endereço"
            value="{{ $data->address->number ?? '' }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="status" class="required">Gestores</label>
        <select class="form-control" name="manager" id="manager">
            <option value="">Selecione</option>
            @foreach ($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-sm-12 col-md-2 d-flex align-items-end">
        <button class="btn btn-success">
            <i class="fa fa-plus"></i>
        </button>
    </div>
</div>

<div class="card mt-3">

    <div class="card-header">
        <h3 class="card-title">Gestores</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.{{ $path }}.index" />
</div>
