<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{ __('admin::app.dashboard.sales') }}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="myChart" style="min-height: 250px; height: 87%;  max-width: 100%;"></canvas>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            var ctx = document.getElementById("myChart").getContext('2d');
            var data = @json($statistics['sale_graph']);

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['label'],
                    datasets: [{
                        data: data['total'],
                        backgroundColor: 'rgba(34, 201, 93, 1)',
                        borderColor: 'rgba(34, 201, 93, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            maxBarThickness: 20,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 20,
                                beginAtZero: true,
                                fontColor: 'rgba(162, 162, 162, 1)'
                            }
                        }]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                        displayColors: false,
                        callbacks: {
                            label: function(tooltipItem, dataTemp) {
                                return data['formated_total'][tooltipItem.index];
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush


{{-- }}
<div class="left-card-container graph">
    <div class="card" style="overflow: hidden;">
        <div class="card-title" style="margin-bottom: 30px;">
            {{ __('admin::app.dashboard.sales') }}
        </div>

        <div class="card-info" style="height: 100%;">

            <canvas id="myChart" style="width: 100%; height: 87%"></canvas>

        </div>
    </div>
</div>
{{ --}}
