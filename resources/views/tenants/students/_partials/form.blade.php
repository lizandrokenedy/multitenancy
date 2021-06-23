<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" disabled class="form-control" id="name" name="name" placeholder="Nome do Módulo"
            value="{{ $data->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="email" class="required">E-mail</label>
        <input type="text" disabled class="form-control" id="email" name="email" placeholder="Nome do Módulo"
            value="{{ $data->email ?? '' }}">
    </div>
</div>

@if ($schools->count())
    <h4 class="text-center">Selecione a escola</h4>

    <div class="form-row">
        <div class="form-group col-sm-12 col-md-6">
            <label for="name" class="required">Nome</label>
            <select class="form-control" name="school" id="school">
                <option value="">Selecione</option>
                @foreach ($schools as $school)
                    <option
                        {{ isset($data->studentsSchool[0]->id) && $data->studentsSchool->contains('id', $school->id) ? 'selected' : '' }}
                        value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@else
    <h4 class="text-center">Nenhuma escola cadastrada</h4>
@endif

<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.{{ $path }}.index" />
</div>
