var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
        base64 = function(s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        },
        format = function(s, c) {
            return s.replace(/{(\w+)}/g, function(m, p) {
                return c[p];
            })
        }
    return function(table, name = 'Informe') {
        console.log(name)
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {
            worksheet: name || 'Worksheet',
            table: table.innerHTML
        }
        console.log(ctx)
        //window.location.href = uri + base64(format(template, ctx))
        var downloadLink;
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        // Create a link to the file
        downloadLink.href = uri + base64(format(template, ctx))
        // Setting the file name
        downloadLink.download = name + '.xls';
        //triggering the function
        downloadLink.click();
    }
})()
/*function tableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    // Specify file name
    filename = filename ? filename + '.xls' : 'Informe.xls';
    // Create download link element
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        // Setting the file name
        downloadLink.download = filename;
        //triggering the function
        downloadLink.click();
    }
}*/
function borrarColumna(idTabla, numeroColumna) {
    var fila;
    fila = document.getElementById(idTabla).getElementsByTagName('tr');
    ultimaColumna = fila.length - 1
    for (var i = 0; i <= ultimaColumna; i++) {
        var f = fila[i].getElementsByTagName('td')[numeroColumna];
        f.innerHTML = ""
    }
}