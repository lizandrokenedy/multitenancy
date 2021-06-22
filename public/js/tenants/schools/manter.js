const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');
    self.state = $('#state_id');
    self.city = $('#city_id');
    self.citySelected = $('#city_selected');

    self.init = function () {
        self.btnSave.on('click', self.save);
        self.state.on('change', self.buildComboCities);
        self.buildComboCities();
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

});
