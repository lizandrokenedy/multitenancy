<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="school_id" class="required">Escola</label>
        <select class="form-control" name="school_id" id="school_id">
            <option value="">Selecione</option>
            @foreach ($schools as $school)
                <option {{ isset($data->school_id) && $data->school_id == $school->id ? 'selected' : '' }}
                    value="{{ $school->id }}">{{ $school->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="student_id" class="required">Aluno</label>
        <input type="hidden" id="student_selected" value="{{ $data->student_id ?? '' }}">
        <select class="form-control" name="student_id" id="student_id">
            <option value="">Selecione</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-4">
        <label for="name" class="required">Massa Corporal</label>
        <input type="text" class="form-control" name="body_mass" id="body_mass" value="{{ $data->body_mass ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-4">
        <label for="name" class="required">Altura</label>
        <input type="text" class="form-control" name="height" id="height" value="{{ $data->height ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-4">
        <label for="name" class="required">IMC</label>
        <input type="text" readonly class="form-control" name="imc" id="imc" value="{{ $data->imc ?? '' }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="flexibility_id" class="required">Flexibilidade</label>
        <select class="form-control" name="flexibility_id" id="flexibility_id">
            <option value="">Selecione</option>
            @foreach ($flexibilitys as $flexibility)
                <option {{ isset($data->flexibility_id) && $data->flexibility_id == $flexibility->id ? 'selected' : '' }}
                    value="{{ $flexibility->id }}">{{ $flexibility->description }}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="abdominal_resistance_id" class="required">Resistência Abdominal</label>
        <select class="form-control" name="abdominal_resistance_id" id="abdominal_resistance_id">
            <option value="">Selecione</option>
            @foreach ($resistences as $resistance)
                <option
                    {{ isset($data->abdominal_resistance_id) && $data->abdominal_resistance_id == $resistance->id ? 'selected' : '' }}
                    value="{{ $resistance->id }}">{{ $resistance->description }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.{{ $path }}.index" />
</div>
