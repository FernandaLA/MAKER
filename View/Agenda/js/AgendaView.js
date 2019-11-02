

$(document).ready(function () {
    var appointments = [
        {
            id: "Agendamento1",
            description: "8:30",
            location: "endereço da cliente",
            subject: "Manicure - Só mão.",
            calendar: "Pendente",
            start: new Date(2019, 10, 25, 8, 0, 0),
            end: new Date(2019, 10, 25, 9, 0, 0)
        },
        {
            id: "id2",
            description: "",
            location: "",
            subject: "IT Group Mtg.",
            calendar: "Confirmado",
            start: new Date(2019, 10, 24, 10, 0, 0),
            end: new Date(2019, 10, 24, 15, 0, 0)
        },
        {
            id: "id3",
            description: "",
            location: "",
            subject: "Course Social Media",
            calendar: "Finalizado",
            start: new Date(2019, 10, 23, 11, 0, 0),
            end: new Date(2019, 10, 23, 13, 0, 0)
        },
        {
            id: "id4",
            description: "",
            location: "",
            subject: "New Projects Planning",
            calendar: "Confirmado",
            start: new Date(2019, 10, 23, 16, 0, 0),
            end: new Date(2019, 10, 23, 18, 0, 0)
        },
        {
            id: "id5",
            description: "",
            location: "",
            subject: "Interview with James",
            calendar: "Pendente",
            start: new Date(2019, 10, 24, 15, 0, 0),
            end: new Date(2019, 10, 24, 17, 0, 0)
        },
        {
            id: "id6",
            description: "",
            location: "",
            subject: "Interview with Nancy",
            calendar: "Recusado",
            start: new Date(2019, 10, 30, 14, 0, 0),
            end: new Date(2019, 10, 30, 16, 0, 0)
        }
    ]
        var source =
        {
            dataType: "array",
            dataFields: [
                { name: 'id', type: 'string' },
                { name: 'description', type: 'string' },
                { name: 'location', type: 'string' },
                { name: 'subject', type: 'string' },
                { name: 'calendar', type: 'string' },
                { name: 'start', type: 'date' },
                { name: 'end', type: 'date' }
            ],
            id: 'id',
            localData: appointments
        };
        var adapter = new $.jqx.dataAdapter(source);
        $("#scheduler").jqxScheduler({
            date: new $.jqx.date(2019, 11, 21),
            width: '100%',
            height: 700,
            source: adapter,
            theme: 'maker',
            showLegend: true,
            ready: function () {
                $("#scheduler").jqxScheduler('ensureAppointmentVisible', 'Agendamento1');
            },
            resources:
            {
                colorScheme: "scheme03",
                dataField: "calendar",
                source:  new $.jqx.dataAdapter(source)
            },
            appointmentDataFields:
            {
                from: "start",
                to: "end",
                id: "id",
                description: "description",
                location: "place",
                subject: "subject",
                resourceId: "calendar"
            },
            view: 'monthView',
            views:
            [
                { type: 'monthView', monthRowAutoHeight: true }
            ]
        });
});