$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    
    $('.uts').editable();
    $('.uas').editable();
    $('.tugas').editable();
    $('.grade').editable();
});