$(document).ready(function() {
    var name = location.pathname.split('/').slice(-1)[0];
    if (name != 'table') {
        $("#solucao").addClass("disabled");
    }
    if (name != 'table' || (name == 'table' && $("input[name='twoPhases']").val() == 'true')) {
        $("#showMarkings").addClass("disabled");
    }
    if (name == 'sensitivity' || $("#notOptimal").length) {
        $("#proximo").addClass("disabled");
    }

    $("input[type=text]").keydown(function(e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 109, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            (e.keyCode == 88 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $(".disabled").click(function(e) {
        e.preventDefault();
    });

    $("#objectives .btn").click(function() {
        $("#objective").val($(this).find(":input").val());
    });

    $(".operator").on('change', function() {
        var twoPhases = false;
        $(".operator").each(function() {
            if ($(this).val() != 'less') {
                twoPhases = true;
            }
        });
        $("input[name='twoPhases']").val(twoPhases);
    });

    var table = new Array();
    var fractions = new Array();
    $("td").each(function() {
        table.push($(this).text());
        var n = Number($(this).text());
        if (n === +n && n !== (n | 0)) {
            fractions.push(toFraction(n));
        } else {
            fractions.push($(this).text());
        }
    })

    $("#toFractions").not('.disabled').on('click', function() {
        var i = 0;
        if (!$(this).hasClass('active')) {
            $("td").each(function() {
                $(this).text(fractions[i++]);
            });
        } else {
            $("td").each(function() {
                $(this).text(table[i++]);
            });
        }
        if (name == 'table') {
            $("td:first-child").each(function() {
                $(this).html('<b>'+$(this).text()+'</b>');
            });
        }
        toggleCheckbox($(this));
    });

    function toFraction(x) {
        var tol = 1.e-13, neg = 1;
        var h1 = 1, h2 = 0;
        var k1 = 0, k2 = 1;
        if (x < tol && x > -tol) {
            return 0;
        }
        if (x < 0) {
            neg = -1;
            x *= neg;
        }
        var b = x;
        do {
            a = Math.floor(b);
            h1 = [a * h1 + h2, h2 = h1][0];
            k1 = [a * k1 + k2, k2 = k1][0];
            b = 1 / (b - a);
        } while (Math.abs(x - h1 / k1) > x * tol);
        return (k1 == 1) ? h1 * neg : h1 * neg + " / " + k1;
    }

    $("#showMarkings").not('.disabled').on('click', function() {
        if (!$(this).hasClass('active')) {
            $(".unmarked").each(function() {
                $(this).addClass('marked');
                $(this).removeClass('unmarked');
            });
        } else {
            $(".marked").each(function() {
                $(this).addClass('unmarked');
                $(this).removeClass('marked');
            });
        }
        toggleCheckbox($(this));
    });

    if (!$("#showMarkings").hasClass('disabled') && name == 'table') {
        (function defineMarks() {
            var last = $("tr:first-child td:last-child").index();
            var col, min = Number.MAX_VALUE;
            $("tr:last-child td").each(function() {
                if ($(this).index() != last) {
                    var val = parseFloat($(this).text());
                    if (val < min) {
                        min = val;
                        col = $(this).index() + 1;
                    }
                }
            });
            if (min < 0) {
                var row, min = Number.MAX_VALUE
                $("table tbody tr").each(function() {
                    var x = parseFloat($(this).find("td:last-child").text());
                    var y = parseFloat($(this).find("td:nth-child("+col+")").text());
                    if (y > 0 && $(this).find("td:first-child").text() != 'Z') {
                        var val = x / y;
                        if (val < min) {
                            min = val;
                            row = $(this).index() + 1;
                        }
                    }
                });
                if (min < Number.MAX_VALUE) {
                    $("table tbody tr:nth-child("+row+")").addClass('unmarked');
                    $("table tr th:nth-child("+col+"),td:nth-child("+col+")").each(function() {
                        $(this).addClass('unmarked');
                    });
                    return;
                }
            }
            $("#showMarkings").addClass("disabled");
        })();
    }

    function toggleCheckbox(e) {
        var $checkbox = e.find(':checkbox');
        $checkbox.attr('checked', !$checkbox.attr('checked'));
    }

    if ($("input[name='showMarkingsOn']").val() == 'on') {
        $("#showMarkings").click();
    }
    if ($("input[name='toFractionsOn']").val() == 'on') {
        $("#toFractions").click();
    }
});
