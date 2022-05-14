@extends('layouts.app')

@section('content')

    <div>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["calendar"]});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'date', id: 'Date' });
                dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
                dataTable.addRows([
                    [ new Date(2020, 3, 13), 37032 ],
                    [ new Date(2020, 3, 14), 38024 ],
                    [ new Date(2020, 3, 15), 38024 ],
                    [ new Date(2020, 3, 16), 38108 ],
                    [ new Date(2020, 3, 17), 38229 ],
                    // Many rows omitted for brevity.
                    [ new Date(2021, 9, 4), 38177 ],
                    [ new Date(2021, 9, 5), 38705 ],
                    [ new Date(2021, 9, 12), 38210 ],
                    [ new Date(2021, 9, 13), 38029 ],
                    [ new Date(2021, 9, 19), 38823 ],
                    [ new Date(2021, 9, 23), 38345 ],
                    [ new Date(2021, 9, 24), 38436 ],
                    [ new Date(2021, 9, 30), 38447 ]
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
                    <div class="card-header d-flex align-content-center justify-content-center"> <h4 class="text-center"> Statistica </h4>
                    </div>

                    <div class="card-body">
                        <div id="calendar_basic" style=" height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
