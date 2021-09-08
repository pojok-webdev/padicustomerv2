var TableManaged = function () {
    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }
            // begin first table
            $('#tuncategorized').dataTable({
                "aoColumns": [
                  { "bSortable": true },
                  { "bSortable": false },
                  null,
                  { "bSortable": false },
                  null,
                  { "bSortable": false },
                  { "bSortable": false },
                  { "bSortable": false }
                ],
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });

            jQuery('#tuncategorized_wrapper .dataTables_filter input').addClass("m-wrap medium"); // modify table search input
            jQuery('#tuncategorized_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
            //jQuery('#tuncategorized_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
        }

    };

}();