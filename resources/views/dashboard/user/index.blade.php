@extends('layouts.mahasiswa.master')
@section('container')
<!-- welcome user -->
<div class="mb-4 row">
    <div class="col-auto">
        <div class="shadow avatar avatar-50 rounded-10">
            <img src="{{ asset('mahasiswa/img/user1.jpg') }}" alt="">
        </div>
    </div>
    <div class="col align-self-center ps-0">
        <h4 class="text-color-theme"><span class="fw-normal">Hi</span>, Maxartkiller</h4>
        <p class="text-muted">Good Morning</p>
    </div>
</div>
<!-- money request received -->
<div class="mb-4 row hideonprogress">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow-sm avatar avatar-44 rounded-10">
                            <img src="{{ asset('mahasiswa/img/user3.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-1 small"><a href="profile.html" class="fw-medium">Shelvey</a> <span
                                class="text-muted">requested money</span></p>
                        <p>150 <span class="text-muted">$</span> <small class="text-muted">1 min ago</small>
                        </p>
                    </div>
                    <div class="col-auto">
                        <button class="shadow-sm btn btn-44 btn-default">
                            <i class="bi bi-arrow-up-right-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="mx-0 row">
                <div class="col-12">
                    <div class="h-2 progress bg-none hideonprogressbar" data-target="hideonprogress">
                        <div class="progress-bar bg-theme" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- swiper credit cards -->
<div class="mb-3 row">
    <div class="px-0 col-12">
        <div class="swiper-container cardswiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-auto align-self-center">
                                    <img src="{{ asset('mahasiswa/img/masterocard.png') }}" alt="">
                                </div>
                                <div class="col align-self-center text-end">
                                    <p class="small">
                                        <span class="text-uppercase size-10">Validity</span><br>
                                        <span class="text-muted">09/24</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="mb-2 fw-normal">
                                        150540.00
                                        <span class="small text-muted">USD</span>
                                    </h4>
                                    <p class="mb-0 text-muted size-12">10141 0021 0001 0154</p>
                                    <p class="text-muted size-12">Debit Card</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card dark-bg">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-auto align-self-center">
                                    <img src="{{ asset('mahasiswa/img/masterocard.png') }}" alt="">
                                </div>
                                <div class="col align-self-center text-end">
                                    <p class="small">
                                        <span class="text-uppercase size-10">Validity</span><br>
                                        <span class="text-muted">06/25</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="mb-2 fw-normal">
                                        56040.00
                                        <span class="small text-muted">USD</span>
                                    </h4>
                                    <p class="mb-0 text-muted size-12">10141 0021 0001 0154</p>
                                    <p class="text-muted size-12">Debit Card</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="border-0 card theme-radial-gradient">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-auto align-self-center">
                                    <i class="bi bi-wallet2"></i> Wallet
                                </div>
                                <div class="col align-self-center text-end">
                                    <p class="small">
                                        <span class="text-uppercase size-10">Validity</span><br>
                                        <span class="text-muted">Unlimited</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="mb-2 fw-normal">
                                        100.00
                                        <span class="small text-muted">USD</span>
                                    </h4>
                                    <p class="mb-0 text-muted size-12">10141 0021 0001 0154</p>
                                    <p class="text-muted size-12">Debit Card</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- connection -->
<div class="mb-3 row">
    <div class="col">
        <h6 class="title">Connections</h6>
    </div>
    <div class="col-auto">
        <a href="userlist.html" class="small">View all</a>
    </div>
</div>
<div class="mb-3 row">
    <div class="px-0 col-12">
        <!-- swiper users connections -->
        <div class="swiper-container connectionwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user4.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">Nicolas</p>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user2.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">Shelvey</p>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user3.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">Amenda</p>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user1.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">RXL15</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user4.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">Nicolas</p>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user2.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">Shelvey</p>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user3.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">Amenda</p>
                        </div>
                    </a>
                </div>

                <div class="swiper-slide">
                    <a href="profile.html" class="text-center card">
                        <div class="card-body">
                            <figure class="mb-1 shadow-sm avatar avatar-50 rounded-10">
                                <img src="{{ asset('mahasiswa/img/user1.jpg') }}" alt="">
                            </figure>
                            <p class="text-color-theme size-12 small">RXL15</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- offers banner -->
<div class="mb-4 row">
    <div class="col-12">
        <div class="text-center card theme-bg">
            <div class="card-body">
                <div class="row">
                    <div class="col align-self-center">
                        <h1>15% OFF</h1>
                        <p class="size-12 text-muted">
                            On every bill pay, launch offer get 5% Extra
                        </p>
                        <div class="border-dashed tag border-opac">
                            BILLPAY15OFF
                        </div>
                    </div>
                    <div class="col-6 align-self-center ps-0">
                        <img src="{{ asset('mahasiswa/img/offergraphics.png') }}" alt="" class="mw-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dark mode switch -->
<div class="mb-4 row">
    <div class="col-12">
        <div class="shadow-sm card">
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="darkmodeswitch">
                    <label class="px-2 form-check-label text-muted " for="darkmodeswitch">Activate Dark
                        Mode</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Saving targets -->
<div class="mb-3 row">
    <div class="col">
        <h6 class="title">Saving Targets</h6>
    </div>
    <div class="col-auto">

    </div>
</div>
<div class="mb-4 row">
    <div class="col-6 col-md-4 col-lg-3">
        <div class="mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="circle-small">
                            <div id="circleprogressone"></div>
                            <div class="avatar avatar-30 alert-primary text-primary rounded-circle">
                                <i class="bi bi-globe"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto align-self-center ps-0">
                        <p class="mb-1 small text-muted">USA Trip</p>
                        <p>60<span class="small">%</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="circle-small">
                            <div id="circleprogresstwo"></div>
                            <div class="avatar avatar-30 alert-success text-success rounded-circle">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto align-self-center ps-0">
                        <p class="mb-1 small text-muted">Car loan</p>
                        <p>85<span class="small">%</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="avatar avatar-40 alert-danger text-danger rounded-circle">
                            <i class="bi bi-house"></i>
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <div class="mb-2 row">
                            <div class="col">
                                <p class="mb-0 small text-muted">Home Loan</p>
                                <p>3510.00 $</p>
                            </div>
                            <div class="col-auto text-end">
                                <p class="mb-0 small text-muted">Next EMI</p>
                                <p class="small">1 Aug 2024</p>
                            </div>
                        </div>

                        <div class="h-4 progress alert-danger">
                            <div class="progress-bar bg-danger w-50" role="progressbar" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transactions -->
<div class="mb-3 row">
    <div class="col">
        <h6 class="title">Transactions<br><small class="fw-normal text-muted">Today, 24 Aug 2021</small>
        </h6>
    </div>
    <div class="col-auto align-self-center">
        <a href="transactions.html" class="small">View all</a>
    </div>
</div>
<div class="mb-4 row">
    <div class="px-0 col-12">
        <ul class="list-group list-group-flush bg-none">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow avatar avatar-50 rounded-10 ">
                            <img src="{{ asset('mahasiswa/img/company4.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-0 text-color-theme">Zomato</p>
                        <p class="text-muted size-12">Food</p>
                    </div>
                    <div class="col align-self-center text-end">
                        <p class="mb-0">-25.00</p>
                        <p class="text-muted size-12">Debit Card 4545</p>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow avatar avatar-50 rounded-10">
                            <img src="{{ asset('mahasiswa/img/company5.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-0 text-color-theme">Uber</p>
                        <p class="text-muted size-12">Travel</p>
                    </div>
                    <div class="col align-self-center text-end">
                        <p class="mb-0">-26.00</p>
                        <p class="text-muted size-12">Debit Card 4545</p>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow avatar avatar-50 rounded-10">
                            <img src="{{ asset('mahasiswa/img/company1.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-0 text-color-theme">Starbucks</p>
                        <p class="text-muted size-12">Food</p>
                    </div>
                    <div class="col align-self-center text-end">
                        <p class="mb-0">-18.00</p>
                        <p class="text-muted size-12">Cash</p>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow avatar avatar-50 rounded-10">
                            <img src="{{ asset('mahasiswa/img/company3.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-0 text-color-theme">Walmart</p>
                        <p class="text-muted size-12">Clothing</p>
                    </div>
                    <div class="col align-self-center text-end">
                        <p class="mb-0">-105.00</p>
                        <p class="text-muted size-12">Wallet</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- Blogs -->
<div class="mb-3 row">
    <div class="col">
        <h6 class="title">News and Upcomming</h6>
    </div>
    <div class="col-auto align-self-center">
        <a href="blog.html" class="small">Read more</a>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6 col-lg-4">
        <a href="blog-details.html" class="mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow-sm avatar avatar-60 rounded-10 coverimg">
                            <img src="{{ asset('mahasiswa/img/news.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-1 text-color-theme">Do share and Earn a lot</p>
                        <p class="text-muted size-12">Get $10 instant as reward while your friend or invited
                            member join FiMobile</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <a href="blog-details.html" class="mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow-sm avatar avatar-60 rounded-10 coverimg">
                            <img src="{{ asset('mahasiswa/img/news1.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-1 text-color-theme">Walmart news latest picks</p>
                        <p class="text-muted size-12">Get $10 instant as reward while your friend or invited
                            member join FiMobile</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <a href="blog-details.html" class="mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <div class="shadow-sm avatar avatar-60 rounded-10 coverimg">
                            <img src="{{ asset('mahasiswa/img/news2.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col align-self-center ps-0">
                        <p class="mb-1 text-color-theme">Do share and Help us</p>
                        <p class="text-muted size-12">Get $10 instant as reward while your friend or invited
                            member join FiMobile</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
