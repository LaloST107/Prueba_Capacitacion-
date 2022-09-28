$("#btnColumnas").click(function(){
    columnas();
});
$("#btnLineas").click(function(){
    lineas();
});
$("#btnTorta").click(function(){
    $(".modal-header").css("background-color", "#343a40");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Gráfico de Torta");
    $("#modal-1").modal("show");
    torta();
});
$("#btnPrueba").click(function(){
    $(".modal-header").css("background-color", "#dc3545");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Gráfico de pruebas");
    $("#modal-1").modal("show");
    prueba();
});


var chart1, options;
$("#btnBD").click(function(){
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Perros");
    $("#modal-1").modal("show");

    $.ajax({
        url:"datos/graficos.php",
        type: "POST",
        dataType:"json",
        success:function(data){
            options.series[0].data = data;
            chart1 = new Highcharts.Chart(options);
            console.log(data);
        }
    })
    datos();
});

function datos(){
    var v_modal = $("#modal_1").modal({show: false});
    options = {
        chart:{
            renderTo: 'contenedor-modal',
            type: 'column'
        },
        title:{
            text: 'Cantidad De Raza De Perros'
        },
        xAxis:{
            type: 'category'
        },
        yAxis:{
            title:{
                text: ' Cantidad'
            }
        },
        plotOptions: {
            series:{
                borderWidth:1,
                dataLabels:{
                    enabled:true,
                    format:'{point.y:.0f}'
                }
            }
        },
        tooltip:{
            headerFormat:"<span style='font-size:11px'> {series.name}</span><br>",
            pointFormat: "<span style='color:{point.color}'>{point.name}</span>: <b>{point.y:.0f}</b>"
        },
        series:[{
            name: "Perros",
            colorByPoint:true,
            data:[],
        }]
    }
    v_modal.on("shown",function(){});
    v_modal.modal("show");
}



function prueba(){
//1era forma
/*
Highcharts.chart('contenedor-modal', {
 chart:{
     type: 'line'
 },
    title:{
        text:'Valores mensuales'
    },
    xAxis:{
        categories:['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
    },
    series:[{
        data: [2,3,4,6,7,9,6,4,3,2,1,5]
    }],
});
*/

//2da forma
/*Highcharts.chart('contenedor-modal',{
    xAxis:{
        minPadding:0.05,
        maxPadding:0.05
    },
    series:[{
        data:[
            [0, 29.9],
            [1, 71.5],
            [3, 106.4]
        ]
    }]
});  */

//3era forma
Highcharts.chart('contenedor-modal',{
   chart: {
        type:'column'
   },
   xAxis:{
       categories: ['Rojo', 'Verde', 'Negro']
   },
   series:[{
        data:[
        {
           name:'Color 1',
           color:'#ff0031',
           y:10
        },
        {
          name:'Color 2',
           color:'#28a745',
           y:3
        },
        {
           name:'Color 3',
           color:'blak',
           y:5
        }]
   }]
});

}
