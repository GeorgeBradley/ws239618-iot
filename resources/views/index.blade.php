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

//LINE CHART

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawCurveTypes);

function drawCurveTypes() {
      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Outside Temperature');
      data.addColumn('number', 'Inside Temperature');

      data.addRows([
        [0, 0, 0]
      ]);

      var options = {
        hAxis: {
          title: 'Time'
        },
        vAxis: {
          title: 'Popularity'
        },
        series: {
          1: {curveType: 'function'}
        }
      };

      var linechart = new google.visualization.LineChart(document.getElementById('line-chart'));
      linechart.draw(data, options);
    }
 </script>


<body>


<header class="primary-header">

    <h1 class="main-title">WS239618-IoT</h1>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
  </form>
 
</header>

    <section class="status-group container">
       
        <div class="icon-container heating">
            <span class="icon fa-solid fa-fire"></span>
            <h3>Heating On</h3>
        </div>
        
        <div class="icon-container active">
            <span class="icon fa-solid fa-power-off"></span>
            <h3>Off</h3>
        </div>
        <div class="icon-container active">
            <span class="icon fa-solid fa-door-open"></span>
          
            <h3>Window Open</h3>
        </div>
        <div class="icon-container">
            <span class="icon fa-solid fa-fan"></span>
            <h3>Ventilation On</h3>
        </div>
        
        <div class="icon-container cold">
            <span class="icon fa-solid fa-snowflake"></span>
            <h3>Air Conditioning On</h3>
        </div>
        
    </section>

    
    <div class="group container">
        <aside class="left-sidebar">
          <h1 id="inside-temp-reading" class="temp-reading"></h1>
          <small>Last updated: <span id="last-updated-inside-temp"></span></small>
            <div class="circle">
                <div id="chart-1" ></div>
            </div>
            <div class="circle">
              <h1 id="outside-temp-reading" class="temp-reading">32</h1>
              <small>Last updated: <span id="last-updated-outside-temp"></span></small>
              <div id="chart-2"></div>

          </div>
          
        </aside>
        
    
        <section class="centre">
     
          <div id="line-chart"></div>
        </section>

    </div>
    
    <div class="content">

    </div>


<footer>
    <p>WS239618 &copy; 2022</p>
</footer>    

   <script>
 

   
     
    
  </script>
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

  <script>
    
    function getMessage() {
     
     $.ajax({
        type:'GET',
        url:'/msg',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
           $("#inside-temp-reading").text(data.insideTemperature[0].temperature);
           $("#last-updated-inside-temp").text(data.insideTemperature[0].last_updated);
           $("#outside-temp-reading").text(data.outsideTemperature[0].temperature);
           $("#last-updated-outside-temp").text(data.outsideTemperature[0].last_updated);
        },
       
     });
  }
        $(document).ready( function() {

          getMessage();
          
      
      });
    </script>
</body>
</html>