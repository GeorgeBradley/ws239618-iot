<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>WS239618 -  IoT Home</title>

</head>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
   google.charts.load('current', {'packages':['gauge']});
   google.charts.setOnLoadCallback(drawChart);
   google.charts.setOnLoadCallback(drawChart2);
   function drawChart() {

     var data = google.visualization.arrayToDataTable([
       ['Label', 'Value'],
       ['Inside', 80],
     ]);

     var options = {
       width: '100%', height: '100%',
       redFrom: 90, redTo: 100,
       yellowFrom:75, yellowTo: 90,
       minorTicks: 5
     };
     var chart = new google.visualization.Gauge(document.getElementById('chart-1'));
     
     

     chart.draw(data, options);

     setInterval(function() {
       data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
       chart.draw(data, options);
     }, 13000);
     setInterval(function() {
       data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
       chart.draw(data, options);
     }, 5000);
     setInterval(function() {
       data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
       chart.draw(data, options);
     }, 26000);
   }
 
   function drawChart2() {

var data = google.visualization.arrayToDataTable([
  ['Label', 'Value'],
  ['Outside', 80],


]);

var options = {
  width: '100%', height: '100%',
  redFrom: 90, redTo: 100,
  yellowFrom:75, yellowTo: 90,
  minorTicks: 5
};
var chart = new google.visualization.Gauge(document.getElementById('chart-2'));



chart.draw(data, options);

setInterval(function() {
  data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
  chart.draw(data, options);
}, 13000);
setInterval(function() {
  data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
  chart.draw(data, options);
}, 5000);
setInterval(function() {
  data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
  chart.draw(data, options);
}, 26000);
}
 </script>
<body>

<main class="main-content">
<section class="temperatures-section">
    <h1 class="main-title">WS239618-IoT</h1>
    <div class="container">
        <div class="temperatures">
            <div class="status-group">
      
                <div class="icon-container heating">
                    <span class="icon fa-solid fa-fire"></span>
                    <h3>Heating</h3>
                </div>
                
                <div class="icon-container active">
                    <span class="icon fa-solid fa-power-off"></span>
                    <h3>Off</h3>
                </div>
                <div class="icon-container">
                    <span class="icon fa-solid fa-fan"></span>
                    <h3>Ventilation</h3>
                </div>
                
                <div class="icon-container cold">
                    <span class="icon fa-solid fa-snowflake"></span>
                    <h3>A/C</h3>
                </div>
                
            </div>
           <div class="circle">
                <div id="chart-1" ></div>
            </div>
            <div class="circle">
                <div id="chart-2" ></div>
            </div>

           
    </div>
    
</section>    
       

<section class="indicators">

<div class="container">

   

</div>

</section>


<footer>
    <p>WS239618 &copy; 2022</p>
</footer>    
</main>

    
</body>
</html>