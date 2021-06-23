const index = (new function () {

    const self = this;

    self.table = $('#table');

    self.init = function () {
        self.createTable();
    }

    self.createTable = function () {
        self.table.DataTable({
            ajax: {
                url: '/tenants/schools/list-all',
                type: "POST"
            },
            columns: [
                { data: "name", name: "name", title: "Nome" },
                { data: "id", name: "id", title: "Ações", class: 'text-center', orderable: false, render: self.renderActions },
            ],
            rowCallback: function (row, data) {
                console.log(data)
            }
        });
    }

    destroy = async function (id) {
        await tenantAjax.delete(`/tenants/schools/${id}`);
        self.table.DataTable().ajax.reload();
    }

    self.renderActions = function (id) {
        const edit = self.canEdit ? `<a href="/tenants/schools/${id}/edit" class="btn-sm btn-primary fa fa-edit"></a>` : ''
        const remove = self.canRemove ? `<a href="javascript:void(0)" data-acao="excluir" onclick="destroy(${id})" class="btn-sm btn-danger fa fa-trash"></a>` : ''
        const actions = `
        <div>
            ${edit}
            ${remove}
        </div>
        `
        return actions;
    }

});
