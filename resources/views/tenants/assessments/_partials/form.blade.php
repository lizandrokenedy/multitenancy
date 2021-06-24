
<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="school_id" class="required">Escola</label>
        <select class="form-control" name="school_id" id="school_id">
            <option value="">Selecione</option>
        </select>
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="student_id" class="required">Aluno</label>
        <select class="form-control" name="student_id" id="student_id">
            <option value="">Selecione</option>
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-4">
        <label for="name" class="required">Massa Corporal</label>
        <input type="text" class="form-control" name="body_mass" id="body_mass">
    </div>
    <div class="form-group col-sm-12 col-md-4">
        <label for="name" class="required">Altura</label>
        <input type="text" class="form-control" name="height" id="height">
    </div>
    <div class="form-group col-sm-12 col-md-4">
        <label for="name" class="required">IMC</label>
        <input type="text" readonly class="form-control" name="imc" id="imc">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="flexibility" class="required">Flexibilidade</label>
        <select class="form-control" name="flexibility" id="flexibility">
            <option value="">Selecione</option>
        </select>
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="abdominal_resistance" class="required">Resistência Abdominal</label>
        <select class="form-control" name="abdominal_resistance" id="abdominal_resistance">
            <option value="">Selecione</option>
        </select>
    </div>
</div>

<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.{{ $path }}.index" />
</div>
