/* 
 * código js para exportar la tabla de tareas de los empleados
 */


//cuando se pulsa acceder se compueba con ajax el método del controlador check
$(document).ready(function(){   

    //Cuando el formulario con ID acceso se envíe...
    $("#btnExport").on("click", function (event) {
        
       exportTableToCSV('tabla_tareas.csv');
        
    });
    
});



//coge los datos CSV y genera un enlace donde descargar los datos de la tabla HTML 
//en un archivo CSV. 
function downloadCSV(csv, filename) {
    
    
    var csvFile;//variable para guardar el archivo csv
    var link;//varibale para guardar el link donde descargar el csv

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"}); //objeto Blob representa un objeto tipo fichero de datos planos inmutables. 

    // Download link
    link = document.createElement("a");
   

    // File name
    link.download = filename;

    // Create a link to the file
    link.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    link.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(link);

    // Click download link
    link.click();
}

//crea los datos CSV a partir de una tabla HTML y transforma dicha información
// en un fichero utilizando la función downloadCSV().
function exportTableToCSV(filename) {
    
    var csv = [];
    var rows = document.querySelectorAll("#table1 tr"); //guarda todas las filas de la tabla id=table1
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 1; j < cols.length-1; j++) //quito la primera columna de la foto y la última estado
            row.push(cols[j].innerText);
        
        csv.push(row.join(";")); //separar las celdas
        //join() une todos los elementos de una matriz (o un objeto similar a una matriz)
        // en una cadena y devuelve esta cadena
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

