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


<h4 class="text-center">Selecione as escolas</h4>
<div class="row d-flex justify-content-center">

    @foreach ($schools as $school)
        <div class="col-sm-12 col-md-4 col-lg-12">
            <div class="card bg-light callout callout-info">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-light p-0">
                            <input type="checkbox" class="mr-2 checkbox check" {{$data->teachersSchool->contains('id', $school->id) ? 'checked' : ''}} id="{{ $school->id }}" name="schools[]"
                                value="{{ $school->id }}">
                            <label for="{{ $school->id }}">{{ $school->name }}</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>



<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.{{ $path }}.index" />
</div>
