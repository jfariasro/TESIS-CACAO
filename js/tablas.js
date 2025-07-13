function Cargar() {
    $(function () {
        $(document).ready(function() {
            $('#example2').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.1/i18n/es_es.json"
                },
                "autoWidth": true
            });
        });
    });
    $(function () {
        $(document).ready(function() {
            $('#example1').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.1/i18n/es_es.json"
                },
                "autoWidth": true,
                "order": [[1, "desc"]]  // Ordena por la primera columna de forma descendente
            });
        });
    });
    
}

Cargar();