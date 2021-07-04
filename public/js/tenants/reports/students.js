const report = (new function () {
    const self = this;
    self.student = $('#student');
    self.school = $('#school');
    self.chart = $('#chart');

    self.init = function () {
        self.school.on('change', self.buildComboStudents);
        self.buildChart();
    }

    self.getStudents = async function () {
        if (self.school.val()) {
            return await tenantAjax.get(`/tenants/students/list-students-school/${self.school.val()}`);
        }
    }

    self.buildComboStudents = async function () {
        const students = await self.getStudents();

        if (!students) {
            return;
        }

        self.student.empty();
        self.student.append(
            `<option value="">Selecione</option>`
        )
        students.data.map(student => {
            self.student.append(
                `<option value="${student.id}">${student.name}</option>`
            )
        })
    }

    self.getData = function () {
        return [
            {
                "labels": "07/2021",
                "imc": 22.63
            },
            {
                "labels": "08/2021",
                "imc": 26
            },
            {
                "labels": "09/2021",
                "imc": 30.63
            },
            {
                "labels": "10/2021",
                "imc": 22.63
            },
            {
                "labels": "11/2021",
                "imc": 30
            },
            {
                "labels": "12/2021",
                "imc": 33.55
            },
        ]

    }

    self.pluck = function (arr, key) {
        return arr.map(i => i[key]);
    }

    self.buildChart = function () {
        const dataStudent = self.getData();
        const data = self.pluck(dataStudent, 'imc');
        const labels = self.pluck(dataStudent, 'labels');
        new Chart(self.chart, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: '# IMC',
                    data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

});
