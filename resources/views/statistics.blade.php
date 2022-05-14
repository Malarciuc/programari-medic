@extends('layouts.app')

@section('content')

    <div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', { packages: ['calendar'] });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart () {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'date', id: 'Date' });
                dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
                dataTable.addRows([

                    <?php
                    foreach ($appointments as $appointment) {
                        $date = carbon($appointment->appointment);
                        $year = $date->format('Y');
                        $month = $date->format('M');
                        $day = $date->format('D');

                        echo "[ new Date($year,$month , $day), $appointment->appointments ],"

                        }
                    ?>

                ]);

                var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

                var options = {
                    title: 'Programari la medic',
                    height: 350,
                };

                chart.draw(dataTable, options);
            }
        </script>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-content-center justify-content-center"><h4 class="text-center">
                            Statistica </h4>
                    </div>

                    <div class="card-body">
                        <div id="calendar_basic" style=" height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
