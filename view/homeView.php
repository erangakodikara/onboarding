<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Onboading app</title>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(
                <?php echo(json_encode($data['chatdata'])); ?>
            );

            var options = {
                title: 'Retention curve',
                curveType: 'function',
                legend: {position: 'bottom'}
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

</head>
<body>
<h1>Retention curve</h1>

<div id="curve_chart" style="width: 900px; height: 500px"></div>
<div id='vueapp'>

    <table border='1' width='100%' style='border-collapse: collapse;'>
        <tr>
            <th>User Id</th>
            <th>Created At</th>
            <th>Onboarding %</th>
            <th>Count Applications</th>
            <th>Count Accepted Applications</th>

        </tr>
        <tr v-for='contact in cohorts'>

            <td>{{ contact.user_id}}</td>
            <td>{{ contact.created_at }}</td>
            <td>{{ contact.onboarding_perentage }}</td>
            <td>{{ contact.count_applications }}</td>
            <td>{{ contact.count_accepted_applications }}</td>
        </tr>
    </table>
</body>
</html>
<script>

    var app = new Vue({
        el: '#vueapp',
        data: {
            cohorts: <?php echo(json_encode($data['cohorts'])); ?>
        },
        //mounted: function () {
        //
        //    this.getCohorts()
        //},
        //
        //methods: {
        //    getCohorts: function(){
        //        app.cohorts = <?php //echo(json_encode($data['cohorts'])); ?>//;
        //    }
        //
        //}
    });

</script>


