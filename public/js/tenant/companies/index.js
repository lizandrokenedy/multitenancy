const index = (new function () {

    const self = this;

    self.table = $('#table');

    self.init = function () {
        self.createTable();
    }

    self.createTable = function () {
        self.table.DataTable({
            ajax: {
                url: '/tenants/companies/companies-list',
                type: "POST"
            },
            columns: [
                { data: "name", name: "name", title: "Nome" },
                { data: "domain", name: "domain", title: "Domínio" },
                { data: "bd_database", name: "bd_database", title: "BD Nome" },
                { data: "bd_hostname", name: "bd_hostname", title: "BD Host" },
                { data: "bd_username", name: "bd_username", title: "BD usuário" },
                { data: "id", name: "id", title: "Ações", render: self.renderAcoes },
            ],

        });
    }




    excluir = function (id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': self.token
            },
            url: `/tenants/companies/${id}`,
            type: 'DELETE',
        }).then(function (data) {
            toastr.success(data.message);
        }).catch(function (error) {
            console.log(error.message);
        })
    }

    self.renderAcoes = function (id) {
        const acoes = `
        <div>
            <a href="/tenants/companies/${id}/edit" class="btn-sm btn-primary fa fa-edit"></a>
            <a href="javascript:void(0)" data-acao="excluir" onclick="excluir(${id})" class="btn-sm btn-danger fa fa-trash"></a>
        </div>
        `
        return acoes;
    }

});
