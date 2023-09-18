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
            <div id="angkets0"></div>
            <div id="angkets1"></div>
            <div id="angkets2"></div>
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
        angkets.forEach(function(item, index) {
            let categories = item.jawaban.map(answer => answer.answer_text);
            let seriesData = item.jawaban.map(answer => answer.count);
            Highcharts.chart('angkets' + index, {
                chart: { type: 'column' },
                title: { text: item.description },
                xAxis: { categories: categories },
                yAxis: { min: 0, title: { text: 'Total Terpilih' } },
                plotOptions: { column: { dataLabels: { enabled: true } } },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y;
                    }
                },
                series: [{ name: 'Jawaban', data: seriesData }]
            });
        });
    },
    error: function(jqXHR, textStatus, errorThrown) {}
});

</script>
@endsection
