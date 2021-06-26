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
                { data: "body_mass", name: "body_mass", title: "Massa Corporal" },
                { data: "height", name: "height", title: "Altura" },
                { data: "flexibility.description", name: "flexibility", title: "Flexibilidade" },
                { data: "abdominal_resistance.description", name: "abdominal_resistance", title: "Resistência Abdominal" },
                { data: "students.name", name: "student_id", title: "Aluno" },
                { data: "evaluator.name", name: "evaluator_id", title: "Avaliador" },
                { data: "schools.name", name: "school_id", title: "Escola" },
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
