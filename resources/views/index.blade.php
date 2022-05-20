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


   google.charts.setOnLoadCallback(function load(){
    $.ajax({
        type:'GET',
        url:'/msg',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
          drawChart(data);
        },
       
     });
      
   });
   google.charts.setOnLoadCallback(function load(){
    $.ajax({
        type:'GET',
        url:'/msg',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
          drawChart2(data);
        },
       
     });
   });

 
   function drawChart(dataParam) {
    
    
     var data = google.visualization.arrayToDataTable([
       ['Label', 'Value'],
       ['Inside', parseInt(dataParam.insideTemperature[0].temperature)]
     ]);

     var options = {
       width: '100%', height: '100%',
       redFrom: 90, redTo: 100,
       yellowFrom:75, yellowTo: 90,
       minorTicks: 5
     };
     var chart = new google.visualization.Gauge(document.getElementById('chart-1'));
     
     

     chart.draw(data, options);

     setInterval(function load() {

  
      $.ajax({
        type:'GET',
        url:'/msg',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(successData) {
          
          data.setValue(0, 1, parseInt(successData.insideTemperature[0].temperature));
          chart.draw(data, options);
        },
       
     });

       
     }, 2000);
    
   }
 
  function drawChart2(dataParam) {

  var data = google.visualization.arrayToDataTable([
  ['Label', 'Value'],
  ['Outside', parseInt(dataParam.outsideTemperature[0].temperature)],


]);

var options = {
  width: '100%', height: '100%',
  redFrom: 90, redTo: 100,
  yellowFrom:75, yellowTo: 90,
  minorTicks: 5
};
var chart = new google.visualization.Gauge(document.getElementById('chart-2'));



chart.draw(data, options);

setInterval(function load() {
  $.ajax({
        type:'GET',
        url:'/msg',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(successData) {

          data.setValue(0, 1, parseInt(successData.outsideTemperature[0].temperature));
          chart.draw(data, options);
        },
       
     });
}, 2000);

}

//LINE CHART


var visitor = <?php echo $visitor; ?>;

console.log(visitor);

google.charts.load('current', {'packages':['corechart']});

google.charts.setOnLoadCallback(lineChart);

function lineChart() {

  var data = google.visualization.arrayToDataTable(visitor);

  var options = {

    title: 'Daily Temperature Average',

    curveType: 'function',

    legend: { position: 'bottom' }

  };

  var chart = new google.visualization.LineChart(document.getElementById('linechart'));

  chart.draw(data, options);

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
            <h3>Heating <span class="heating-status">Off</span></h3>

            <form action="" method="POST">
              <div class="toggle-heating toggle button r center">
              <input type="checkbox" class="checkbox">
              <div class="knobs"></div>
              <div class="layer"></div>
              </div>
              </form>
           
        </div>
        
        
        <div class="icon-container window">
            <span class="icon fa-solid fa-door-open"></span>
          
            <h3>Window <span class="window-status">Closed</span></h3>
            <form action="" method="POST">
              <div class="toggle-window toggle button r center">
            <input type="checkbox" class="checkbox">
            <div class="knobs"></div>
            <div class="layer"></div>
          </div>
              </form>
           
        </div>
        <div class="icon-container vent">
            <span class="icon fa-solid fa-fan"></span>
            <h3>Ventilation <span class="fan-status">Off</span></h3>

            <form action="" method="POST">
              <div class="toggle-fan toggle button r center">
              <input type="checkbox" class="checkbox">
              <div class="knobs"></div>
              <div class="layer"></div>
          </div>
              
              </form>
            
        </div>
        
        <div class="icon-container air-con">
            <span class="icon fa-solid fa-snowflake"></span>
            <h3>Air Conditioning <span class="air-con-status">Off</span></h3>
            <form action="" method="POST">
              <div class="toggle-ac toggle button r center">
            <input type="checkbox" class="checkbox">
            <div class="knobs"></div>
            <div class="layer"></div>
          </div>
              
              </form>
           
        </div>
        
    </section>

    
    <div class="group container color-white">
        
         
          <div class="bg-color-red">
            <div class="icon-container power">
            <span class="icon fa-solid fa-power-off"></span>
            <h3>Outside Temperature <span class="outside-power-status">Off</span></h3>

            <form action="" method="POST">
              <div class="toggle-outside-temp toggle button r center">
            <input type="checkbox" class="checkbox">
            <div class="knobs"></div>
            <div class="layer"></div>
          </div>
              
              </form>
            
        </div>
          <h1 id="inside-temp-reading" class="center-text"><span class="temp">32</span>°C</h1>
          <small>Last updated: <strong><span id="last-updated-inside-temp" class=""></span></strong></small>
            <div class="circle center-text">
                <div id="chart-1" ></div>
            </div>
          </div>
          <div class="bg-color-blue">
            <div class="icon-container power">
            <span class="icon fa-solid fa-power-off"></span>
            <h3>Inside Temperature <span class="inside-power-status">Off</span></h3>
            <form action="" method="POST">
              <div class="toggle-inside-temp toggle button r center">
            <input type="checkbox" class="checkbox">
            <div class="knobs"></div>
            <div class="layer"></div>
              
              </form>
            
          </div>
            </div>
            <div class="div">
              <h1 id="outside-temp-reading" class="center-text"><span class="temp">32</span>°C</h1>
   
              </div>
            
              <small>Last updated: <strong><span id="last-updated-outside-temp" class=""></span></strong></small>
            <div class="circle center-text">
              
              <div id="chart-2"></div>
            </div>
      </div>
          
       
        
    
       

    </div>
  
    

    <section class="container flex">
     
      <div class="item">
        <div id="linechart"></div>
        </div>
  
   </section>
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
    
    function formatDate(date){
      return formatted_date = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds() 
      
    }
    function passedTimeGreaterThan(date, checkSeconds){
      
      let currentDate = new Date();
      let lastUpdated = new Date(date);
      let ms = currentDate.getTime() - lastUpdated.getTime();
      let seconds = ms / 1000;

  
 

      if( checkSeconds < seconds) {
        return true;
      } else {
        return false;
      }
    }
    function getMessage() {
      setInterval(function run(){
     $.ajax({
        type:'GET',
        url:'/msg',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
       
          let insideTemperatureLastUpdated = new Date(data.insideTemperature[0].last_updated);
          let outsideTemperatureLastUpdated = new Date(data.outsideTemperature[0].last_updated);

           $("#inside-temp-reading .temp").text(data.insideTemperature[0].temperature);
           $("#last-updated-inside-temp").text(formatDate(insideTemperatureLastUpdated));
            
           $("#outside-temp-reading .temp").text(data.outsideTemperature[0].temperature);
           $("#last-updated-outside-temp").text(formatDate(outsideTemperatureLastUpdated));

           if(passedTimeGreaterThan(insideTemperatureLastUpdated, 2000)) 
           {
            $(".inside-power-status").text("Off");
        
           } else 
           {
            $(".inside-power-status").text("[Active]");
            $(".toggle-inside-temp .checkbox").prop('checked', true)
           }
           if(passedTimeGreaterThan(outsideTemperatureLastUpdated, 2000)) 
           {
            $(".outside-power-status").text("Off");
            $(".toggle-outside-temp .checkbox").prop('checked', false);
           
            
           } else {
           
            $(".outside-power-status").text("[Active]");
            $(".toggle-outside-temp .checkbox").prop('checked', true);
           }
        },
       
     });

     }, 2000);
  }
  
  function getMessage2() {


    setInterval(function run(){

      $.ajax({
        type:'GET',
        url:'/msgtwo',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
         
          let windowStatus = data.statuses[0].s_window;
          let heatingStatus = data.statuses[0].s_heating;
          let airConStatus = data.statuses[0].s_ac;
          let ventStatus = data.statuses[0].s_vent;
          let powerStatus = data.statuses[0].s_power;
          if (powerStatus != 1) {
            $(".power").removeClass('power-active');
            $(".power-status").text("Off");
          } else {
            $(".power").addClass('power-active');
            $(".power-status").text("On");
          }
          if (windowStatus != 1) {
            $(".window").removeClass('window-opened-active');
            $(".window-status").text("Closed");
          } else {
            $(".window").addClass('window-opened-active');
            $(".window-status").text("Opened");
          }

          if (heatingStatus != 1) {
            $(".heating").removeClass('heating-active');
            $(".heating-status").text("Off");
          } else {
            $(".heating").addClass('heating-active');
            $(".heating-status").text("On");
          }
          if (airConStatus != 1) {
            $(".air-con").removeClass('air-con-active');
            $(".air-con-status").text("Off");
          } else {
            $(".air-con").addClass('air-con-active');
            $(".air-con-status").text("On");
          }
          if (ventStatus != 1) {
            $(".vent").removeClass('vent-active');
            $(".vent-status").text("Off");
          } else {
            $(".vent").addClass('vent-active');
            $(".vent-status").text("On");
          }
        },
       
     });
  
    }, 2000);
  
   
  }
        $(document).ready( function() {

          getMessage();
          getMessage2();
      
      });
    </script>
</body>
</html>