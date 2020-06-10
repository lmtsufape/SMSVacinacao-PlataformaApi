@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function($) {
        var ctx = $("#myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                        label: 'Vacinados',
                        backgroundColor: '#1928',
                        borderWidth: 1
                    },
                    {
                        label: 'Restantes',
                        backgroundColor: '#ffff',
                        borderWidth: 1
                    },
                ]
            },

            options: {
                title: {
                    fontSize: 15,
                    display: true,
                    text: 'Relação Pacientes S/N Vacinados '
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: false,
                        ticks: {
                            min: 0,
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        var updateChart = function() {
            $.ajax({
                url: "{{ action('RelatorioController@snVacinados') }}",
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(data) {
                    myChart.data.labels = data.labels;
                    myChart.data.datasets[0].label = data.datasets[0].label;
                    myChart.data.datasets[0].data = data.datasets[0].data;
                    myChart.data.datasets[1].label = data.datasets[1].label;
                    myChart.data.datasets[1].data = data.datasets[1].data;
                    myChart.update();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        updateChart();
        setInterval(() => {
            updateChart();
        }, 1000);

    });
</script>
@endpush

@section('content')

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Relatório</h1>
    </div>
    <div class="col-lg-8 col-sm-12 " style="position: relative; height: 60vh">
        <canvas id="myChart"></canvas>
    </div>
</div>
@stack('scripts')
@stop