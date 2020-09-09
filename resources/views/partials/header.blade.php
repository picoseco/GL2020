<header class="banner">
  <nav id="main-menu" class="nav-primary navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="container">

      <a class="navbar-brand" href="{{ home_url('/') }}">
        <img src="@asset('images/Logo_Black_256.png')" width="180" alt="{{ get_bloginfo('name', 'display') }}">
        {{-- <img class="navbar-logo" type="image/svg+xml" src="@asset('images/logo-horizontal.svg')" /> --}}
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="navbar-toggler-icon"></i>
      </button>

      <div class="collapse navbar-collapse text-uppercase py-3xx py-lg-0xx" id="navbarmain">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu($primarymenu) !!}
          {{-- {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav', 'walker' => new \App\wp_bootstrap4_navwalker()]) !!} --}}
        @endif
      </div>

    </div>
  </nav>
</header>
