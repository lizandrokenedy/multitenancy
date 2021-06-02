const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');
    self.checkboxAllPermissions = $('.checkall');
    self.checkboxPermission = $('.check');

    self.init = function () {
        self.btnSave.on('click', self.save);
        self.checkboxAllPermissions.on('change', self.checkAllPermissions);
        self.checkboxPermission.on('change', self.checkPermission)
    }

    self.save = function () {
        const data = self.form.serializeArray();

        if (self.id.val()) {
            tenantAjax.put(`/tenants/roles/${self.id.val()}`, data)
            return;
        }
        tenantAjax.post('/tenants/roles', data);
    }


    self.checkAllPermissions = function (e) {
        const permissions = JSON.parse(e.target.value);
        permissions.map(item => $(`#${item.id}`).prop('checked', this.checked));
    }

    self.removeCheckAllIfNotAllPermissionsSelected = function (e) {

    }

});
