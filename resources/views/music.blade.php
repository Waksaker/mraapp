<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>

  <link rel="stylesheet" href="{{ asset('assets/libs/jquery.dataTables.min.css')}}">

  <style>
    .container-flex {
        width: 100%;
        padding: 10px;
    }
    .table {
        width: 100% !important;
        overflow-x: auto;
    }
</style>


</head>

<body class="bg-theme bg-theme1">

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="{{ route('showlogin')}}">
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
        <span class="user-profile"><img src="{{ asset('assets/images/user-1.jpg')}}" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Profile</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="{{ route('showlogin') }}"><i class="icon-power mr-2"></i> Logout</a></li>
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
            <div class="card-header">LIST MUSIC
                <div class="card-action">
                    <div class="dropdown">
                        <a href="" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-flex">
                    <!-- Chart Section -->
                    <div align="right">
                        <a href="{{ route('downmusic') }}" class="btn btn-primary py-8 fs-4 mb-4 rounded-2">DOMNLOAD MUSIC</a>
                    </div>

                    <div>
                        <table id="example" class="display nowrap">
                            <thead>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center">Name Music</th>
                                <th style="text-align: center">Created</th>
                                <th style="text-align: center">#</th>
                            </thead>
                            <tbody>
                                @if ($musics->isEmpty())
                                        <tr>
                                            <td colspan="4" style="text-align: center; color: red;">Tiada rekod</td>
                                        </tr>
                                    @else
                                        @foreach ($musics as $key => $music)
                                            <tr>
                                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                                <td style="text-align: center;">{{ $music->namesave ?? '-' }}</td>
                                                <td style="text-align: center;">{{ \Carbon\Carbon::parse($music->created_at)->format('d/m/Y') ?? '-' }}</td>
                                                <td style="text-align: center;">
                                                    <a href="{{ url('storage/mp3/' . $music->url) }}" class="btn btn-primary" target="_blank">PLAY</a>
                                                    <a href="" class="btn btn-warning">DOWNLOAD</a>
                                                    <a href="" class="btn btn-danger">DELETE</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>

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
	<footer class="footer">
      <div class="container">
        {{-- <div class="text-center">
          Copyright © 2018 Dashtreme Admin
        </div> --}}
      </div>
    </footer>
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
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- loader scripts -->
  <script src="assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->

  <script src="assets/plugins/Chart.js/Chart.min.js"></script>

  <!-- Index js -->
  <script src="assets/js/index.js"></script>
  <script src="assets/libs/jquery-3.6.0.min.js"></script>
    <script src="assets/libs/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function() {
        $('#example').DataTable({
            scrollX: true,   // Enable horizontal scrolling
            autoWidth: false // Prevent automatic width limitation
        });

        console.log("DataTable Columns:", table.columns().header().toArray());
        console.log("DataTable Rows Count:", table.rows().count());
    });
</script>
</body>
</html>
