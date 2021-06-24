const index = (new function () {

    const self = this;

    self.table = $('#table');

    self.init = function () {
        self.createTable();
    }

    self.createTable = function () {
        self.table.DataTable({
            ajax: {
                url: '/tenants/assessments/list-all',
                type: "POST"
            },
            columns: [
                { data: "name", name: "name", title: "Nome" },
                { data: "id", name: "id", title: "Ações", class: 'text-center', orderable: false, render: self.renderActions },
            ],
            rowCallback: function (row, data) {
                // console.log(data)
            }
        });
    }

    self.renderSchools = function (data) {
        if (!data.length) {
            return 'Nenhuma escola vinculada';
        }

        return data.map(school => {
            return ` <span class="badge bg-primary">${school.name}</span>`
        }).join('')
    }

    self.renderActions = function (id) {
        const edit = self.canEdit ? `<a href="/tenants/assessments/${id}/edit" class="btn-sm btn-primary fa fa-edit"></a>` : '';
        const actions = `
        <div>
            ${edit}
        </div>
        `
        return actions;
    }

});
