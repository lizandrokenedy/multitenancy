<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do Módulo"
            value="{{ $data->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="status" class="required">Status</label>
        <x-select-status status="{{$data->status ?? 1}}"/>
    </div>
</div>


<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.{{ $path }}.index" />
</div>
