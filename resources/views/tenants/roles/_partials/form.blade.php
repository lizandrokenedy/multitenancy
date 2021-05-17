<div class="form-row">
    <div class="form-group col-sm-12 col-md-6">
        <label for="name" class="required">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do Perfil"
            value="{{ $role->name ?? '' }}">
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="description" class="required">Descrição</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Descrição do perfil"
            value="{{ $role->description ?? '' }}">
    </div>
</div>


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Tela</th>
            <th>Permissão</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Usuário</td>
            <td>
                <div class="row">
                    <div class="col-md-2">
                        <label for="name">Visualizar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Editar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Atualizar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Excluir</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>

                    <div class="col-md-2">
                        <label for="name">Todas</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>
                </div>




            </td>
        </tr>
        <tr>
            <td>Escola</td>
            <td>
                <div class="row">
                    <div class="col-md-2">
                        <label for="name">Visualizar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Editar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Atualizar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Excluir</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>

                    <div class="col-md-2">
                        <label for="name">Todas</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>
                </div>




            </td>
        </tr>
        <tr>
            <td>Professores</td>
            <td>
                <div class="row">
                    <div class="col-md-2">
                        <label for="name">Visualizar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Editar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Atualizar</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>


                    <div class="col-md-2">
                        <label for="name">Excluir</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>
                    <div class="col-md-2">
                        <label for="name">Todas</label>
                        <input type="checkbox" class="" id="name" name="name" placeholder="Nome do Perfil"
                            value="tela-usuario-visualizar">
                    </div>
                </div>




            </td>
        </tr>
    </tbody>

</table>


<div class="text-center">
    <x-btn-save />
    <x-btn-back route="tenants.roles.index" />
</div>
