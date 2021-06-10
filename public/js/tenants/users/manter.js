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

    self.init = function () {
        self.isAdmin();
        self.alterPassword();
        self.btnSave.on('click', self.save);
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
