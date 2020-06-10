@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
</style>
@endsection

@push('scripts')
<script>
    var $url = "{{ action('RelatorioController@snVacinados') }}?division=bairro&period=mensal&user={{Auth::user()->admin?'false':'true'}}";

    $("select.division, select.period").change(function() {
        const selectPeriod = $("select.period").children("option:selected").val();
        const selectDivision = $("select.division").children("option:selected").val();
        $url = `{{ action('RelatorioController@snVacinados') }}?division=${selectDivision}&period=${selectPeriod}&user={{Auth::user()->admin?'false':'true'}}`;
        updateChart();
    });

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
                url: $url,
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
    <div class="col-lg-8">
        <label for="period">Período</label>
        <select id="period" class="form-control period" name="period">
            <option value="anual">Anual</option>
            <option value="mensal" selected>Mensal</option>
            <option value="diario">Diario</option>
        </select>
    </div>
    <div class="col-lg-12 col-sm-12 ">
        <div class="row mt-4">
            <div class="col-lg-9" style="position: relative; height: 60vh">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-lg-3 mt-5">
                <label for="division">Divisão</label>
                <select id="division" class="form-control division" name="division">
                    <option value="bairro" selected>Bairro</option>
                    <option value="rua">Rua</option>
                </select>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
@stop