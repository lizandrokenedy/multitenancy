const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');
    self.divAlterPassword = $('#div-alter-password');
    self.divCheckAlterPassword = $('#div-check-alter-password');
    self.checkBoxAlterPassword = $('#alter-password');
    self.divRole = $('#div-role');
    self.checkBoxIsAdmin = $('#is-admin');
    self.role = $('#role_id');
    self.admin = $('#admin');
    self.state = $('#state_id');
    self.city = $('#city_id');

    self.init = function () {
        self.isAdmin();
        self.getCities()
        self.alterPassword();
        self.btnSave.on('click', self.save);
        self.state.on('change', self.getCities);
        self.checkBoxAlterPassword.on('click', self.alterPassword);
        self.checkBoxIsAdmin.on('change', self.isAdmin);
    }

    self.save = function () {
        const data = self.form.serializeArray();

        if (self.id.val()) {
            tenantAjax.put(`/tenants/users/${self.id.val()}`, data)
            return;
        }
        tenantAjax.post('/tenants/users', data);
    }

    self.getCities = async function () {
        const stateId = self.state.val();
        if (stateId) {
            const cities = await tenantAjax.get(`/tenants/cities/${self.state.val()}`);
            self.city.empty();
            self.city.append(
                `<option value="">Selecione</option>`
            )
            cities.data.map(city => {
                self.city.append(
                    `<option value="${city.id}">${city.name}</option>`
                )
            })
        }
    }


    self.alterPassword = function () {

        if (self.id.val()) {
            self.checkBoxAlterPassword.val(self.checkBoxAlterPassword.is(':checked'));
            self.checkBoxAlterPassword.is(':checked') ? self.divPasswordShow() : self.divPasswordHide();
            return
        }
        self.divCheckAlterPassword.hide();
    }

    self.isAdmin = function () {
        self.admin.val(self.checkBoxIsAdmin.is(':checked'))
        self.checkBoxIsAdmin.is(':checked') ? self.divRoleHide() : self.divRoleShow();
    }

    self.divRoleHide = function () {
        self.role.val('');
        self.divRole.hide();
    }

    self.divRoleShow = function () {
        self.divRole.show();
    }

    self.divPasswordHide = function () {
        self.divAlterPassword.hide();
    }

    self.divPasswordShow = function () {
        self.divAlterPassword.show();
    }

});
