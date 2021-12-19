<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8" />
    <title>How to Create Dynamic Chart in PHP using Chart.js</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-4 mb-3">How to Create Dynamic Chart in PHP using Chart.js</a></h2>


    </div>
    <div class="container-fluid">
        <div class="row">
            <?php
/*             <div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-header">Pie Chart</div>
                    <div class="card-body">
                        <div class="chart-container pie-chart">
                            <canvas id="pie_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-md-4">
                <div class="card mt-4 mb-4">
                    <div class="card-header">Bar Chart</div>
                    <div class="card-body">
                        <div class="chart-container pie-chart">
                            <canvas id="bar_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            */
            ?>
            <div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-header">Doughnut Chart</div>
                    <div class="card-body">
                        <div class="chart-container pie-chart">
                            <canvas id="doughnut_chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>

<script>
$(document).ready(function() {

    /*    $('#submit_data').click(function() {

           var expense = $('input[name=programming_expense]:checked').val();

           $.ajax({
               url: "chartdata.php",
               method: "POST",
               data: {
                   action: 'insert',
                   expense: expense
               },
               beforeSend: function() {
                   $('#submit_data').attr('disabled', 'disabled');
               },
               success: function(data) {
                   $('#submit_data').attr('disabled', false);

                   $('#programming_expense_1').prop('checked', 'checked');

                   $('#programming_expense_2').prop('checked', false);

                   $('#programming_expense_3').prop('checked', false);

                   alert("Your Feedback has been send...");

                   makechart();
               }
           })

       }); */

    makechart();

    function makechart() {
        $.ajax({
            url: "chartdata.php",
            method: "POST",
            data: {
                action: 'fetch'
            },
            dataType: "JSON",
            success: function(data) {
                var expense = [];
                var total = [];
                var color = [];

                for (var count = 0; count < data.length; count++) {
                    expense.push(data[count].expense);
                    total.push(data[count].total);
                    color.push(data[count].color);
                }

                var chart_data = {
                    labels: expense,
                    datasets: [{
                        label: 'Vote',
                        backgroundColor: color,
                        color: '#fff',
                        data: total
                    }]
                };

                var options = {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0
                            }
                        }]
                    }
                };

                var group_chart1 = $('#pie_chart');

                var graph1 = new Chart(group_chart1, {
                    type: "pie",
                    data: chart_data
                });

                var group_chart2 = $('#doughnut_chart');

                var graph2 = new Chart(group_chart2, {
                    type: "doughnut",
                    data: chart_data
                });

                var group_chart3 = $('#bar_chart');

                var graph3 = new Chart(group_chart3, {
                    type: 'bar',
                    data: chart_data,
                    options: options
                });
            }
        })
    }

});
</script>