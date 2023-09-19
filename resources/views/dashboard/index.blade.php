@extends('layouts.master')
@section('container')
<section class="content-header">
    <h1>
        Dashboard
    </h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-lg-4 col-xs-12">
            <div class="small-box bg-yellow-gradient">
                <div class="inner">
                    <p style="font-size:20px;">{{ $mhs }}</p>
                    <p>Jumlah Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="ion-android-contacts"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="small-box bg-blue-gradient">
                <div class="inner">
                    <p style="font-size:20px;">{{ $dosen }}</p>
                    <p>Jumlah Dosen</p>
                </div>
                <div class="icon">
                    <i class="ion-android-contacts"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="small-box bg-green-gradient">
                <div class="inner">
                    <p style="font-size:20px;">56</p>
                    <p>Jumlah Karyawan</p>
                </div>
                <div class="icon">
                    <i class="ion-android-contacts"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="text-center" style="font-size: 20px;">Chart IPK Mahasiswa</h3>
                </div>
                <div class="box-body">
                    <div id="chartIPKMhs"></div>
                    <!--<div id="chartIPKMhsPie"></div>-->
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="text-center" style="font-size: 20px;">Chart IPK Mahasiswa</h3>
                </div>
                <div class="box-body">
                    <!--<div id="chartIPKMhs"></div>-->
                    <div id="chartIPKMhsPie"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="text-center" style="font-size: 20px;">Chart Gender Mahasiswa</h3>
                </div>
                <div class="box-body">
                    <div id="chartGenderMhs"></div>
                    <div id="chartGenderMhsPie"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="text-center" style="font-size: 20px;">Chart Agama Mahasiswa</h3>
                </div>
                <div class="box-body">
                    <div id="chartAgamaMhs"></div>
                    <div id="chartAgamaMhsPie"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="text-center" style="font-size: 20px;">Chart Angket</h3>
                </div>
                <div class="box-body">
                    <div id="angkets0"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="text-center" style="font-size: 20px;">Chart Angket</h3>
                </div>
                <div class="box-body">
                    <div id="angkets1"></div>
                </div>
            </div>
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
                series: [{ name: 'Jawaban', data: seriesData, colorByPoint: true, }]
            });
        });
    },
    error: function(jqXHR, textStatus, errorThrown) {}
});

//Gender
let pria = @json($mhs_pria);
let wanita = @json($mhs_wanita);
new Highcharts.chart('chartGenderMhs', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: ['Mahasiswa']
    },
    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'Jumlah Mahasiswa'
        }
    },
    plotOptions: {
        column: {
            dataLabels: {
                enabled: true
            }
        },
        series: {
            dataLabels: {
                enabled: true,
            }
        }
    },
    tooltip: {
        formatter: function() {
            return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y;
        }
    },
    series: [
        {
            name: 'Laki - Laki',
            color: '#5c0dbd',
            data: [pria]
        },
        {
            name: 'Perempuan',
            color: '#ff0d9e',
            data: [wanita]
        }
    ]
});
new Highcharts.chart('chartGenderMhsPie', {
    chart: {
        type: 'pie' // Mengubah tipe grafik menjadi pie chart
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    series: [{
        name: 'Gender',
        colorByPoint: true,
        data: [{
            name: 'Laki - Laki',
            color: '#5c0dbd', // Warna ungu
            y: pria // Jumlah mahasiswa laki-laki
        }, {
            name: 'Perempuan',
            color: '#ff0d9e', // Warna merah muda
            y: wanita // Jumlah mahasiswa perempuan
        }]
    }]
});

//Agama
let islam = @json($mhs_islam);
let kristen = @json($mhs_kristen);
let katolik = @json($mhs_katolik);
let hindu = @json($mhs_hindu);
let budha = @json($mhs_budha);
let konghucu = @json($mhs_konghucu);
new Highcharts.chart('chartAgamaMhs', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: ['Mahasiswa']
    },
    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'Jumlah Mahasiswa'
        }
    },
    plotOptions: {
        column: {
            dataLabels: {
                enabled: true
            }
        },
        series: {
            dataLabels: {
                enabled: true,
            }
        }
    },
    tooltip: {
        formatter: function() {
            return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y;
        }
    },
    series: [
        {
            name: 'Islam',
            color: '#0dbd5c', // Warna hijau muda
            data: [islam] // Jumlah mahasiswa Islam
        },
        {
            name: 'Kristen',
            color: '#ff0d9e', // Warna merah muda
            data: [kristen] // Jumlah mahasiswa Kristen
        },
        {
            name: 'Katolik',
            color: '#0d9eff', // Warna biru muda
            data: [katolik] // Jumlah mahasiswa Katolik
        },
        {
            name: 'Hindu',
            color: '#5c0dbd', // Warna ungu
            data: [hindu] // Jumlah mahasiswa Hindu
        },
        {
            name: 'Buddha',
            color: '#bd5c0d', // Warna coklat
            data: [budha] // Jumlah mahasiswa Buddha
        },
        {
            name: 'Konghucu',
            color: '#bd0d5c', // Warna merah tua
            data: [konghucu] // Jumlah mahasiswa dengan agama lain
        }
    ]
});
new Highcharts.chart('chartAgamaMhsPie', {
    chart: {
        type: 'pie' // Mengubah tipe grafik menjadi pie chart
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    series: [{
        name: 'Agama',
        colorByPoint: true,
        data: [{
            name: 'Islam',
            color: '#0dbd5c', // Warna hijau muda
            y: islam // Jumlah mahasiswa Islam
        }, {
            name: 'Kristen',
            color: '#ff0d9e', // Warna merah muda
            y: kristen // Jumlah mahasiswa Kristen
        }, {
            name: 'Katolik',
            color: '#0d9eff', // Warna biru muda
            y: katolik // Jumlah mahasiswa Katolik
        }, {
            name: 'Hindu',
            color: '#5c0dbd', // Warna ungu
            y: hindu // Jumlah mahasiswa Hindu
        }, {
            name: 'Buddha',
            color: '#bd5c0d', // Warna coklat
            y: budha // Jumlah mahasiswa Buddha
        }, {
            name: 'Konghucu',
            color: '#bd0d5c', // Warna merah tua
            y: konghucu // Jumlah mahasiswa dengan agama lain
        }]
    }]
});

//ipk
new Highcharts.chart('chartIPKMhs', {
    chart: {
        type: 'bar'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: ['IPK']
    },
    yAxis: {
        allowDecimals: false,
        min: 0,
        title: {
            text: 'Jumlah Mahasiswa'
        }
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        },
        series: {
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
    series: [{
        name: '>3.50',
        color: '#5c0dbd',
        data: [942] // Jumlah mahasiswa dengan IPK > 3.50
    }, {
        name: '3.00 - 3.49',
        color: '#ff0d9e',
        data: [28] // Jumlah mahasiswa dengan IPK antara 3.00 dan 3.49
    }, {
        name: '<3.00',
        color: '#0dbd5c',
        data: [12] // Jumlah mahasiswa dengan IPK < 3.00
    }]
});
new Highcharts.chart('chartIPKMhsPie', {
    chart: {
        type: 'pie'
    },
    title: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>'
    },
    series: [{
        name: 'IPK',
        colorByPoint: true,
        data: [{
            name: '>3.50',
            color: '#5c0dbd',
            y: 942 // Jumlah mahasiswa dengan IPK > 3.50
        }, {
            name: '3.00 - 3.49',
            color: '#ff0d9e',
            y: 28 // Jumlah mahasiswa dengan IPK antara 3.00 dan 3.49
        }, {
            name: '<3.00',
            color: '#0dbd5c',
            y: 12 // Jumlah mahasiswa dengan IPK < 3.00
        }]
    }]
});
</script>
@endsection
