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
        <li class="dropdown-item"><a href="{{ route('viewprofile') }}"><i class="icon-settings mr-2"></i> Profile</a></li>
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
            <div class="card-header">PROFILE
                <div class="card-action">
                    <div class="dropdown">
                        <a href="" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-flex">
                    <form method="POST" enctype="multipart/form-data" action="">
                        <div class="col">
                            <label for="datestart" class="col-sm-2 col-form-label">SIGNATURE IMAGE :</label>
                            <input type="file" name="namefile" value="" onchange="previewImageSign(event)">
                            <div class="container-img">
                                <label for="input-file" id="drop-area">
                                    <div id="img-view">
                                        
                                        
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="customer_records">
                            <div class="row mb-3">
                                <input type="text" class="form-control mb-3" id="date" name="id" value="{{ $user->id ?? '-' }}" style="display: none;">
                                <label for="datestart" class="col-sm-2 col-form-label">NAME :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-3" id="date" name="name" value="{{ $user->name ?? '-' }}">
                                </div>
                                <label for="datestart" class="col-sm-2 col-form-label">PASSWORD :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-1" id="password" name="password" value="{{ $user->password ?? '-' }}">
                                </div>
                                <label for="dateend" class="col-sm-2 col-form-label">EMAIL :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-1" id="purpose" name="email" value="{{ $user->email ?? '-' }}">
                                </div>
                                <label for="datestart" class="col-sm-2 col-form-label">IC :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-3" id="date" name="ic" value="{{ $user->icno ?? '-' }}">
                                </div>
                                <label for="dateend" class="col-sm-2 col-form-label">POSITION :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-1" id="purpose" name="position" value="{{ $user->position ?? '-' }}">
                                </div>
                                <label for="datestart" class="col-sm-2 col-form-label">PHONE NUMBER :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-3" id="date" name="number" value="{{ $user->phoneno ?? '-' }}">
                                </div>
                                <label for="dateend" class="col-sm-2 col-form-label">BANK NAME :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-1" id="purpose" name="bankname" value="{{ $user->bank_name ?? '-' }}">
                                </div>
                                <label for="datestart" class="col-sm-2 col-form-label">ACCOUNT NUMBER :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-3" id="date" name="account" value="{{ $user->acc_no ?? '-' }}">
                                </div>
                                <label for="datestart" class="col-sm-2 col-form-label">STATUS :</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control mb-1" id="purpose" name="status" value="{{ $user->status ?? '-' }}">
                                </div>
                                <label for="datestart" class="col-sm-2 col-form-label">SYARIKAT :</label>
                                <div class="col-sm-4">
                                    <select class="form-control mb-1" name="syarikat" id="syarikat">
                                        <option value="MRA GLOBAL SDN BHD" {{ $user->syarikat == 'MRA GLOBAL SDN BHD' ? 'selected' : '' }}>MRA GLOBAL SDN BHD</option>
                                        <option value="LETILICA SDN BHD" {{ $user->syarikat == 'LETILICA SDN BHD' ? 'selected' : '' }}>LETILICA SDN BHD</option>
                                        <option value="MIM DEFENSE SDN BHD" {{ $user->syarikat == 'MIM DEFENSE SDN BHD' ? 'selected' : '' }}>MIM DEFENSE SDN BHD</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" name="submit">UPDATE</button>
                        </div>
                    </form>

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
</body>
</html>
