// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.dataTable').DataTable(
          {
    dom: 'Bfrtip',
    buttons: [
            { extend: 'create', editor: editor },
            { extend: 'edit',   editor: editor },
            { extend: 'remove', editor: editor },
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]}],

    language: {
            "lengthMenu": "показ _MENU_ записей",
            "zeroRecords": "Данных нет",
            "info": "страница _PAGE_ из _PAGES_",
            "infoEmpty": "данных нет",
            "infoFiltered": "(найдено в _MAX_ записях)"
        }
}
          );
});
