<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <!-- loader-->
  <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet"/>
  <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- simplebar CSS-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
  <!-- animate CSS-->
  {{-- <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css"/> --}}
  <!-- Icons CSS-->
  <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="{{ asset('assets/css/sidebar-menu.css') }}" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>

<style>
    .container-flex {
        display: flex;
        flex-wrap: wrap; /* Agar tampilan tetap rapi di layar kecil */
        gap: 10px; /* Jarak antara grafik dan daftar */
        align-items: stretch; /* Pastikan memiliki tinggi yang sama */
    }

    .chart-container-1, .chart-container-2 {
        flex: 1; /* Membuat kedua elemen berbagi ruang */
        min-width: 300px; /* Agar tetap responsif */
        overflow-x: auto; /* Membuat scroll horizontal */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling di iOS */
    }

    .chart-container-1 canvas {
        min-width: 600px; /* Ukuran minimum agar chart bisa di-scroll jika perlu */
    }

    .card-body {
        display: flex;
        flex-direction: column;
    }

    .month-list {
        display: flex;
        flex-direction: column;
        gap: 5px; /* Ruang antar item */
    }
</style>
</head>

<body class="bg-theme bg-theme1">

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="{{ route('showdash') }}">
       <h5 class="logo-text">{{ $user->syarikat ?? '-' }}</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="{{ route('showdash') }}">
            <i class="zmdi zmdi-view-dashboard"></i> <span>DASHBOARD</span>
        </a>
      </li>

      <li>
        <a href="{{ route('showleave') }}">
          <i class="zmdi zmdi-calendar-note"></i> <span>LEAVE</span>
        </a>
      </li>

      <li>
        <a href="{{ route('showclaim') }}">
          <i class="zmdi zmdi-receipt"></i> <span>CLAIM</span>
        </a>
      </li>

      <li>
        <a href="{{ route('showattan') }}">
          <i class="zmdi zmdi-grid"></i> <span>ATTANDANCE</span>
        </a>
      </li>

      <li>
        <a href="{{ route('listmusic') }}">
          <i class="zmdi zmdi-headset"></i> <span>MUSIC</span>
        </a>
      </li>
    </ul>

   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
     <ul class="navbar-nav mr-auto align-items-center">
       <li class="nav-item">
         <a class="nav-link toggle-menu" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
       </li>
     </ul>

       <ul class="navbar-nav w-100 d-flex justify-content-center">
           <li class="nav-item">
               <h5>{{ $user->name }}</h5>
           </li>
       </ul>

     <ul class="navbar-nav align-items-center right-nav-link">
       <li class="nav-item dropdown-lg">
         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
         <i class="fa fa-bell-o"></i></a>
       </li>
       <li class="nav-item">
         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
           <span class="user-profile"><img src="{{ asset('assets/images/user-1.jpg') }}" class="img-circle" alt="user avatar"></span>
         </a>
         <ul class="dropdown-menu dropdown-menu-right">
           {{-- <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
           <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li> --}}
           <li class="dropdown-item"><a href="{{ route('viewprofile') }}"><i class="icon-settings mr-2"></i> Profile</a></li>
           <li class="dropdown-divider"></li>
           <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="{{ route('showlogin') }}">Logout</li>
         </ul>
       </li>
     </ul>
   </nav>
   </header>
<!--End topbar header-->

<div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">

  <!--Start Dashboard Content-->

	<div class="row">
         <div class="col-12">
            <div class="card">
                <div class="card-header">GRAF LEAVE & LIST OF LEAVE
                    <div class="card-action">
                        <div class="dropdown">
                            <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-flex">
                        <!-- Chart Section -->
                        <div class="chart-container-1 col-lg-8 col-xl-8">
                            <canvas id="chart1"></canvas>
                        </div>

                        <!-- Leave List Section -->
                        <div class="chart-container-2 col-lg-4 col-xl-4">
                            <div class="month-list">
                                <h6>ANNUAL LEAVE : {{ $leaveno["ANNUAL LEAVE"] ?? 0 }}</h6>
                                <h6>MEDICAL LEAVE : {{ $leaveno["MEDICAL LEAVE"] ?? 0 }}</h6>
                                <h6>UNPAID LEAVE : {{ $leaveno["UNPAID LEAVE"] ?? 0 }}</h6>
                                <h6>METERNITY LEAVE : {{ $leaveno["METERNITY LEAVE"] ?? 0 }}</h6>
                                <h6>HOSPITALITY LEAVE : {{ $leaveno["HOSPITALITY LEAVE"] ?? 0 }}</h6>
                                <h6>EMERGENCY LEAVE : {{ $leaveno["EMERGENCY LEAVE"] ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">GRAF CLAIM & LIST OF TOTAL CLAIMS
                    <div class="card-action">
                        <div class="dropdown">
                            <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container-flex">
                        <!-- Chart Section -->
                        <div class="chart-container-1 col-lg-8 col-xl-8">
                            <canvas id="chart2"></canvas>
                        </div>

                        <!-- List of Claims Section -->
                        <div class="chart-container-2 col-lg-4 col-xl-4">
                            <div class="month-list">
                                <h6>JANUARY : RM {{ $claimno['jumlah_claim'][0] ?? 0 }}</h6>
                                <h6>FEBRUARY : RM {{ $claimno['jumlah_claim'][1] ?? 0 }}</h6>
                                <h6>MARCH : RM {{ $claimno['jumlah_claim'][2] ?? 0 }}</h6>
                                <h6>APRIL : RM {{ $claimno['jumlah_claim'][3] ?? 0 }}</h6>
                                <h6>MAY : RM {{ $claimno['jumlah_claim'][4] ?? 0 }}</h6>
                                <h6>JUNE : RM {{ $claimno['jumlah_claim'][5] ?? 0 }}</h6>
                                <h6>JULY : RM {{ $claimno['jumlah_claim'][6] ?? 0 }}</h6>
                                <h6>AUGUST : RM {{ $claimno['jumlah_claim'][7] ?? 0 }}</h6>
                                <h6>SEPTEMBER : RM {{ $claimno['jumlah_claim'][8] ?? 0 }}</h6>
                                <h6>OCTOBER : RM {{ $claimno['jumlah_claim'][9] ?? 0 }}</h6>
                                <h6>NOVEMBER : RM {{ $claimno['jumlah_claim'][10] ?? 0 }}</h6>
                                <h6>DECEMBER : RM {{ $claimno['jumlah_claim'][11] ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">GRAF TOTAL IN OFFICE EVERY MONTH
                        <div class="card-action">
                            <div class="dropdown">
                                <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-flex">
                            <!-- Chart Section -->
                            <div class="chart-container-1 col-lg-8 col-xl-8">
                                <canvas id="chart3"></canvas>
                            </div>

                            <!-- List of Total Days Section -->
                            <div class="chart-container-2 col-lg-4 col-xl-4">
                                <div class="month-list">
                                    @php
                                        $months = [
                                            'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
                                            'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
                                        ];
                                    @endphp

                                    @foreach ($months as $index => $month)
                                        <h6>{{ $month }} : {{ $officeno['jumlah_attan'][$index] ?? 0 }} DAY</h6>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">GRAF TOTAL IN OUTSTATION EVERY MONTH
                        <div class="card-action">
                            <div class="dropdown">
                                <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-flex">
                            <!-- Chart Section -->
                            <div class="chart-container-1 col-lg-8 col-xl-8">
                                <canvas id="chart4"></canvas>
                            </div>

                            <!-- List of Total Days Section -->
                            <div class="chart-container-2 col-lg-4 col-xl-4">
                                <div class="month-list">
                                    @php
                                        $months = [
                                            'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
                                            'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
                                        ];
                                    @endphp

                                    @foreach ($months as $index => $month)
                                        <h6>{{ $month }} : {{ $outno['jumlah_out'][$index] ?? 0 }} DAY</h6>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">GRAF TOTAL IN WORK FROM HOME EVERY MONTH
                        <div class="card-action">
                            <div class="dropdown">
                                <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-flex">
                            <!-- Chart Section -->
                            <div class="chart-container-1 col-lg-8 col-xl-8">
                                <canvas id="chart5"></canvas>
                            </div>

                            <!-- List of Total Days Section -->
                            <div class="chart-container-2 col-lg-4 col-xl-4">
                                <div class="month-list">
                                    @php
                                        $months = [
                                            'JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE',
                                            'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'
                                        ];
                                    @endphp

                                    @foreach ($months as $index => $month)
                                        <h6>{{ $month }} : {{ $wfhno['jumlah_wfh'][$index] ?? 0 }} DAY</h6>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--End Row-->

      <!--End Dashboard Content-->

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->

    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

	<!--Start footer-->
<!-- 	<footer class="footer"> -->
<!--       <div class="container"> -->
<!--         <div class="text-center"> -->
<!--           Copyright © 2018 Dashtreme Admin -->
<!--         </div> -->
<!--       </div> -->
<!--     </footer> -->
	<!--End footer-->

  <!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>

      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>

      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>

     </div>
   </div>
  <!--end color switcher-->

  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

 <!-- simplebar js -->
  <script src="{{ asset('assets/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- sidebar-menu js -->
  <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
  <!-- loader scripts -->
  {{-- <script src="{{ asset('assets/js/jquery.loading-indicator.js') }}"></script> --}}
  <!-- Custom scripts -->
  <script src="{{ asset('assets/js/app-script.js') }}"></script>
  <!-- Chart js -->

  <script src="{{ asset('assets/plugins/Chart.js/Chart.min.js') }}"></script>

  <!-- Index js -->
  <script src="{{ asset('assets/js/index.js') }}"></script>
  <script src="{{ asset('assets/js/chart.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener("scroll", function() {
            let navbar = document.querySelector(".navbar.fixed-top");
            if (window.scrollY > 50) { // Jika scroll lebih dari 50px
                navbar.classList.add("bg-dark");
            } else {
                navbar.classList.remove("bg-dark");
            }
        });
    });
</script>

  <script>
    const leaveLabels = {!! $leaveLabels !!};
    const leaveData = {!! $leaveData !!};

    const ctx = document.getElementById('chart1').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! $leaveLabels !!},
            datasets: [{
                label: 'JUMLAH CUTI',
                data: {!! $leaveData !!},
                backgroundColor: 'white',
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        color: 'white' // Tukar warna label X ke putih
                    }
                },
                y: {
                    ticks: {
                        color: 'white' // Tukar warna label Y ke putih
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white' // Tukar warna teks label legend ke putih
                    }
                }
            }
        }
    });
</script>
<script>
    var claimData = {!! $claimdata !!};
    var labelBulan = {!! $labelbulan !!};

    console.log("Claim Data:", claimData);
    console.log("Label Bulan:", labelBulan);

    var ctx2 = document.getElementById('chart2').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labelBulan,
            datasets: [{
                label: 'RM',
                data: claimData.jumlah_claim,
                backgroundColor: 'white',
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        color: 'white'
                    }
                },
                y: {
                    ticks: {
                        color: 'white'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            }
        }
    });
</script>
<script>
    var officedata = {!! $officedata !!};
    var labelBulan1 = {!! $labelbulan !!};

    console.log("Claim Data:", officedata);
    console.log("Label Bulan:", labelBulan1);

    var ctx3 = document.getElementById('chart3').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labelBulan1,
            datasets: [{
                label: 'DAY',
                data: officedata.jumlah_attan,
                backgroundColor: 'white',
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        color: 'white'
                    }
                },
                y: {
                    ticks: {
                        color: 'white'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            }
        }
    });
</script>
<script>
    var outdata = {!! $outdata !!};
    var labelBulan2 = {!! $labelbulan !!};

    console.log("Claim Data:", outdata);
    console.log("Label Bulan:", labelBulan2);

    var ctx4 = document.getElementById('chart4').getContext('2d');
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: labelBulan2,
            datasets: [{
                label: 'DAY',
                data: outdata.jumlah_out,
                backgroundColor: 'white',
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        color: 'white'
                    }
                },
                y: {
                    ticks: {
                        color: 'white'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            }
        }
    });
</script>
<script>
    var wfhdata = {!! $wfhdata !!};
    var labelBulan3 = {!! $labelbulan !!};

    console.log("Claim Data:", wfhdata);
    console.log("Label Bulan:", labelBulan3);

    var ctx5 = document.getElementById('chart5').getContext('2d');
    new Chart(ctx5, {
        type: 'bar',
        data: {
            labels: labelBulan3,
            datasets: [{
                label: 'DAY',
                data: wfhdata.jumlah_wfh,
                backgroundColor: 'white',
                borderColor: 'white',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: {
                        color: 'white'
                    }
                },
                y: {
                    ticks: {
                        color: 'white'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            }
        }
    });
</script>
</body>
</html>
