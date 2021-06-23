const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');

    self.init = function () {
        self.btnSave.on('click', self.save);
    }

    self.save = function () {
        const data = self.form.serializeArray();

        if (self.id.val()) {
            tenantAjax.put(`/tenants/students/${self.id.val()}`, data)
            return;
        }
        tenantAjax.post('/tenants/students', data);
    }

});
