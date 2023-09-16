@extends('layouts.master')
@section('container')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-lg-12 col-xs-12">
            <div class="small-box bg-yellow-gradient">
                <div class="inner">
                    <p style="font-size:20px;">{{ $users }}</p>
                    <p>Jumlah Users</p>
                </div>
                <div class="icon">
                    <i class="ion-android-contacts"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xs-12">
            <div id="angkets"></div>
        </div>

    </div>
</section>
@endsection
@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/exporting.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/export-data.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/10.3.3/modules/accessibility.min.js"></script>
<script>
    $.ajax({
            url: '/dashboard',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let angkets = data.angkets;
                let categories = angkets.map(item => item.description);
                let seriesData = [];

                angkets.forEach((item, i) => {
                    item.jawaban.forEach((jawaban) => {
                        if (jawaban.count > 0) {
                            let existingSeries = seriesData.find(series => series.name === jawaban.answer_text);

                            if (existingSeries) {
                                existingSeries.data[i] = jawaban.count.map(Number);
                            } else {
                                let data = new Array(angkets.length).fill(0);
                                data[i] = jawaban.count;
                                seriesData.push({
                                    name: jawaban.answer_text,
                                    data: data
                                });
                            }
                        }
                    });
                });

                Highcharts.chart('angkets', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Angket Pertama'
                    },
                    xAxis: {
                        categories: categories
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Total Terpilih'
                        }
                    },
                    plotOptions: {
                        column: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y;
                        }
                    },
                    series: seriesData
                });

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any errors that occur
            }
        });
</script>
@endsection
