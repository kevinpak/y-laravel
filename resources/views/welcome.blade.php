@extends('layouts.app')
@section('content')
    <div class="list-employer">
        <canvas id="canvas" height="280" width="600"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        var year = ['2018','2019','2020'];
        var salary = <?php echo $salaries; ?>;
    
        var barChartData = {
            labels: year,
            datasets: [ {
                label: 'Salary',
                backgroundColor: "rgba(151,187,205,0.5)",
                data: salary
            }]
        };
    
    
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: 'rgb(0, 255, 0)',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Yearly Salary'
                    }
                }
            });
    
        };
    </script>
        
@endsection
