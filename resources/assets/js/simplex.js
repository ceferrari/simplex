$(document).ready(function() {
    $("input[type=text]").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter, - and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 109, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $("#operations .btn").click(function() {
        $("#operation").val($(this).find(":input").val());
    });

    var name = location.pathname.split('/').slice(-1)[0];
    if (name == 'variables' || name == 'solution') {
        document.getElementById("solucao").className += " disabled";
    }
    if (name == 'solution') {
        document.getElementById("proximo").className += " disabled";
    }
});
