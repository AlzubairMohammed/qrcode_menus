@extends('layouts.front', ['class' => ''])

@section('extrameta')
<title>{{ $restorant->name }}</title>
<meta property="og:image" itemprop="image" content="{{ $restorant->logom }}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="590">
<meta property="og:image:height" content="400">
<meta name="og:title" property="og:title" content="{{ $restorant->name }}">
<meta name="description" content="{{ $restorant->description }}">
@if (\Akaunting\Module\Facade::has('googleanalytics'))
    @include('googleanalytics::index') 
@endif

<style>
    /* Expert Design V2 - Cairo Font & Premium Palette */
    @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800;900&display=swap');

    :root {
        --font-primary: 'Cairo', sans-serif;
        --color-bg: #f8f9fe;
        --color-text-dark: #1e293b; /* Slate 800 */
        --color-text-muted: #64748b; /* Slate 500 */
        --color-primary: #10b981; /* Emerald 500 - Fresh & Appetizing */
        --color-accent: #f59e0b; /* Amber 500 - Gold/Premium */
        --shadow-card: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025);
        --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --radius-card: 16px;
    }

    body {
        font-family: var(--font-primary) !important;
        background-color: var(--color-bg);
        color: var(--color-text-dark);
    }

    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        font-family: var(--font-primary);
        font-weight: 700;
        letter-spacing: -0.025em;
    }

    /* Enhanced Hero Section */
    .section-profile-cover {
        height: 550px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .section-profile-cover::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.6) 60%, rgba(0,0,0,0.9) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 10;
        margin-top: -280px;
        padding-bottom: 3rem;
    }

    .restaurant-title {
        font-weight: 900;
        font-size: 4rem;
        color: #fff;
        text-shadow: 0 4px 6px rgba(0,0,0,0.3);
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
    }

    .restaurant-desc {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 650px;
        font-weight: 400;
        line-height: 1.6;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .hero-info-box {
        display: inline-flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 25px;
        padding: 10px 0;
    }

    .hero-info-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 50px;
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: transform 0.2s ease, background 0.2s ease;
    }
    
    .hero-info-item:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
    }
    
    .hero-info-item i {
        color: var(--color-accent);
        font-size: 1.1rem;
    }

    /* Fixed Navigation */
    .tabbable.sticky {
        top: 0;
        z-index: 999; /* Higher z-index for clarity */
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 15px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }

    .nav-pills {
        gap: 10px;
    }

    .nav-pills .nav-link {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 700;
        background: transparent;
        color: var(--color-text-muted);
        transition: all 0.3s ease;
        border: 1px solid transparent;
        font-size: 1rem;
    }
    
    .nav-pills .nav-link:hover {
        background: rgba(0,0,0,0.03);
        color: var(--color-text-dark);
    }

    .nav-pills .nav-link.active {
        background: var(--color-text-dark);
        color: var(--color-accent);
        box-shadow: 0 4px 12px rgba(30, 41, 59, 0.25);
        transform: translateY(-1px);
    }

    /* Premium Search Bar - Refined V2 */
    .itemsSearchHolder {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        min-width: 450px; /* Increased from 280px */
        margin-left: 20px;
        flex: 1; /* Allow it to grow if space permits */
        max-width: 600px; /* Limit max size for large screens */
    }

    .select2-container {
        width: 100% !important; /* Ensure Select2 takes full width of holder */
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 2px solid #f1f5f9; /* Lighter, thicker border */
        border-radius: 50px;
        height: 48px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0 15px;
    }

    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--single {
        border-color: var(--color-primary);
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.1), 0 4px 6px -2px rgba(16, 185, 129, 0.05);
        transform: translateY(-1px);
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: var(--color-text-dark);
        font-family: var(--font-primary);
        font-weight: 700;
        padding-left: 35px !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2310b981' strokewidth='2.5'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: left 2px center;
        background-size: 22px;
        line-height: 44px;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: var(--color-text-muted);
        font-weight: 500;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 46px;
        right: 15px;
    }

    /* Select2 Dropdown Styling */
    .select2-dropdown {
        border: none !important;
        border-radius: 20px !important;
        box-shadow: var(--shadow-hover) !important;
        margin-top: 10px;
        overflow: hidden;
        background: white;
        z-index: 9999;
    }

    .select2-results__option {
        padding: 12px 20px !important;
        font-family: var(--font-primary);
        font-weight: 600;
        color: var(--color-text-dark);
        border-bottom: 1px solid #f8fafc;
        transition: background 0.2s ease;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #f1f5f9 !important;
        color: var(--color-primary) !important;
    }

    .select2-results__group {
        background: #f8fafc;
        color: var(--color-text-muted);
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 8px 20px !important;
    }

    .select2-search--dropdown {
        padding: 15px !important;
    }

    .select2-search--dropdown .select2-search__field {
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        padding: 10px 15px !important;
        font-family: var(--font-primary);
    }

    /* Menu Categories & Cards */
    .menu-category-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--color-text-dark);
        margin: 4rem 0 2rem;
        padding-bottom: 15px;
        position: relative;
        display: inline-block;
    }
    
    .menu-category-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--color-accent);
        border-radius: 2px;
    }

    .strip {
        background: white;
        border-radius: var(--radius-card);
        overflow: hidden;
        border: none;
        box-shadow: var(--shadow-card);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    
    .strip:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-hover);
        z-index: 10;
    }

    .strip figure {
        margin: 0;
        height: 240px;
        overflow: hidden;
        position: relative;
    }

    .strip figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .strip:hover figure img {
        transform: scale(1.1);
    }
    
    /* Image Overlay Gradient */
    .strip figure::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        opacity: 0.6;
        transition: opacity 0.3s;
    }
    
    .strip:hover figure::after {
        opacity: 0.4;
    }

    .strip .res_title {
        padding: 1.25rem 1.25rem 0.5rem;
        font-size: 1.15rem;
        font-weight: 700;
        line-height: 1.3;
    }

    .strip .res_title a {
        color: var(--color-text-dark);
        text-decoration: none;
    }

    .strip .res_description {
        padding: 0 1.25rem 1rem;
        font-size: 0.95rem;
        color: var(--color-text-muted);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }

    .strip .row {
        padding: 0 1.25rem 1.25rem;
        align-items: center;
        margin: 0;
        border-top: 1px solid rgba(0,0,0,0.03);
        padding-top: 15px;
    }

    .res_mimimum {
        font-weight: 800;
        color: var(--color-primary); 
        font-size: 1.35rem;
        letter-spacing: -0.5px;
    }

    .allergen {
        background: #fff;
        border: 1px solid #f1f5f9;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        border-radius: 50%;
        width: 32px;
        height: 32px;
        padding: 5px;
        margin-left: -5px; /* Overlap effect */
        position: relative;
        z-index: 1;
        transition: transform 0.2s;
    }
    
    .allergen:hover {
        transform: scale(1.2) translateY(-2px);
        z-index: 10;
    }

    /* Mobile Enhancements */
    @media (max-width: 991px) {
        .col-md-6, .col-sm-6 {
            padding-left: 8px;
            padding-right: 8px;
        }
        .section-profile-cover {
            height: 400px;
        }
        .hero-content {
            margin-top: -220px;
        }
        .restaurant-title {
            font-size: 2.5rem;
        }
        .hero-info-item {
            padding: 8px 15px;
            font-size: 0.9rem;
        }
        .nav-pills {
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 5px;
            scrollbar-width: none;
        }
        .nav-pills::-webkit-scrollbar {
            display: none; 
        }
        .menu-category-title {
            font-size: 1.75rem;
            margin: 3rem 0 1.5rem;
        }
        
        /* Adjust Search Bar for Mobile */
        .itemsSearchHolder {
            width: 100%;
            margin-top: 10px;
            min-width: 0;
        }
        .select2-container {
            width: 100% !important;
        }
    }
    
    {{ $restorant->getConfig('custom_menu_css','') }}
</style>

{!! $restorant->getConfig('custom_menu_js','') !!}

@endsection

@section('addiitional_button_3')
    @include('restorants.partials.itemsearch')
    @if (\Akaunting\Module\Facade::has('cards') && $restorant->getConfig('enable_loyalty', false))
        <li class="web-menu mr-1">
            <a href="{{ route('loyalty.landing',['alias'=>$restorant->subdomain])}}" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer; border-radius: 50px; font-weight: 700; box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);">
                <span class="btn-inner--icon">
                    <i class="fa fa-id-card-o"></i>
                </span>
                <span class="nav-link-inner--text">{{ __('loyalty.loyalty_program') }}</span>
            </a>
        </li>
        <li class="mobile-menu">
            <a href="{{ route('loyalty.landing',['alias'=>$restorant->subdomain])}}" class="nav-link" >
                <span class="btn-inner--icon">
                  <i class="fa fa-id-card-o"></i>
                </span>
                <span class="nav-link-inner--text">{{  __('loyalty.loyalty_program') }}</span>
            </a>
        </li>
    @endif
@endsection

@section('content') 
<?php
    function clean($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-\p{L}]/u', '', $string); 
     }
?>

@include('restorants.partials.modals')

<!-- Optimized Hero Section -->
<section class="section-profile-cover" style="background-image: url('{{ $restorant->coverm }}');">
</section>

<!-- Content Section -->
<section class="section pt-lg-0 mb--5 mt--9">
    <div class="container hero-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-white text-center text-lg-left">
                    <h1 class="restaurant-title notranslate">{{ $restorant->name }}</h1>
                    <p class="restaurant-desc d-none d-md-block">{{ $restorant->description }}</p>
                    <p class="restaurant-desc d-block d-md-none" style="font-size: 1.1rem; opacity: 1;">{{ $restorant->description }}</p>
                    
                    <div class="hero-info-box">
                       <!-- Opening Status -->
                        <div class="hero-info-item">
                           <i class="ni ni-watch-time"></i>
                           @if(!empty($openingTime))
                               <span class="closed_time">{{__('Opens')}} {{ $openingTime }}</span>
                           @endif 
                           @if(!empty($closingTime))
                               <span class="opened_time">{{__('Opened until')}} {{ $closingTime }}</span> 
                           @endif
                        </div>

                        <!-- Address -->
                        @if(!empty($restorant->address))
                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}" class="hero-info-item text-white text-decoration-none d-none d-md-flex">
                                <i class="ni ni-pin-3"></i>
                                <span class="notranslate">{{ $restorant->address }}</span>
                            </a>
                        @endif

                        <!-- Phone -->
                        @if(!empty($restorant->phone))
                             <a href="tel:{{$restorant->phone}}" class="hero-info-item text-white text-decoration-none">
                                <i class="ni ni-mobile-button"></i>
                                {{ $restorant->phone }}
                             </a>
                        @endif
                    </div>
                </div>
                
                @include('restorants.partials.social_links')
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                @include('partials.flash')
            </div>
            @if (auth()->user()&&auth()->user()->hasRole('admin'))
                <div class="mt-4">
                     @include('restorants.admininfo')
                </div>
            @endif
        </div>
    </div>
</section>

<section class="section pt-0" id="restaurant-content">
    <input type="hidden" id="rid" value="{{ $restorant->id }}"/>
    <div class="container container-restorant">

        @if(!$restorant->categories->isEmpty())
        <!-- Sticky Navigation -->
        <nav class="tabbable sticky" style="top: {{ config('app.isqrsaas') ? 64 : 0 }}px;">
            <ul class="nav nav-pills mb-2 align-items-center">
                <li class="nav-item nav-item-category" id="cat_all">
                    <a class="nav-link mb-sm-3 mb-md-0 active" data-toggle="tab" role="tab" href="">{{ __('All categories') }}</a>
                </li>
                @foreach ( $restorant->categories as $key => $category)
                    @if(!$category->aitems->isEmpty())
                        <li class="nav-item nav-item-category" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                            <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" role="tab" id="{{ 'nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" href="#{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">{{ $category->name }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        @endif

        @if(!$restorant->categories->isEmpty())
        @foreach ( $restorant->categories as $key => $category)
            @if(!$category->aitems->isEmpty())
            <div id="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" class="{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                <h2 class="menu-category-title">{{ $category->name }}</h2>
            </div>
            @endif
            <div class="row {{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                @foreach ($category->aitems as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="strip">
                            @if(!empty($item->image))
                            <figure>
                                <a @if (!($item->qty_management==1 && $item->qty<1)) onClick="setCurrentItem({{ $item->id }})" @endif href="javascript:void(0)">
                                    <img src="{{ $item->logom }}" loading="lazy" data-src="{{ config('global.restorant_details_image') }}" class="lazy" alt="{{ $item->name }}">
                                </a>
                            </figure>
                            @endif
                            
                            <div class="res_title">
                                <a onClick="setCurrentItem({{ $item->id }})" href="javascript:void(0)">
                                    @if ($item->qty_management==1 && $item->qty<1)
                                        <span class="text-danger">[{{ __('Out of stock')}}]</span> 
                                    @endif
                                    {{ $item->name }}
                                </a>
                            </div>

                            <div class="res_description">{{ $item->short_description }}</div>
                            
                            <div class="row w-100 mx-0 mt-auto">
                                <div class="col-8 px-0">
                                    <div class="res_mimimum">
                                        @if ($item->discounted_price>0)
                                            <span class="text-muted mr-1" style="text-decoration: line-through; font-size: 0.9rem;">@money($item->discounted_price, config('settings.cashier_currency'),config('settings.do_convertion'))</span>
                                        @endif
                                        @money($item->price, config('settings.cashier_currency'),config('settings.do_convertion'))
                                    </div>
                                </div>
                                <div class="col-4 px-0 text-right">
                                    <div class="allergens">
                                        @foreach ($item->allergens as $allergen)
                                         <div class='allergen' data-toggle="tooltip" data-placement="bottom" title="{{$allergen->title}}">
                                             <img src="{{$allergen->image_link}}" style="width: 100%; height: 100%; object-fit: contain;" />
                                         </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        @else
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center mt-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/203/203056.png" width="100" style="opacity: 0.5;">
                    <h3 class="text-muted mt-4">{{ __('Hmmm... Nothing found!')}}</h3>
                </div>
            </div>
        @endif
        
        <!-- Check if is installed -->
        @if (isset($doWeHaveImpressumApp) && $doWeHaveImpressumApp)
            @if (strlen($restorant->getConfig('impressum_value',''))>5)
                <div class="mt-5 pt-4 border-top">
                    <h3>{{  __(htmlspecialchars($restorant->getConfig('impressum_title',''))) }}</h3>
                    <?php echo __(htmlspecialchars($restorant->getConfig('impressum_value',''))); ?>
                </div>
            @endif
        @endif

    </div>

    @if( !(isset($canDoOrdering) && !$canDoOrdering) )
        <div onClick="openNav()" class="callOutShoppingButtonBottom icon icon-shape bg-gradient-red text-white rounded-circle shadow mb-4">
            <i class="ni ni-cart"></i>
        </div>
    @endif

</section>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-2">
                        <h4 class="text-center mt-2 mb-3">{{ __('Call Waiter') }}</h4>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="post" action="{{ route('call.waiter') }}">
                            @csrf
                            @if (!isset($_GET['tid']))
                                @include('partials.fields',$fields)
                            @else
                                <input type="hidden" value="{{$_GET['tid']}}" name="table_id"  id="table_id"/>
                            @endif

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Call Now') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if (isset($showGoogleTranslate) && $showGoogleTranslate && !$showLanguagesSelector)
    @include('googletranslate::buttons')
@endif

@if ($showLanguagesSelector)
    @section('addiitional_button_1')
        <div class="dropdown web-menu">
            <a href="#" class="btn btn-neutral dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink2" style="border-radius: 50px; font-weight: 700; color: #111;">
                 {{ $currentLanguage }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="">
                @foreach ($availableLanguages as $langCode => $langName)
                    @if ($langCode != config('app.locale'))
                        <li>
                            <a class="dropdown-item" href="?lang={{ $langCode }}">
                                {{ $langName }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endsection
    @section('addiitional_button_1_mobile')
        <div class="dropdown mobile_menu">
            <a type="button" class="nav-link  dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink2">
                <span class="btn-inner--icon">
                  <i class="fa fa-globe"></i>
                </span>
                <span class="nav-link-inner--text">{{ $currentLanguage }}</span>
              </a>
            <ul class="dropdown-menu" aria-labelledby="">
                @foreach ($availableLanguages as $langCode => $langName)
                    @if ($langCode != config('app.locale'))
                        <li>
                            <a class="dropdown-item" href="?lang={{ $langCode }}">
                                {{ $langName }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endsection
@endif

@section('js')
    <script>
        var CASHIER_CURRENCY = "<?php echo  config('settings.cashier_currency') ?>";
        var LOCALE="<?php echo  App::getLocale() ?>";
        var IS_POS=false;
        var TEMPLATE_USED="<?php echo config('settings.front_end_template','defaulttemplate') ?>";
        var PID = "{{ isset($_GET['pid']) ? $_GET['pid'] : '' }}";
    </script>
    <script src="{{ asset('custom') }}/js/order.js"></script>
    @include('restorants.phporderinterface') 
    @if (isset($showGoogleTranslate) && $showGoogleTranslate && !$showLanguagesSelector)
        @include('googletranslate::scripts')
    @endif
@endsection

@if (isset($showGoogleTranslate) && $showGoogleTranslate && !$showLanguagesSelector)
    @section('head')
        <!-- Style  Google Translate -->
        <link type="text/css" href="{{ asset('custom') }}/css/gt.css" rel="stylesheet">
    @endsection
@endif
