const manter = (new function () {
    const self = this;
    self.id = $('#id');
    self.form = $('form');
    self.btnSave = $('#salvar');
    self.school = $('#school_id');
    self.student = $('#student_id');
    self.studentSelected = $('#student_selected');
    self.bodyMass = $('#body_mass');
    self.height = $('#height');
    self.imc = $('#imc');

    self.init = function () {
        self.applyMask();
        self.buildComboStudents();
        self.school.on('change', self.buildComboStudents);
        self.height.on('keyup', self.calculateImc);
        self.bodyMass.on('keyup', self.calculateImc);
        self.btnSave.on('click', self.save);
    }

    self.save = function () {
        const data = self.form.serializeArray();

        if (self.id.val()) {
            tenantAjax.put(`/tenants/assessments/${self.id.val()}`, data)
            return;
        }
        tenantAjax.post('/tenants/assessments', data);
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

        self.selectStudent();
    }

    self.selectStudent = function () {
        if (self.studentSelected.val()) {
            self.student.val(self.studentSelected.val())
        }
    }


    self.calculateImc = function () {
        const imc = parseInt(self.bodyMass.val()) / (parseFloat(self.height.val()) * parseFloat(self.height.val()));
        if (!isNaN(imc) && isFinite(imc)) {
            return self.imc.val(imc.toFixed(2))
        }
        self.imc.val('');
    }

    self.applyMask = function () {
        self.height.mask('0.00')
        self.bodyMass.mask('000')
    }

});
