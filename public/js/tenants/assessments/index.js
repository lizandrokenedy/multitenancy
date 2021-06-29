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
                { data: "students.name", name: "student_id", title: "Aluno" },
                { data: "evaluator.name", name: "evaluator_id", title: "Avaliador" },
                { data: "schools.name", name: "school_id", title: "Escola" },
                { data: "body_mass", name: "body_mass", title: "Massa Corporal" },
                { data: "height", name: "height", title: "Altura" },
                { data: "flexibility.description", name: "flexibility", title: "Flexibilidade" },
                { data: "abdominal_resistance.description", name: "abdominal_resistance", title: "Resistência Abdominal" },
                { data: "imc", name: "imc", title: "IMC" },
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

    destroy = async function (id) {
        await tenantAjax.delete(`/tenants/assessments/${id}`);
        self.table.DataTable().ajax.reload();
    }

    self.renderActions = function (id) {
        const edit = self.canEdit ? `<a href="/tenants/assessments/${id}/edit" class="btn-sm btn-primary fa fa-edit"></a>` : '';
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
