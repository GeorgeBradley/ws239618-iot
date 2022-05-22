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

// console.log(visitor);

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


    
      


  
<div class="container flex gap-1">
            <h2>Automatic Mode <span class="automatic-mode-status"></span></h2>
            <div class="toggle-manual-automatic toggle button r center">
            <input type="checkbox" class="checkbox" id ="automatic-manual-toggle">
            <div class="knobs"></div>
            <div class="layer"></div>
          </div>
              
</div> 



   
    <section class="status-group container">
   
      <div class="color-key-reference">
<h2>RGB Key</h2>
        <div class="color-key-reference-body">
          <div class="color-key">
    <div class="color-box bg-orange"></div>
      <h3>Heating</h3>
    </div>

    <div class="color-key">
    <div class="color-box bg-green"></div>
      <h3>Window</h3>
    </div>

    <div class="color-key"> 
    <div class="color-box bg-darkerBlue"></div>
      <h3>Fan</h3>
    </div>
 
    <div class="color-key">
      <div class="color-box bg-lightBlue"></div>
      <h3>Air Con</h3>
    </div>
          
          </div>
  
      </div>
 
      <div class="statuses">
        <div class="status">
        <div class="icon-container heating">
            <span class="icon fa-solid fa-fire"></span>
            <h3>Heating <span class="heating-status">Off</span></h3>

            <form action="" method="POST">
              <div class="toggle-heating toggle button r center">
              <input type="checkbox" class="checkbox" id="heating-toggle">
              <div class="knobs"></div>
              <div class="layer"></div>
              </div>
              </form>
           
        </div>
        </div>
       
        <div class="status">
          <div class="icon-container window">
            <span class="icon fa-solid fa-door-open"></span>
          
            <h3>Window <span class="window-status">Closed</span></h3>
            <form action="" method="POST">
              <div class="toggle-window toggle button r center">
            <input type="checkbox" class="checkbox" id="window-toggle">
            <div class="knobs"></div>
            <div class="layer"></div>
          </div>
              </form>
           
        </div>
          </div>
        
        <div class="status">
          <div class="icon-container fan">
            <span class="icon fa-solid fa-fan"></span>
            <h3>Fan <span class="fan-status">Off</span></h3>

            <form action="" method="POST">
              <div class="toggle-fan toggle button r center">
              <input type="checkbox" class="checkbox" id="fan-toggle">
              <div class="knobs"></div>
              <div class="layer"></div>
          </div>
              
              </form>
            
        </div>
          </div>
        
        <div class="status">
          <div class="icon-container air-con">
            <span class="icon fa-solid fa-snowflake"></span>
            <h3>Air Conditioning <span class="air-con-status">Off</span></h3>
            <form action="" method="POST">
              <div class="toggle-ac toggle button r center">
            <input type="checkbox" class="checkbox" id="ac-toggle">
            <div class="knobs"></div>
            <div class="layer"></div>
          </div>
              
              </form>
           
        </div>
          </div>
        </div>
      
        
        
    </section>

    
    
    
    <div class="group container color-white">
        
        
          <div class="bg-color-red">
            <div class="icon-container power">

            <h3>Inside Temperature <span class="outside-power-status">Off</span></h3>

              <div class="toggle-outside-temp toggle button r center">
            <input type="checkbox" class="checkbox" id ="outside-toggle">
            <div class="knobs"></div>
            <div class="layer"></div>
          </div>
              

        </div>
          <h1 id="inside-temp-reading" class="center-text"><span class="temp">0</span>°C</h1>
          <small>Last updated: <strong><span id="last-updated-inside-temp" class=""></span></strong></small>
            <div class="circle center-text">
                <div id="chart-1" ></div>
            </div>
          </div>
          <div class="bg-color-blue">
           
            <h3>Outside Temperature <span class="inside-power-status">Off</span></h3>
     

             
          
            <div class="toggle-inside-temp toggle button r center">
            <input type="checkbox" class="checkbox" id="inside-toggle">
            <div class="knobs"></div>
            <div class="layer"></div>
              
         
         
            </div>
           
            
            <div class="div">
              <h1 id="outside-temp-reading" class="center-text"><span class="temp">0</span>°C</h1>
   
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
 

    function getOutsideTemp(){
      $.ajax({
        type:'GET',
        url:'/msg',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
          


          let outsideTemperatureLastUpdated = new Date(data.outsideTemperature[0].last_updated);
          let outsideTemperatureStatus = data.outsideTemperature[0].s_outsideTemp;

           

           $("#outside-temp-reading .temp").text(data.outsideTemperature[0].temperature);
           $("#last-updated-outside-temp").text(formatDate(outsideTemperatureLastUpdated));

        
           if(passedTimeGreaterThan(outsideTemperatureLastUpdated, 10000) || outsideTemperatureStatus == 0) 
           {
            $(".outside-power-status").text("Off");
            $(".toggle-outside-temp .checkbox").prop('checked', false);
           
            
           } else {
           
            $(".outside-power-status").text("[Active]");
            $(".toggle-outside-temp .checkbox").prop('checked', true);
           }
        },
       
     });
    }


    function getInsideTemp(){
        
        $.ajax({
           type:'GET',
           url:'/msg',
           data:'_token = <?php echo csrf_token() ?>',
           success:function(data) {
             
             
             let insideTemperatureLastUpdated = new Date(data.insideTemperature[0].last_updated);
             let insideTemperatureStatus = data.insideTemperature[0].s_insideTemp;
   
   
   
              
              $("#inside-temp-reading .temp").text(data.insideTemperature[0].temperature);
              $("#last-updated-inside-temp").text(formatDate(insideTemperatureLastUpdated));
   
              if(passedTimeGreaterThan(insideTemperatureLastUpdated, 2000) || insideTemperatureStatus == 0) 
              {
               $(".inside-power-status").text("Off");
               $(".toggle-inside-temp .checkbox").prop('checked', false);
              } else 
              {
               $(".inside-power-status").text("[Active]");
               $(".toggle-inside-temp .checkbox").prop('checked', true);
              }
       
           },
          
        });
   
        }
        let getOutsideTempID = setInterval(getOutsideTemp, 2000);
        let getInsideTempID = setInterval(getInsideTemp, 2000);
  
  
  
    $('#inside-toggle').click(function() {
    // alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
       if(this.checked){
            $.ajax({
                type: "GET",
                url: '/turnOnInsideTemp',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                  
                  
                    
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            } else {
              $.ajax({
                type: "GET",
                url: '/turnOffInsideTemp',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                   
                  
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            }
      });
      $('#automatic-manual-toggle').click(function() {
    // alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
       if(this.checked){
            $.ajax({
                type: "GET",
                url: '/automaticOn',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            } else {
              $.ajax({
                type: "GET",
                url: '/automaticOff',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                   
                  
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            }
      });
      $('#outside-toggle').click(function() {
    // alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
       if(this.checked){
            $.ajax({
                type: "GET",
                url: '/turnOnOutsideTemp',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                  
                  
                    
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            } else {
              $.ajax({
                type: "GET",
                url: '/turnOffOutsideTemp',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                   
                  
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            }
      });
      $('#ac-toggle').click(function() {
    // alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
       if(this.checked){
            $.ajax({
                type: "GET",
                url: '/acOn',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                  
                  
                    
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            } else {
              $.ajax({
                type: "GET",
                url: '/acOff',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                   
                  
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            }
      });
      $('#fan-toggle').click(function() {
    // alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
       if(this.checked){
            $.ajax({
                type: "GET",
                url: '/fanOn',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                  
                  
                    
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            } else {
              $.ajax({
                type: "GET",
                url: '/fanOff',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                   
                  
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            }
      });
      $('#window-toggle').click(function() {
    // alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
       if(this.checked){
            $.ajax({
                type: "GET",
                url: '/openWindow',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                  
                  
                    
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            } else {
              $.ajax({
                type: "GET",
                url: '/closeWindow',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                   
                  
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            }
      });
      $('#heating-toggle').click(function() {
    // alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
       if(this.checked){
            $.ajax({
                type: "GET",
                url: '/heatingOn',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                  
                  
                    
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            } else {
              $.ajax({
                type: "GET",
                url: '/heatingOff',
                data:'_token = <?php echo csrf_token() ?>',
                success: function(data) {
                   
                  
                },
                 error: function() {
                    alert('it broke');
                },
                complete: function() {
                    // alert('it completed');
                }
            });

            }
      });
    let myIntervalTwo = setInterval(function run(){

      $.ajax({
        type:'GET',
        url:'/msgtwo',
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data) {
         
          let windowStatus = data.statuses[0].s_window;
          let heatingStatus = data.statuses[0].s_heating;
          let airConStatus = data.statuses[0].s_ac;
          let fanStatus = data.statuses[0].s_fan;
          let powerStatus = data.statuses[0].s_power;
          let isAutomatic = data.statuses[0].is_automatic;
          if (isAutomatic != 1) {
            $("#automatic-manual-toggle").prop('checked', false);
            $(".automatic-mode-status").text("Off");
          } else {
            $("#automatic-manual-toggle").prop('checked', true);
            $(".automatic-mode-status").text("On");
          }
          if (windowStatus != 1) {
            $(".window").removeClass('window-opened-active');
            $(".window-status").text("Closed");
            $(".toggle-window .checkbox").prop('checked', false);
            
          } else {
            $(".window").addClass('window-opened-active');
            $(".window-status").text("Opened");
            $(".toggle-window .checkbox").prop('checked', true);
          }

          if (heatingStatus != 1) {
            $(".heating").removeClass('heating-active');
            $(".heating-status").text("Off");
            $(".toggle-heating .checkbox").prop('checked', false);
          } else {
            $(".heating").addClass('heating-active');
            $(".heating-status").text("On");
            $(".toggle-heating .checkbox").prop('checked', true);
          }
          if (airConStatus != 1) {
            $(".air-con").removeClass('air-con-active');
            $(".air-con-status").text("Off");
            $(".toggle-ac .checkbox").prop('checked', false);
          } else {
            $(".air-con").addClass('air-con-active');
            $(".air-con-status").text("On");
            $(".toggle-ac .checkbox").prop('checked', true);
          }
          if (fanStatus != 1) {
            $(".fan").removeClass('fan-active');
            $(".fan-status").text("Off");
            $(".toggle-fan .checkbox").prop('checked', false);
          } else {
            $(".fan").addClass('fan-active');
            $(".fan-status").text("On");
            $(".toggle-fan .checkbox").prop('checked', true);
          }
        },
       
     });
  
    }, 2000);
  
   
  
   
    </script>
</body>
</html>