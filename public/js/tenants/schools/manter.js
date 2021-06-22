const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');
    self.state = $('#state_id');
    self.city = $('#city_id');
    self.citySelected = $('#city_selected');
    self.table = $('#table');
    self.btnAddManager = $('#add-manager');
    self.manager = $('#manager');

    self.init = function () {
        self.buildComboCities();
        self.createTable();
        self.btnSave.on('click', self.save);
        self.state.on('change', self.buildComboCities);
        self.btnAddManager.on('click', self.addManager);
    }

    self.createTable = function () {
        self.table.DataTable({
            ajax: {
                url: '/tenants/schools/list-managers',
                type: "POST",
                data: {
                    school_id: self.id.val()
                }
            },
            serverSide: false,
            columns: [
                { data: "name", name: "name", title: "Nome" },
                { data: "email", name: "email", title: "E-mail" },
                { data: "telephone", name: "telephone", title: "Telefone" },
                { data: "cell", name: "cell", title: "Celular" },
                { data: "id", name: "id", title: "Ações", class: 'text-center', orderable: false, render: self.renderActions },
            ],
            rowCallback: function (row, data) {
                console.log(data)
            }
        });

    }

    self.renderActions = function (id) {
        const actions = `
        <div>
            <a href="javascript:void(0)" data-acao="excluir" onclick="destroy(${id})" class="btn-sm btn-danger fa fa-trash"></a>
        </div>
        `
        return actions;
    }

    self.save = function () {
        const data = self.form.serializeArray();

        if (self.id.val()) {
            tenantAjax.put(`/tenants/schools/${self.id.val()}`, data)
            return;
        }
        tenantAjax.post('/tenants/schools', data);
    }

    self.getCities = async function () {
        if (self.state.val()) {
            return await tenantAjax.get(`/tenants/cities/${self.state.val()}`);
        }
    }

    self.buildComboCities = async function () {
        const cities = await self.getCities();

        if (!cities) {
            return;
        }

        self.city.empty();
        self.city.append(
            `<option value="">Selecione</option>`
        )
        cities.data.map(city => {
            self.city.append(
                `<option value="${city.id}">${city.name}</option>`
            )
        })

        self.selectCity();
    }

    self.selectCity = function () {
        if (self.citySelected.val()) {
            self.city.val(self.citySelected.val())
        }
    }


    self.addManager = function () {
        if (self.manager.val() != "") {
            const manager = JSON.parse(self.manager.val());
            self.table.DataTable().row.add({
                "name": manager.name,
                "email": manager.email,
                "telephone": manager.telephone,
                "cell": manager.cell,
                "id": manager.id
            }).draw(true);
        }

        self.manager.val('');
    }

});
