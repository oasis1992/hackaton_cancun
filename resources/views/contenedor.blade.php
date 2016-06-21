
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/materialize.min.css') }}"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    
    <div class="navbar-fixed">
    <nav class="green">
        <div class="nav-wrapper container">
            <a href="#!" class="brand-logo">Nuevas Frases</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#modalLogin" class="modal-trigger"><i class="mdi-action-perm-identity"></i></a></li>
                <li><a href="#"><i class="mdi-navigation-refresh"></i></a></li>
                <li><a href="#"><i class="mdi-navigation-more-vert"></i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li>
                    <a href="#">
                        <input id="search" type="search" placeholder="search">
                    </a>
                </li>
                
            </ul>
        </div>
    </nav>
</div>
    <body>
@yield('content')


      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js')}}"></script>
      <script>
     $(document).ready(function() {
    $('select').material_select();
  });
  </script>

    @yield('js')
  
    </body>



  </html>