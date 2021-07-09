const index = (new function () {

    const self = this;

    self.table = $('#table');
    self.closeModal = $('.close');

    self.init = function () {
        self.createTable();
    }

    self.createTable = function () {
        self.table.DataTable({
            ajax: {
                url: '/tenants/students/list-all',
                type: "POST"
            },
            columns: [
                { data: "name", name: "name", title: "Nome" },
                { data: "students_school", name: "schools", title: "Escolas", orderable: false, render: self.renderSchools },
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
        const edit = self.canEdit ? `<a href="/tenants/students/${id}/edit" class="btn-sm btn-primary fa fa-edit"></a>` : '';
        const history = `<a href="#" onclick="setDataHistoryModal(${id})" class="btn-sm btn-success fa fa-eye" class="btn-sm btn-success" data-toggle="modal" data-target="#modal-xl"></a>`;

        const actions = `
        <div>
            ${edit}
            ${history}
        </div>
        `
        return actions;
    }

    self.getDataHistory = function (id) {
        return tenantAjax.get(`/tenants/reports/students/history/${id}`)
    }

    setDataHistoryModal = async function (id) {
        self.cleanModal();
        const dataHistory = await self.getDataHistory(id);

        const table = self.createTableHistory(dataHistory.data.infos);
        $('.modal-body').append(`
            <div class='chart'>
                <canvas id="chart"></canvas>
            </div>
            <div class='history'>
                ${table}
            </div>
        `)

        self.createChart(dataHistory.data.chart);
    }

    self.cleanModal = function () {
        $('.history').remove();
        $('.chart').remove();
    }

    self.formatDateBR = function (date) {
        return new Date(date).toLocaleString('pt-BR')
    }

    self.createTableHistory = function (infos) {
        console.log(infos);
        const rows = infos.map((info, index) => {
            return `
            <tr>
                <td>${index + 1}</td>
                <td>${info.body_mass}</td>
                <td>${info.height}</td>
                <td>${info.flexibility.description}</td>
                <td>${info.abdominal_resistance.description}</td>
                <td>${info.imc}</td>
                <td>${info.evaluator.name}</td>
                <td>${self.formatDateBR(info.created_at)}</td>
            </tr>
            `
        }).join('')

        return `
        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Massa Corporal</th>
                    <th>Altura</th>
                    <th>Flexibilidade</th>
                    <th>Resistência Abdominal</th>
                    <th>IMC</th>
                    <th>Avaliador</th>
                    <th>Data Avaliação</th>
                  </tr>
                </thead>
                <tbody>
                    ${rows}
                </tbody>
            </table>
        </div>
        `;
    }


    self.pluck = function (arr, key) {
        return arr.map(i => i[key]);
    }

    self.createChart = function (dataChart) {
        const data = self.pluck(dataChart, 'imc');
        const labels = self.pluck(dataChart, 'labels');

        self.buildChart(data, labels);
    }


    self.buildChart = function (data, labels) {

        new Chart($('#chart'), {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    fill: false,
                    label: '# IMC',
                    data,
                    backgroundColor: [
                        '#117a8b',
                    ],
                    borderColor: [
                        '#117a8b',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        // gridLines: {
                        //     display: false,
                        // }
                    }],
                    yAxes: [{
                        // gridLines: {
                        //     display: false,
                        // },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }

            }
        });
    }

});
