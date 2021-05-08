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
            putAjax(`/tenants/companies/${self.id.val()}`, data)
            return;
        }
        postAjax('/tenants/companies', data);
    }

});
