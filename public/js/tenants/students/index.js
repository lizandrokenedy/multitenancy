const index = (new function () {

    const self = this;

    self.table = $('#table');
    self.btnPDF = $('#btn-pdf')

    self.init = function () {
        self.createTable();
        self.btnPDF.on('click', self.savePDF);
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
        const history = `<a href="#" onclick="setDataHistoryModal(${id})" class="btn-sm btn-success fa fa-eye" data-toggle="modal" data-target="#modal-xl"></a>`;
        const mail = `<a href="#" id="btn-mail" onclick="sendMailHistory(${id})" class="btn-sm btn-danger fa fa-envelope"></a>`;

        const actions = `
        <div>
            ${edit}
            ${history}
            ${mail}
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


    sendMailHistory = async function (id) {


        console.log('enviando email')
        $('#btn-mail').css({ 'pointer-events': 'none', 'cursor': 'default', 'opacity': '0.6' });
        await tenantAjax.get(`/tenants/students/send-mail-history/${id}`)

        setTimeout(() => {
            $('#btn-mail').css({ 'pointer-events': '', 'cursor': '', 'opacity': '' });
            console.log('terminou envio');
        }, 3000);

    }


    self.savePDF = function () {
        const node = document.querySelector('.modal-body');

        domtoimage.toPng(node)
            .then(function (dataUrl) {

                const width = $('.modal-body').width();
                const height = $('.modal-body').height();

                const pdf = new jsPDF('l', 'pt', [width, height]);
                pdf.addImage(dataUrl, 'PNG', 0, 0, width, height);
                // pdf.save("story.pdf");

                const binary = pdf.output();
                const binaryEncode = btoa(binary);

                const data = new FormData();
                data.append('id', 1);
                data.append('file', binaryEncode);
                // tenantAjax.post('/tenants/students/send-mail-history', data)
                $.ajax('/tenants/students/send-mail-history',
                    {
                        method: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function (data) { console.log(data) },
                        error: function (data) { console.log(data) }
                    });


            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });

    }


    // self.savePDF = function () {
    //     var reportPageHeight = $('.modal-body').innerHeight();
    //     var reportPageWidth = $('.modal-body').innerWidth();



    //     // create a new canvas object that we will populate with all other canvas objects
    //     var pdfCanvas = $('<canvas />').attr({
    //         id: "canvaspdf",
    //         width: reportPageWidth,
    //         height: reportPageHeight
    //     });

    //     // keep track canvas position
    //     var pdfctx = $(pdfCanvas)[0].getContext('2d');
    //     var pdfctxX = 0;
    //     var pdfctxY = 0;
    //     var buffer = 100;



    //     // for each chart.js chart
    //     $("canvas").each(function (index) {
    //         // get the chart height/width
    //         var canvasHeight = $(this).innerHeight();
    //         var canvasWidth = $(this).innerWidth();

    //         // draw the chart into the new canvas
    //         pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
    //         pdfctxX += canvasWidth + buffer;

    //         // our report page is in a grid pattern so replicate that in the new canvas
    //         if (index % 2 === 1) {
    //             pdfctxX = 0;
    //             pdfctxY += canvasHeight + buffer;
    //         }
    //     });




    //     // create new pdf and add our new canvas as an image
    //     var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
    //     pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);

    //     // download the pdf
    //     pdf.save('filename.pdf');
    // }




});
