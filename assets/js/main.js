$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    
    $('.uts').editable();
    $('.uas').editable();
    $('.tugas').editable();
    $('.grade').editable();

    $('.semester').editable();


    $.extend( $.fn.dataTable.defaults, {
        "language": {
            "paginate": {
            "previous": "Kembali",
            "next": "Selanjutnya"
            },
            "search": "Cari",
            "zeroRecords": "Data tidak ditemukan",
            "emptyTable": "Tidak ada data"
        },
        "info": false,
        "lengthChange": false
    });

    $('#data').DataTable({
        "ordering": true,
        columnDefs: [{
          orderable: false,
          targets: "no-sort"
        }]
    });
});