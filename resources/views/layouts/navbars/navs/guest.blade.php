<nav id="navbar-main" class="navbar navbar-top navbar-horizontal navbar-expand-md bg-white navbar-dark">

  @if(config('app.isqrsaas') && config('settings.disable_landing') && !(config('settings.hide_register_when_disabled_landing',false)))
  
  <!-- Big Screen with buttton-->
 <div class="container-fluid px-7 d-none d-lg-flex d-lx-flex">
      <a class="navbar-brand" href="/">
        <img src="{{ config('global.site_logo') }}" />
      </a>
      <!--<div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">-->
      @if(config('app.isqrsaas') && config('settings.disable_landing')  )
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          @if(config('settings.enable_miltilanguage_menus'))
              <li class="nav-item">
                @php
                    $availableLanguagesENV = config('settings.front_languages');
                    $exploded = explode(',', $availableLanguagesENV);
                    $availableLanguages = [];
                    for ($i = 0; $i < count($exploded); $i += 2) {
                        $availableLanguages[$exploded[$i]] = $exploded[$i + 1];
                    }
                    $currentLanguage = config('app.locale');
                @endphp
                  <div class="dropdown">
                      <a href="#" class="btn btn-neutral btn-icon" data-toggle="dropdown" role="button">
                        <span class="btn-inner--icon">
                          <i class="fas fa-globe"></i>
                        </span>
                        <span class="nav-link-inner--text">{{ strtoupper($currentLanguage) }}</span>
                      </a>
                      <div class="dropdown-menu">
                          @foreach ($availableLanguages as $short => $lang)
                              <a href="{{ route('front', ['lang' => $short]) }}" class="dropdown-item">
                                {{ $lang }}
                              </a>
                          @endforeach
                      </div>
                  </div>
              </li>
          @endif
          <li class="nav-item ml-lg-4">
            <a href="{{ route('newrestaurant.register') }}" target="_blank" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="fas fa-paper-plane mr-2"></i>
              </span>
              <span class="nav-link-inner--text">{{ __('Register') }}</span>
            </a>
          </li>
        </ul>
      @endif
    </div>
    
    <!-- Small Screen with button-->
    <div class="container-fluid d-flex d-md-flex d-lg-none d-lx-none px-2">
      <a class="navbar-brand" href="/">
        <img src="{{ config('global.site_logo') }}" />
      </a>
      <!--<div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">-->
      @if(config('app.isqrsaas') && config('settings.disable_landing') && !(config('settings.hide_register_when_disabled_landing',false)))
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item ml-lg-4">
            <a href="{{ route('newrestaurant.register') }}" target="_blank" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon">
                <i class="fas fa-paper-plane mr-2"></i>
              </span>
              <span class="nav-link-inner--text">{{ __('Register') }}</span>
            </a>
          </li>
        </ul>
      @endif
    </div>
    


  @else
    <!-- Big Screen just logo -->
    <div class="container-fluid px-7 d-none d-md-none d-lg-block d-lx-block">
      <a class="navbar-brand" href="/">
        <img src="{{ config('global.site_logo') }}" />
      </a>
    </div>

    <!-- Small Screen just logo -->
    <div class="text-center w-100 d-block d-md-block d-lg-none d-lx-none">
        <a class="navbar-brand" href="/">
          <img src="{{ config('global.site_logo') }}" />
        </a>
    </div>
 @endif
  

</nav>
