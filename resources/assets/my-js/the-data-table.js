var table = $('#fileexport-datatable').DataTable({
    initComplete: function () {
        this.api().columns().every(function () {
            var column = this;
            var select = $('<select><option value=""></option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                });

            column.data().unique().sort().each(function (d, j) {
                select.append('<option value="' + d + '"><p class="short-text">' + d + '</p></option>')
            });
        });
    },
    "autoWidth":false,
    "columnDefs": [
        { "width": "20%", "targets": 1}
    ]
});

$('a.toggle-vis').on('click', function (e) {
    e.preventDefault();

    // Get the column API object
    var column = table.column($(this).attr('data-column'));

    // Toggle the visibility
    column.visible(!column.visible());
});
