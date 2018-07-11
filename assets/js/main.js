$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    
    $('.uts').editable({
        type: 'text', 
        validate: function(value) {
            if ($.isNumeric(value) == '') {
                return 'Hanya boleh diisi dengan angka';
            }
        }
    });
    $('.uas').editable({
        type: 'text', 
        validate: function(value) {
            if ($.isNumeric(value) == '') {
                return 'Hanya boleh diisi dengan angka';
            }
        }
    });
    $('.tugas').editable({
        type: 'text', 
        validate: function(value) {
            if ($.isNumeric(value) == '') {
                return 'Hanya boleh diisi dengan angka';
            }
        }
    });
    $('.grade').editable({
        type: 'text', 
        validate: function(value) {
            if ($.isNumeric(value) == '') {
                return 'Hanya boleh diisi dengan angka';
            }
        }
    });

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

    $('#data_nilai').DataTable({
        "order": [[ 3, "desc" ]],
        "info": false
    });

    $('.select2').select2();

    
    
    
});

