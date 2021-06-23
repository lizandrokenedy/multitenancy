const index = (new function () {

    const self = this;

    self.table = $('#table');

    self.init = function () {
        self.createTable();
    }

    self.createTable = function () {
        self.table.DataTable({
            ajax: {
                url: '/tenants/teachers/list-all',
                type: "POST"
            },
            columns: [
                { data: "name", name: "name", title: "Nome" },
                { data: "teachers_school", name: "schools", title: "Escolas", orderable: false, render: self.renderSchools },
                { data: "id", name: "id", title: "Ações", class: 'text-center', orderable: false, render: self.renderActions },
            ],
            rowCallback: function (row, data) {
                // console.log(data)
            }
        });
    }

    self.renderSchools = function (data) {
        if (!data.length) {
            return 'Professor não possui escolas';
        }

        return data.map(school => {
            return ` <span class="badge bg-primary">${school.name}</span>`
        }).join('')
    }

    self.renderActions = function (id) {
        const edit = self.canEdit ? `<a href="/tenants/teachers/${id}/edit" class="btn-sm btn-primary fa fa-edit"></a>` : '';
        const actions = `
        <div>
            ${edit}
        </div>
        `
        return actions;
    }

});
