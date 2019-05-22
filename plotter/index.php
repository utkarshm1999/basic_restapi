<?php 
    require '../vendor/autoload.php';
    $app=new \Slim\App();

$app->get('/',function($request,$response,$args){
    $content =     file_get_contents("http://localhost/restapi/fetchdb/");

    $result  = json_decode($content);

    ?>
    <html>
    <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Person', 'Age']
            
         <?php
            $index=0 ;
            $category_no=array();
            $l25=0;
            $l50=0;
            $l75=0;
            $l100=0;

            


            foreach($result as $row){
               
                echo ",['$index', $row->e]" ;
                $index=$index+1;
                if($row->e<=25){
                    $l25=$l25+1;
                }
                else if($row->e<=50){
                    $l50=$l50+1;

                }
                else if($row->e<=75){
                    $l75=$l75+1;

                }
                else{
                    $l100=$l100+1;

                }


            }
            echo "]);";
         ?>

        var options = {
          title: 'Age of patient',
          legend: { position: 'none' },
        };

        var chart = new google.visualization.Histogram(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['less than 25',     <?php echo $l25;?>],
          ['between 25 and 50',      <?php echo $l50;?>],
          ['between 50 and 75',  <?php echo $l75;?>],
          ['between 75 and 100', <?php echo $l100 ;?>]
          
        ]);

        var options = {
          title: 'Break- Up Chart with respect to the age of patients',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 1000px; height: 500px;"></div>
    <div id="donutchart" style="width: 1000px; height: 500px;"></div>

  </body>
</html>
<?php

});
$app->run();

?>
