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
    <p>Number users: {{ User::count() }}</p>
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
        <div id="columnGraph" style="height: 600px; width: 100%"></div> <!-- replace this with tailwind-->
    </div>


    <script>
        google.charts.load('visualization', "1", {
            packages: ['corechart']
        });

        function initGraph() {
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
                title: 'Total number of users, movies, reviews',
                isStacked: true
            };

            const chart = new google.visualization.ColumnChart(document.querySelector('#columnGraph'));
            chart.draw(data, options);
        }
        google.charts.setOnLoadCallback(initGraph);
    </script>
    @endif


</body>

</html>