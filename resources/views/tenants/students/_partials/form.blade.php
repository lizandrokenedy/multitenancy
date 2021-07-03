<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" disabled class="form-control" id="name" name="name" value="{{ $data->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="email" class="required">E-mail</label>
        <input type="text" disabled class="form-control" id="email" name="email" value="{{ $data->email ?? '' }}">
    </div>
</div>

@if ($schools->count())
    <div class="form-row">
        <div class="form-group col-sm-12 col-md-3">
            <label for="school" class="required">Escola</label>
            <select class="form-control" name="school" id="school">
                <option value="">Selecione</option>
                @foreach ($schools as $school)
                    <option
                        {{ isset($data->studentsSchool[0]->id) && $data->studentsSchool->contains('id', $school->id) ? 'selected' : '' }}
                        value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-12 col-md-3">
            <label for="serie" class="required">Série</label>
            <select class="form-control" name="serie" id="serie">
                <option value="">Selecione</option>
                @foreach ($series as $serie)
                    <option
                        {{ isset($data->studentsSerie[0]->id) && $data->studentsSerie->contains('id', $serie->id) ? 'selected' : '' }}
                        value="{{ $serie->id }}">{{ $serie->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-12 col-md-3">
            <label for="class" class="required">Turma</label>
            <input type="text" class="form-control" id="class" name="class" placeholder="Turma do Aluno"
                value="{{ $data->studentsSchool[0]->pivot->class ?? '' }}">
        </div>

        <div class="form-group col-sm-12 col-md-3">
            <label for="period" class="required">Período</label>
            <select class="form-control" name="period" id="period">
                <option value="">Selecione</option>
                @foreach ($periods as $period)
                    <option
                        {{ isset($data->studentsPeriod[0]->id) && $data->studentsPeriod->contains('id', $period->id) ? 'selected' : '' }}
                        value="{{ $period->id }}">{{ $period->description }}</option>
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
