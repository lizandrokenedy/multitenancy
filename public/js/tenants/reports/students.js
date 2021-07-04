const report = (new function () {
    const self = this;
    self.student = $('#student');
    self.school = $('#school');
    self.chart = $('#chart');
    self.infoAssessment = $('#info-assessment');

    self.init = function () {
        self.school.on('change', self.cleanComboStudents);
        self.school.on('change', self.buildComboStudents);
        self.student.on('change', self.getDataReport);
        self.getDataReport();
    }

    self.getStudents = function () {
        if (self.school.val()) {
            return tenantAjax.get(`/tenants/students/list-students-school/${self.school.val()}`);
        }
    }

    self.cleanComboStudents = function () {
        self.student.empty();
        self.student.append(
            `<option value="">Selecione</option>`
        )
    }

    self.buildComboStudents = async function () {
        const students = await self.getStudents();

        if (!students) {
            return;
        }

        students.data.map(student => {
            self.student.append(
                `<option value="${student.id}">${student.name}</option>`
            )
        })
    }

    self.getDataReport = async function () {
        if (self.student.val()) {
            const dataStudent = await tenantAjax.get(`/tenants/reports/students/data/${self.student.val()}`)

            if (!dataStudent) {
                self.buildChart([], []);
                return;
            }

            const data = self.pluck(dataStudent.data.chart, 'imc');
            const labels = self.pluck(dataStudent.data.chart, 'labels');

            self.buildChart(data, labels);

            self.buildInfos(dataStudent.data.info);
            return;
        }

        self.buildChart([], []);

    }

    self.buildInfos = function (data) {

        $('#info').remove();

        if (data) {
            const school = data.schools.name;
            const student = data.students.name;
            const body_mass = data.body_mass;
            const height = data.height;
            const flexibility = data.flexibility.description;
            const abdominal_resistance = data.abdominal_resistance.description;
            const imc = data.imc;

            return self.infoAssessment.append(`
            <div id="info">
                <h3 class="profile-username text-center">Escola: ${school}</h3>

                <p class="text-muted text-center">Aluno: ${student}</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Massa Corporal</b> <a class="float-right">${body_mass}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Altura</b> <a class="float-right">${height}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Flexibilidade</b> <a class="float-right">${flexibility}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Resistência Abdominal</b> <a class="float-right">${abdominal_resistance}</a>
                    </li>
                    <li class="list-group-item">
                        <b>IMC</b> <a class="float-right">${imc}</a>
                    </li>
                </ul>
            </div>
            `)

        }

        return self.infoAssessment.append(`
        <div id="info">
            <p class="text-center">Nenhum registro encontrado!</p>
        </div>`)
    }

    self.pluck = function (arr, key) {
        return arr.map(i => i[key]);

    }

    self.buildChart = function (data, labels) {

        new Chart(self.chart, {
            type: 'line',

            data: {
                labels,
                datasets: [{
                    fill: false,
                    label: '# IMC',
                    data,
                    backgroundColor: [
                        '#117a8b',
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        '#117a8b',
                        // 'rgba(54, 162, 235, 1)',
                        // 'rgba(255, 206, 86, 1)',
                        // 'rgba(75, 192, 192, 1)',
                        // 'rgba(153, 102, 255, 1)',
                        // 'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                // maintainAspectRatio: true,
                // responsive: true,
                // legend: {
                //     display: false
                // },
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
