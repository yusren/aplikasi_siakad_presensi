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

        </div>
    </section>
@endsection
