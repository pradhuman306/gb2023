// data table js start

// data table js end
$(document).ready(function() {
    $(".menu-button").click(function() {
        $(this).toggleClass("open");
        $("body").toggleClass("open");
        jQuery('.sub-menus').slideUp();
    });
    $(" .mob-open").click(function() {
        $("body").addClass("open");
    });
    jQuery(".overlay-close").click(function() {
        jQuery(".menu-button, body").removeClass("open");
        jQuery('.sub-menus').slideUp();
    });

    // 
    var nav = $('.side-menu > li, .cus-menu > li, .user-drop-sec li');
    nav.find('ul').hide();
    nav.click(function() {
        nav.not(this).find('ul').hide();
        $(this).find('ul').slideToggle();
        $('.side-menu > li, .cus-menu > li, .user-drop-sec li').removeClass('active');
        $(this).addClass('active');
        var a = new Date().getFullYear();
        var b = a - 1;
        var c = b + "-" + a;
        console.log(c);
    });
});

$(document).ready(function() {
    var table = $('.studenttable').DataTable({
        //disable sorting on last column
        //   "scrollY": 500,
        "scrollX": true,
        "columnDefs": [
            { width: 0, "targets": 0 }
        ],
        "lengthMenu": [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
        ],
        dom: 'lBfrtip',

        buttons: [
            'csv'
        ],
        "bInfo": false,
        "scrollX": true,
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }],
        'select': {
            'style': 'multi',
            'selector': 'td:first-child'
        },
        'order': [
            [1, 'asc']
        ],
        "oLanguage": {
            "sEmptyTable": "No data available in table",
            "sSearch": "",
            "sPlaceholder": "Search Here",
            "sZeroRecords": "No matching records found",
        },
        "info": true,
    });

    $('#frm-example').on('submit', function(e) {
        var form = this;
        var rows_selected = table.column(0).checkboxes.selected();
        $b = [];
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId) {
            $b.push(rowId);

        });
        var row = JSON.stringify($b);
        $('#promote').val(row);
        e.preventDefault();
    });


});


//
$(document).ready(function() {

    $('#table-filter').on('change', function() {
        table.search(this.value).draw();
    });

    $('.table').DataTable({
        // "scrollY": 500,
        "scrollX": true,
        "columnDefs": [
            { width: 0, "targets": 0 }
        ],
        "lengthMenu": [
            [10, 50, 100, -1],
            [10, 50, 100, "All"]
        ],
        "bInfo": false,
        // 'order': [
        //     [1, 'asc']
        // ],
        "oLanguage": {
            "sEmptyTable": "No data available in table",
            "sSearch": "",
            "sPlaceholder": "Search Here",
            "sZeroRecords": "No matching records found",
        },
        "info": true,

    })
});

$(document).ready(function() {

    // DataTables initialisation
    var table = $('.custom-table').DataTable();
 
    // Refilter the table
    // $('#min, #max').on('change', function () {
    //     table.draw();
    // });
});