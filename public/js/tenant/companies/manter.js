const manter = (new function () {

    const self = this;
    self.token = $('meta[name=csrf-token]').attr('content');

    self.form = $('form');
    self.btnSave = $('#salvar');

    self.init = function () {
        self.btnSave.on('click', self.save);
        // $('input').on('blur', self.validateForm);

    }

    self.validateForm = function () {
        console.log(self.form.valid());
    }

    self.save = function () {
        $.ajax({
            url: "/tenants/companies",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': self.token
            },
            data: self.form.serializeArray(),
            beforeSend: function () {
                console.log('enviando');
            }
        })
            .then(function (data) {

                toastr.success(data.message);

                setTimeout(function () {
                    history.go(-1);
                }, 2000)
            })
            .catch(function (error) {
                toastr.error(error.responseJSON.message);
            });
    }

});
