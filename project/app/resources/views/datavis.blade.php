<?php
//for testing, this should all go into respective controllers and then passed on to .blade via web.php
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;

//$usercount = User::count();
// $moviecount = Movie::count();
// $reviewcount = Review::count();
?>

<x-admin>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // google.charts.load('visualization', "1", {
        //     packages: ['corechart']
        // });
        // Load Charts and the corechart and barchart packages.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Draw the bar chart that displays total numbers of users, movies, reviews.
        google.charts.setOnLoadCallback(drawBarChart);
          // Draw the calendar chart that displays property x over time.
        google.charts.setOnLoadCallback(drawCalendarChart);

        // Callback func() that draws bar chart
        function drawBarChart() {

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

            // instantiate and draw the chart
            const chart = new google.visualization.ColumnChart(document.querySelector('#columnGraph'));
            chart.draw(data, options);
        }

        //add calendar chart to visualize stats over time?
        // Callback func() that draws calendar chart
        function drawCalendarChart() {
            const data = new google.visualization.DataTable();
            data.addColumn({
                type: 'date',
                id: 'Date'
            });
            data.addColumn({
                type: 'number',
                id: 'Won/Loss'
            });
            //pseudo data
            data.addRows([
                [new Date(2012, 3, 13), 37032],
                [new Date(2012, 3, 14), 38024],
                [new Date(2013, 9, 24), 38436],
                [new Date(2013, 9, 30), 38447]
            ]);

           
            const options = {
                width: 400,
                height: 240,
                title: 'User logins'
            };

             // instantiate and draw the chart
            const chart = new google.visualization.Calendar(document.querySelector('#calendarBasic'));
            chart.draw(data, options);
        }
    </script>


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

    <span>{{User::select('created_at')->get()}}</span>

    @if (User::count() || Movie::count() || Review::count())
    <h2>But I prefer a graphical representation</h2>
    <div class="container">
        <div id="columnGraph"> </div> <!--  style="height: 600px; width: 100%"> replace this with tailwind-->
        <div id="calendarBasic"></div> <!-- style="width: 1000px; height: 350px;" -->
    </div>


    
    @endif


</x-admin>