<?php
//for testing, this should all go into respective controllers and then passed on to .blade via web.php
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;

//$usercount = User::count();
// $moviecount = Movie::count();
// $reviewcount = Review::count();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<title>Datavis</title>
</head>

<body>
    <h1>User and Movie Stats</h1>
    <h2>In raw numbers</h2>
    @if (User::count())
    <p>Number of users: {{ User::count() }}</p>
    @endif
    @if (Movie::count())
    <p>Number of movies: {{ Movie::count() }}</p>
    @endif
    @if (Review::count())
    <p>Number of reviews: {{ Review::count() }}</p>
    @endif

    @if (User::count() || Movie::count() || Review::count())
    <h2>But I prefer a graphical representation</h2>
    <div class="container">
        <div id="columnGraph"> </div> <!--  style="height: 600px; width: 100%"> replace this with tailwind-->
        <div id="calendar_basic" ></div> <!-- style="width: 1000px; height: 350px;" -->
    </div>


    <script>
        google.charts.load('visualization', "1", {
            packages: ['corechart']
        });

        function drawBarChart() {
            // const data = google.visualization.arrayToDataTable([
            //    // ['Users', 'Movies', 'Reviews'],
            //    <?php //echo User::count(),  Movie::count(), Review::count()]  
                    ?>
            // ]);

            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Table');
            data.addColumn('number', 'total');
            data.addRows([
                ['Users', <?php echo User::count() ?>],
                ['Movies', <?php echo Movie::count() ?>],
                ['Reviews', <?php echo Review::count() ?>]
            ]);

            const options = {
                width: 400,
                height: 240,
                is3D: true,
                title: 'Total number of users, movies, reviews',
                isStacked: true
            };

            const chart = new google.visualization.ColumnChart(document.querySelector('#columnGraph'));
            chart.draw(data, options);
        }
       
        //add calendar chart to visualize stats over time?
        function drawCalendarChart() {
            const calendarStats = new google.visualization.DataTable();
            calendarStats.addColumn({
                type: 'date',
                id: 'Date'
            });
            calendarStats.addColumn({
                type: 'number',
                id: 'Won/Loss'
            });
            //pseudo data
            calendarStats.addRows([
                [new Date(2012, 3, 13), 37032],
                [new Date(2012, 3, 14), 38024],
                [new Date(2012, 3, 15), 38024],
                [new Date(2012, 3, 16), 38108],
                [new Date(2012, 3, 17), 38229],
                // Many rows omitted for brevity.
                [new Date(2013, 9, 4), 38177],
                [new Date(2013, 9, 5), 38705],
                [new Date(2013, 9, 12), 38210],
                [new Date(2013, 9, 13), 38029],
                [new Date(2013, 9, 19), 38823],
                [new Date(2013, 9, 23), 38345],
                [new Date(2013, 9, 24), 38436],
                [new Date(2013, 9, 30), 38447]
            ]);

            const chart = new google.visualization.Calendar(document.querySelector('#calendar_basic'));

            const options = {
                height: 300,
               // is3D: true,
                title: 'User logins'
            };

            chart.draw(calendarStats, options);
        }

        google.charts.setOnLoadCallback(drawBarChart);

        google.charts.setOnLoadCallback(drawCalendarChart);
    </script>
    @endif
  

</body>

</html>