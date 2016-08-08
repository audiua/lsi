$( document ).ready(function() {

    // init datatable
    if ($('.datatable').length) {
        $('.datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    }
});
