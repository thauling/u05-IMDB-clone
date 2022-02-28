<?php
//for testing, this should all go into respective controllers and then passed on to .blade via web.php
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;

//$usercount = User::count();
// $moviecount = Movie::count();
// $reviewcount = Review::count();
$ratings = Review::select('review_rating')->get()->toArray();

// foreach ($ratings as $rating) {
//     echo gettype(json_encode($rating));
// }
$ratings_array = array(
    array('Genre', 'Rating'),
    array('comedy', 6.4),
                array('action', 2.9),
                array('comedy', 3.4),
                array('crime', 9.1),
                array('comedy', 5.4),
                array('action', 8.9),
                array('comedy', 3.6),
                array('crime', 4.9),
                array('comedy', 6.4),
                array('action', 5.9),
                array('crime', 7.4),
                array('action', 6.9),
                array('crime', 3.4),
                array('action', 5.9),
                array('comedy', 2.4),
                array('action', 1.9),
                array('comedy', 7.4),
                array('action', 7.9),
                array('comedy', 3.4),
                array('crime', 7.9),
                array('comedy', 8.4),
                array('crime', 6.9),
                array('crime', 2.4),
                array('action', 7.9)
);

//$flattened_arr =array_reduce($ratings, 'array_merge', []);
echo 'ratings' . json_encode($ratings);

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
        // Draw Histogram chart that displays movie ratings.
        google.charts.setOnLoadCallback(drawHistogram);
        // Draw the calendar chart that displays property x over time.
        // google.charts.setOnLoadCallback(drawCalendarChart);

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

        function drawHistogram() {
            const data = google.visualization.arrayToDataTable(
                [
                ['Genre', 'Rating'],
                ['comedy', 6.4],
                ['action', 2.9],
                ['comedy', 3.4],
                ['crime', 9.1],
                ['comedy', 5.4],
                ['action', 8.9],
                ['comedy', 3.6],
                ['crime', 4.9],
                ['comedy', 6.4],
                ['action', 5.9],
                ['crime', 7.4],
                ['action', 6.9],
                ['crime', 3.4],
                ['action', 5.9],
                ['comedy', 2.4],
                ['action', 1.9],
                ['comedy', 7.4],
                ['action', 7.9],
                ['comedy', 3.4],
                ['crime', 7.9],
                ['comedy', 8.4],
                ['crime', 6.9],
                ['crime', 2.4],
                ['action', 7.9]
            ]);

            const options = {
                width: 400,
                height: 240,
                is3D: true,
                title: 'Movie ratings, in IMDB grades',
                legend: {
                    position: 'none'
                },
                histogram: {
                    bucketSize: 0.1,
                    maxNumBuckets: 20,
                    minValue: 0,
                    maxValue: 9.9 // since 10 extends x-axis beyond 10... WHY?
                }
            };

            var chart = new google.visualization.Histogram(document.getElementById('histogram'));
            chart.draw(data, options);

        }
        //add calendar chart to visualize stats over time?
        // Callback func() that draws calendar chart
        // function drawCalendarChart() {
        //     const data = new google.visualization.DataTable();
        //     data.addColumn({
        //         type: 'date',
        //         id: 'Date'
        //     });
        //     data.addColumn({
        //         type: 'number',
        //         id: 'Won/Loss'
        //     });
        //     //pseudo data
        //     data.addRows([
        //         [new Date(2012, 3, 13), 37032],
        //         [new Date(2012, 3, 14), 38024],
        //         [new Date(2013, 9, 24), 38436],
        //         [new Date(2013, 9, 30), 38447]
        //     ]);


        //     const options = {
        //         width: 400,
        //         height: 240,
        //         title: 'User logins'
        //     };

        //     // instantiate and draw the chart
        //     const chart = new google.visualization.Calendar(document.querySelector('#calendarBasic'));
        //     chart.draw(data, options);
        // }
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

    <span>{{json_encode(User::select('created_at')->get()->all())}} \br
        {{json_encode(Review::select('review_rating')->get()->all())}}
    </span> <!-- '->toArray()' -->

    @if (User::count() || Movie::count() || Review::count())
    <h2>But I prefer a graphical representation</h2>
    <div class="container">
        <div id="columnGraph"> </div> <!--  style="height: 600px; width: 100%"> replace this with tailwind-->
        <div id="histogram"></div> <!-- style="width: 1000px; height: 350px;" -->
       <!-- <div id="calendarBasic"></div>  style="width: 1000px; height: 350px;" -->
    </div>



    @endif


</x-admin>