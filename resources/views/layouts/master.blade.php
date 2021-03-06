<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link href="{{ asset('/public/assets/img/apple-icon.png') }}" sizes="76x76" rel="apple-touch-icon">
  <link type="image/png" href="{{ asset('/public/assets/img/Capture.png') }}" rel="icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('/public/assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('/public/assets/demo/demo.css') }}" rel="stylesheet">
  <!-- css links for dashboard -->
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"> -->
           
        
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
          <a href="{{url('/dishes')}}" class="simple-text logo-normal"><img src="{{asset('/public/assets/img/Capture.png')}}" alt="Trulli" width="auto" height="90"></a>
        </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="{{'dashboard' == request()->path() ? 'nav-item active' : ''}}">
            <a class="nav-link" href="{{url('/dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          @can('isAdmin')
          <li class="{{'category/add' == request()->path() ? 'nav-item active' : ''}}">
            <a class="nav-link" href="{{url('/category/add')}}">
                
              <i class="material-icons">content_paste</i>
              <p>Category</p>
            </a>
          </li>
          @endcan
          @can('isAdmin')
            <li><a class="dropdown-btn nav-link">Restaurant 
            <i class="material-icons">local_dining</i>
            <div class="drop_icon"><i class="fa fa-caret-down"></i>
            </div>
            </a>
            <div class="dropdown-container">
            <a class="nav-link" href="{{url('/restaurant/add')}}">
            
            <i class="material-icons">local_dining</i>
            <p>Add Restaurant</p>
            </a>
            <a class="nav-link" href="{{url('/restaurant/lists')}}">
            
            <i class="material-icons">restaurant</i>
            <p>View Restaurant</p>
            </a>
            </div>
            </li>
	 @endcan
	 @can('isAdmin')
	 <li><a class="dropdown-btn nav-link">Menu's 
            <i class="material-icons">menu_book</i>
            <div class="drop_icon"><i class="fa fa-caret-down"></i>
            </div>
            </a>
            <div class="dropdown-container">
            <a class="nav-link" href="{{url('/restaurant/menu/add')}}">
                
              <i class="material-icons">menu_book</i>
              <p>Add Menu's</p>
            </a>
            <a class="nav-link" href="{{url('/menu/lists')}}">
              <i class="material-icons">menu_book</i>
              <p>View Menu's</p>
            </a>
            </div>
            </li>
      @endcan
           
           @can('isAdmin')
	 <li><a class="dropdown-btn nav-link">Dish's 
            <i class="material-icons">library_books</i>
            <div class="drop_icon"><i class="fa fa-caret-down"></i>
            </div>
            </a>
            <div class="dropdown-container">
            <a class="nav-link" href="{{url('/product/add')}}">
              <i class="material-icons">library_books</i>
              <p>Add Dish</p>
            </a>
            <a class="nav-link" href="{{url('/product')}}">
              <i class="material-icons">library_books</i>
              <p>View Dishes</p>
            </a>
            </div>
            </li>
      @endcan
       @can('isManager')
        <li class="{{'product' == request()->path() ? 'nav-item active' : ''}}">
        <a class="nav-link" href="{{url('/product')}}">
        <i class="material-icons">library_books</i>
        <p>View Dish</p>
        </a>
        </li>
     @endcan
      @can('isAdmin')
      <li class="{{'user/roles' == request()->path() ? 'nav-item active' : ''}}">
        <a class="nav-link" href="{{url('/user/roles')}}">
            
          <i class="material-icons">how_to_reg</i>
          <p>Users</p>
        </a>
      </li>
       @endcan
          <!-- <li class="nav-item ">
            <a class="nav-link" href="./notifications.html">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./rtl.html">
              <i class="material-icons">language</i>
              <p>RTL Support</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;"></a>
          </div>
          <!--<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">-->
          <!--  <span class="sr-only">Toggle navigation</span>-->
          <!--  <span class="navbar-toggler-icon icon-bar"></span>-->
          <!--  <span class="navbar-toggler-icon icon-bar"></span>-->
          <!--  <span class="navbar-toggler-icon icon-bar"></span>-->
          <!--</button>-->
          <div class="collapse navbar-collapse justify-content-end">
            <!--<form class="navbar-form">-->
            <!--  <div class="input-group no-border">-->
            <!--    <input type="text" value="" class="form-control" placeholder="Search...">-->
            <!--    <button type="submit" class="btn btn-white btn-round btn-just-icon">-->
            <!--      <i class="material-icons">search</i>-->
            <!--      <div class="ripple-container"></div>-->
            <!--    </button>-->
            <!--  </div>-->
            <!--</form>-->
            <ul class="navbar-nav">
              <!--<li class="nav-item">-->
              <!--  <a class="nav-link" href="javascript:;">-->
              <!--    <i class="material-icons">dashboard</i>-->
              <!--    <p class="d-lg-none d-md-block">-->
              <!--      Stats-->
              <!--    </p>-->
              <!--  </a>-->
              <!--</li>-->
              <!--<li class="nav-item dropdown">-->
              <!--  <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
              <!--    <i class="material-icons">notifications</i>-->
              <!--    <span class="notification">5</span>-->
              <!--    <p class="d-lg-none d-md-block">-->
              <!--      Some Actions-->
              <!--    </p>-->
              <!--  </a>-->
              <!--  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">-->
              <!--    <a class="dropdown-item" href="#">Mike John responded to your email</a>-->
              <!--    <a class="dropdown-item" href="#">You have 5 new tasks</a>-->
              <!--    <a class="dropdown-item" href="#">You're now friend with Andrew</a>-->
              <!--    <a class="dropdown-item" href="#">Another Notification</a>-->
              <!--    <a class="dropdown-item" href="#">Another One</a>-->
              <!--  </div>-->
              <!--</li>-->
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <!--<a class="dropdown-item" href="#">Profile</a>-->
                  @can('isManager')
                  <a class="dropdown-item" href="{{route('restraunt.profile.edit',base64_encode(auth()->user()->id.'/'.time()))}}"><i class="material-icons">person</i>  My Profile</a>
                  @endcan
                  <!--<div class="dropdown-divider"></div>-->
                  <!-- <a class="dropdown-item" href="#">Log out</a> -->
                  <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="material-icons">https</i>  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
      @yield('content')
      </div>
      <footer class="footer">
        <!-- <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="https://creative-tim.com/presentation">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div> -->
      </footer>
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="{{ asset('/assets/js/core/jquery.min.js') }}" defer></script>
  <script src="{{ asset('/public/js/custom.js') }}" defer></script>
  <script src="{{ asset('/assets/js/core/popper.min.js') }}" defer></script>
  <script src="{{ asset('/assets/js/core/bootstrap-material-design.min.js') }}" defer></script>

  <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}" defer></script>
  
  <!-- Plugin for the momentJs  -->
  <script src="{{ asset('/assets/js/plugins/moment.min.js') }}" defer></script>

  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('/assets/js/plugins/sweetalert2.js') }}" defer></script>

  <!-- Forms Validations Plugin -->
  <script src="{{ asset('/assets/js/plugins/jquery.validate.min.js') }}" defer></script>

  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('/assets/js/plugins/jquery.bootstrap-wizard.js') }}" defer></script>

  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('/assets/js/plugins/bootstrap-selectpicker.js') }}" defer></script>

  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('/assets/js/plugins/bootstrap-datetimepicker.min.js') }}" defer></script>

  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{ asset('/assets/js/plugins/jquery.dataTables.min.js') }}" defer></script>

  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('/assets/js/plugins/bootstrap-tagsinput.js') }}" defer></script>

  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('/assets/js/plugins/jasny-bootstrap.min.js') }}" defer></script>

  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ asset('/assets/js/plugins/fullcalendar.min.js') }}" defer></script>

  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('/assets/js/plugins/jquery-jvectormap.js') }}" defer></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('/assets/js/plugins/nouislider.min.js') }}" defer></script>

  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- Library for adding dinamically elements -->
  <script src="{{ asset('/assets/js/plugins/arrive.min.js') }}" defer></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chartist JS -->
  <script src="{{ asset('/assets/js/plugins/chartist.min.js') }}" defer></script>

  <!--  Notifications Plugin    -->
  <script src="{{ asset('/assets/js/plugins/bootstrap-notify.js') }}" defer></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/assets/js/material-dashboard.js?v=2.1.2') }}" defer></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('/assets/demo/demo.js') }}" defer></script>
 <!-- This is for dashboard js! -->
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}" defer></script>
  <script src="{{ asset('js/bootstrap.js') }}" defer></script>

  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
	var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
  </script>
  @yield('scripts')
</body>

</html>