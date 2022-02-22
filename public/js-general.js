$(document).ready(function() {
    $('#filtro').keyup(function() {
        var rex = new RegExp($(this).val(), 'i');
        $('#bodytable tr').hide();
        $('#bodytable tr').filter(function() {
            return rex.test($(this).text());
        }).show();
    })
});
const format = (number) => new Intl.NumberFormat("de-DE").format(number)

function setFiltro(id_input_filtro, id_tabla) {
    $(`#${id_input_filtro}`).keyup(function() {
        var rex = new RegExp($(this).val(), 'i');
        $(`#${id_tabla} tbody tr`).hide();
        $(`#${id_tabla} tbody tr`).filter(function() {
            return rex.test($(this).text());
        }).show();
    })
}

function buscar(caracteres) {
    console.log(caracteres)
    if (caracteres.length > 3) {
        url = "/tercero/buscar/" + caracteres
        $.get(url, (response) => {
            var resultados = ""
            if (response.length > 0) {
                response.forEach((tercero) => {
                    resultados += "<a class='dropdown-item media' href='/tercero/view/" + tercero.id_tercero + "'><b>" + tercero.identificacion + " - " + tercero.nombres + " " + tercero.apellidos + "</b></a>"
                })
                if (resultados != "") {
                    $("#div_busqueda").html(resultados)
                    $("#div_busqueda").fadeIn()
                } else {
                    $("#div_busqueda").html("")
                    $("#div_busqueda").fadeOut()
                }
            } else {
                $("#div_busqueda").html("")
                $("#div_busqueda").fadeOut()
            }
        })
    } else {
        $("#div_busqueda").html("")
        $("#div_busqueda").fadeOut()
    }
}

function Loading(show = true, message = "Por favor espere...") {
    if (show) {
        $.blockUI({
            message: `<i class="fa fa-spinner mt-3 fa-spin fa-5x fa-fw" style="color: #ffffff;"></i><h1><b>${message}</b></h1>`,
            css: {
                border: 'none',
                padding: '70px 5px 30px 5px',
                backgroundColor: 'transparent',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: 1,
                color: '#ffffff'
            }
        });
    } else {
        $.unblockUI();
    }
}

function Format(number) {
    return new Intl.NumberFormat("de-DE").format(number);
}