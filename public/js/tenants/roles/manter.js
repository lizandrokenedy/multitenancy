const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');

    self.init = function () {
        self.btnSave.on('click', self.save);
        $('.checkall').on('change', self.checkAllPermissions);
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
        // JSON.parse($('.checkall').val()).map(item => console.log(item.slug))
        const permissions = JSON.parse(e.target.value);
        permissions.map(item => $(`#${item.slug}`).prop('checked', this.checked))
        // $('input:checkbox').not(this).prop('checked', this.checked);

        // $("input[name='permissions[]']:checked").each(function(){
        //     console.log($(this).val());
        // });
    }

});
