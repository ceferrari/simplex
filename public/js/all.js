$(document).ready(function() {
    $("input[type=text]").keydown(function (e) {
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

    $("#objectives .btn").click(function() {
        $("#objective").val($(this).find(":input").val());
    });

    $(".operator").on('change', function() {
        var twoPhases = false;
        $(".operator").each(function() {
            if (this.value != 'less') {
                twoPhases = true;
            }
        });
        $("input[name='twoPhases']").val(twoPhases);
    });

    var table = new Array();
    $("td").each(function() {
        table.push(this.innerText);
    });

    $("#toFractions").on('click', function() {
        if (!$(this).hasClass('active')) {
            $("td").each(function() {
                var n = Number(this.innerText);
                if (n === +n && n !== (n|0)) {
                    this.innerText = toFraction(n);
                }
            });
        }
        else {
            var i = 0;
            $("td").each(function() {
                this.innerText = table[i++];
            });
        }
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
        return  (k1 == 1) ? h1*neg : h1*neg + " / " + k1;
    }

    var name = location.pathname.split('/').slice(-1)[0];
    if (name != 'table') {
        document.getElementById("solucao").className += " disabled";
    }
    if (name == 'solution') {
        document.getElementById("proximo").className += " disabled";
    }
});

//# sourceMappingURL=all.js.map
