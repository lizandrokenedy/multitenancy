const index = (new function () {

    const self = this;

    self.table = $('#table');

    self.init = function () {
        self.createTable();
    }

    self.createTable = function () {
        self.table.DataTable({
            ajax: {
                url: '/tenants/roles/list-all',
                type: "POST"
            },
            columns: [
                { data: "name", name: "name", title: "Nome" },
                { data: "description", name: "description", title: "Descrição" },
                { data: "id", name: "id", title: "Ações", class: 'text-center', orderable: false, render: self.renderActions },
            ],
            rowCallback: function (row, data) {
                console.log(data)
            }
        });
    }

    destroy = async function (id) {
        await tenantAjax.delete(`/tenants/roles/${id}`);
        self.table.DataTable().ajax.reload();
    }

    self.renderActions = function (id) {
        const actions = `
        <div>
            <a href="/tenants/roles/${id}/edit" class="btn-sm btn-primary fa fa-edit"></a>
            <a href="javascript:void(0)" data-acao="excluir" onclick="destroy(${id})" class="btn-sm btn-danger fa fa-trash"></a>
        </div>
        `
        return actions;
    }

});
