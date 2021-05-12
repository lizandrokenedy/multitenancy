const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');
    self.divAlterPassword = $('#div-alter-password');
    self.divCheckAlterPassword = $('#div-check-alter-password');
    self.checkBoxalterPassword = $('#alter-password');

    self.init = function () {
        self.btnSave.on('click', self.save);
        self.checkBoxalterPassword.on('click', self.alterPassword);
        self.alterPassword();
    }

    self.save = function () {
        const data = self.form.serializeArray();

        if (self.id.val()) {
            tenantAjax.put(`/clients/users/${self.id.val()}`, data)
            return;
        }
        tenantAjax.post('/clients/users', data);
    }

    self.alterPassword = function () {

        if (self.id.val()) {
            self.checkBoxalterPassword.val(self.checkBoxalterPassword.is(':checked'));
            self.checkBoxalterPassword.is(':checked') ? self.divPasswordShow() : self.divPasswordHide();
            return
        }
        self.divCheckAlterPassword.hide();
    }


    self.divPasswordHide = function () {
        self.divAlterPassword.hide();
    }


    self.divPasswordShow = function () {
        self.divAlterPassword.show();
    }

});
