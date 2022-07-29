// data table js start
$(window).on('load', function() {
    $(".loader-wrap").fadeOut("slow");
});
// data table js end

$(document).ajaxComplete(function() {
    $('[data-toggle="tooltip"]').tooltip({
        html: true,
        delay: {
            show: 1000,
            hide: 0,
        },
    });
});

$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

//   $('a').tooltip({placement: 'bottom',trigger: 'manual'}).tooltip('show');

$(".menu-button").click(function() {
    $(this).toggleClass("open");
    $("body").toggleClass("open");
    jQuery(".sub-menus").slideUp();
});
$(" .mob-open").click(function() {
    $("body").addClass("open");
});
jQuery(".overlay-close").click(function() {
    jQuery(".menu-button, body").removeClass("open");
    jQuery(".sub-menus").slideUp();
});

//
var nav = $(".side-menu > li, .cus-menu > li, .user-drop-sec li");
nav.find("ul").hide();
nav.click(function() {
    nav.not(this).find("ul").hide();
    $(this).find("ul").slideToggle();
    $(".side-menu > li, .cus-menu > li, .user-drop-sec li").removeClass(
        "active"
    );
    $(this).addClass("active");
    var a = new Date().getFullYear();
    var b = a - 1;
    var c = b + "-" + a;
    console.log(c);
});


$(document).ready(function() {
    $('.promote-student').hide();
    var table = $(".studenttable").DataTable({
        select: {
            style: "multi",
            selector: ".select-checkbox",
            items: "row",
        },
        language: {
            search: "",
            searchPlaceholder: "Search student...",
        },
        responsive: {
            details: {
                type: "column",
                target: 0,
            },
        },
        columnDefs: [{
                targets: 0,
                className: "control",
            },
            {
                targets: 1,
                className: "select-checkbox",
            },
            {
                targets: [0, 1],
                orderable: false,
            },
            {
                responsivePriority: 2,
                targets: -1,
            },
        ],
        lengthMenu: [
            [6, 10, 50, -1],
            [6, 10, 50, "All"],
        ],
        order: [2, "asc"],
        "bDestroy": true,
        dom: 'lBfrtip',
        buttons: [
            'csv'
        ],
        stateSave: true,
    });

    $('body').on('click', '.select-checkbox', function() {
        if ($('#result tr').hasClass('selected')) {
            $('.promote-student').show();
            var myString = $('.select-item').html();

            $('form#frm-example').css('margin-bottom', '70px');
        } else {
            $('.promote-student').hide();
            $('form#frm-example').css('margin-bottom', '');
        }
        $(this).toggleClass('selected');
    })

    $("#frm-example").on("submit", function(e) {
        var selectedIds = [];
        for (var i = 0; i < table.rows('.selected').data().length; i++) {
            selectedIds.push(table.rows('.selected').data()[i][0]);
        }
        var form = this;
        var row = JSON.stringify(selectedIds);
        $("#promote").val(row);
    });

    $("#table-filter").on("change", function() {
        table.search(this.value).draw();
    });
});

$(".table").DataTable({
    columnDefs: [{
        width: 0,
        targets: 0,
    }, ],
    lengthMenu: [
        [5, 10, 50, -1],
        [5, 10, 50, "All"],
    ],
    bInfo: false,
    oLanguage: {
        sEmptyTable: "No data available in table",
        sSearch: "",
        sPlaceholder: "Search Here",
        sZeroRecords: "No matching records found",
    },
    info: true,
    language: {
        search: "",
        searchPlaceholder: "Search...",
    },
    "bDestroy": true
});


var table = $(".custom-table").DataTable({
    language: {
        search: "",
        searchPlaceholder: "Search...",
    },
    "bDestroy": true,
    lengthMenu: [
        [5, 10, 50, -1],
        [5, 10, 50, "All"],
    ],


});





var table = $("#fees-table").DataTable({
    language: {
        search: "",
        searchPlaceholder: "Search...",
    },
    lengthMenu: [
        [5, 10, 50, -1],
        [5, 10, 50, "All"],
    ],
    "bDestroy": true
});

// $(function () {
//     $('.select-checkbox').click(function () {
//         $('.studenttable tr').each(function () {
//             if ('') {

//             } else {

//             }
//         });

//     })
// });


// $(function () {
//     $('.select-checkbox').click(function () {
//         if ($(this).hasClass('selected')) {
//             console.log('yes');
//         } else {
//             console.log('no');
//         }
//     })
// });