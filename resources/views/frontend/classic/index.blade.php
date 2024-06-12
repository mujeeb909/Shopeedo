@extends('frontend.layouts.app')

@section('content')
    <style>
        @media (max-width: 767px) {
            #flash_deal .flash-deals-baner {
                height: 203px !important;
            }
        }
    </style>
    @php $lang = get_system_language()->code;  @endphp
    <!-- Sliders -->
    <div class="home-banner-area mb-3" style="">
        <div class="container">
            <div class="d-flex flex-wrap position-relative">
                <div class="d-none d-xl-block all-category has-transition" style="color:black;">
                    <div class="px-3 h-100" style="padding-top: 12px;padding-bottom: 12px; width:270px; cursor: pointer;">
                        <div class="d-flex align-items-center justify-content-between p-2">
                            <div>
                                <span class="fw-700 fs-16 mr-3">{{ translate('All CATEGORIE') }}</span>
                                <a href="{{ route('categories.all') }}" class="text-reset">
                                </a>
                            </div>

                        </div>
                        <div>
                            @include('frontend.' . get_setting('homepage_select') . '.partials.category_menu')
                        </div>
                    </div>
                </div>

                <!-- Sliders -->
                <div class="home-slider">
                    @if (get_setting('home_slider_images', null, $lang) != null)
                        <div class="aiz-carousel dots-inside-bottom" data-autoplay="true" data-infinite="true">
                            @php
                                $decoded_slider_images = json_decode(
                                    get_setting('home_slider_images', null, $lang),
                                    true,
                                );
                                $sliders = get_slider_images($decoded_slider_images);
                                $home_slider_links = get_setting('home_slider_links', null, $lang);
                            @endphp
                            @foreach ($sliders as $key => $slider)
                                <div class="carousel-box" style="max-height:350px">
                                    <a
                                        href="{{ isset(json_decode($home_slider_links, true)[$key]) ? json_decode($home_slider_links, true)[$key] : '' }}">
                                        <!-- Image -->
                                        <img class="d-block mw-100 img-fit overflow-hidden h-180px h-md-320px h-lg-460px overflow-hidden"
                                            src="{{ $slider ? my_asset($slider->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                            alt="{{ env('APP_NAME') }} promo"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Deal -->
    @php
        $flash_deal = get_featured_flash_deal();
    @endphp
    @if ($flash_deal != null)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3" id="flash_deal">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex flex-wrap mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="d-inline-block">{{ translate('Flash Sale') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"
                            class="ml-3">
                            <path id="Path_28795" data-name="Path 28795"
                                d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"
                                transform="translate(-15 -5)" fill="#fcc201" />
                        </svg>
                    </h3>
                    <!-- Links -->
                    {{-- <div>
                        <div class="text-dark d-flex align-items-center mb-0">
                            <a href="{{ route('flash-deals') }}"
                                class="fs-10 fs-md-12 fw-700 text-reset has-transition opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary mr-3">{{ translate('View All Flash Sale') }}</a>
                            <span class=" border-left border-soft-light border-width-2 pl-3">
                                <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                                    class="fs-10 fs-md-12 fw-700 text-reset has-transition opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary">{{ translate('View All Products from This Flash Sale') }}</a>
                            </span>
                        </div>
                    </div> --}}
                </div>

                <!-- Countdown for small device -->
                <div class="bg-white mb-3 d-md-none">
                    <div class="aiz-count-down-circle" end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                </div>

                <div class="row gutters-5 gutters-md-16">
                    <!-- Flash Deals Baner & Countdown -->
                    <div class="flash-deals-baner col-xxl-4 col-lg-5 col-6 h-200px h-md-400px h-lg-475px">
                        <div class="h-100 w-100 w-xl-auto"
                            style="background-image: url('{{ uploaded_asset($flash_deal->banner) }}'); background-size: cover; background-position: center center;">
                            <div class="py-5 px-md-3 px-xl-5 d-none d-md-block">
                                <div class="bg-white">
                                    <div class="aiz-count-down-circle"
                                        end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Flash Deals Products -->
                    <div class="col-xxl-8 col-lg-7 col-6">
                        @php
                            $flash_deal_products = get_flash_deal_products($flash_deal->id);
                        @endphp
                        <div class="aiz-carousel border-top @if (count($flash_deal_products) > 8) border-right @endif arrow-inactive-none arrow-x-0"
                            data-rows="2" data-items="5" data-xxl-items="5" data-xl-items="3.5" data-lg-items="3"
                            data-md-items="2" data-sm-items="2.5" data-xs-items="1.7" data-arrows="true" data-dots="false">
                            @foreach ($flash_deal_products as $key => $flash_deal_product)
                                <div class="carousel-box border-left border-bottom">
                                    @if ($flash_deal_product->product != null && $flash_deal_product->product->published != 0)
                                        @php
                                            $product_url = route('product', $flash_deal_product->product->slug);
                                            if ($flash_deal_product->product->auction_product == 1) {
                                                $product_url = route(
                                                    'auction-product',
                                                    $flash_deal_product->product->slug,
                                                );
                                            }
                                        @endphp
                                        <div
                                            class="h-100px h-md-200px h-lg-auto flash-deal-item position-relative text-center has-transition hov-shadow-out z-1">
                                            <a href="{{ $product_url }}"
                                                class="d-block py-md-3 overflow-hidden hov-scale-img"
                                                title="{{ $flash_deal_product->product->getTranslation('name') }}">
                                                <!-- Image -->
                                                <img src="{{ get_image($flash_deal_product->product->thumbnail) }}"
                                                    class="lazyload h-60px h-md-100px h-lg-140px mw-100 mx-auto has-transition"
                                                    alt="{{ $flash_deal_product->product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                <!-- Price -->
                                                <div
                                                    class="fs-10 fs-md-14 mt-md-3 text-center h-md-48px has-transition overflow-hidden pt-md-4 flash-deal-price lh-1-5">
                                                    <span
                                                        class="d-block text-primary fw-700">{{ home_discounted_base_price($flash_deal_product->product) }}</span>
                                                    @if (home_base_price($flash_deal_product->product) != home_discounted_base_price($flash_deal_product->product))
                                                        <del
                                                            class="d-block fw-400 text-secondary">{{ home_base_price($flash_deal_product->product) }}</del>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Today's deal -->
    <div id="todays_deal" class="mb-2 mb-md-3 mt-2 mt-md-3">

    </div>

    <!-- Featured Categories -->
    @if (count($featured_categories) > 0)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <div class="bg-white">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Featured Categories') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('categories.all') }}">{{ translate('View All Categories') }}</a>
                        </div>
                    </div>
                </div>
                <!-- Categories -->
                <div class="bg-white px-3">
                    <div class="row border-top border-right">
                        @foreach ($featured_categories->take(6) as $key => $category)
                            @php
                                $category_name = $category->getTranslation('name');
                            @endphp
                            <div class="col-xl-4 col-md-6 border-left border-bottom py-3 py-md-2rem">
                                <div class="d-sm-flex text-center text-sm-left">
                                    <div class="mb-3">
                                        <img src="{{ isset($category->bannerImage->file_name) ? my_asset($category->bannerImage->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                            class="lazyload w-150px h-auto mx-auto has-transition"
                                            alt="{{ $category->getTranslation('name') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </div>
                                    <div class="px-2 px-lg-4">
                                        <h6 class="text-dark mb-0 text-truncate-2">
                                            <a class="text-reset fw-700 fs-14 hov-text-primary"
                                                href="{{ route('products.category', $category->slug) }}"
                                                title="{{ $category_name }}">
                                                {{ $category_name }}
                                            </a>
                                        </h6>
                                        @foreach ($category->childrenCategories->take(5) as $key => $child_category)
                                            <p class="mb-0 mt-3">
                                                <a href="{{ route('products.category', $child_category->slug) }}"
                                                    class="fs-13 fw-300 text-reset hov-text-primary animate-underline-primary">
                                                    {{ $child_category->getTranslation('name') }}
                                                </a>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Banner section 1 -->
    @php $homeBanner1Images = get_setting('home_banner1_images', null, $lang);   @endphp
    @if ($homeBanner1Images != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_1_imags = json_decode($homeBanner1Images);
                    $data_md = count($banner_1_imags) >= 2 ? 2 : 1;
                    $home_banner1_links = get_setting('home_banner1_links', null, $lang);
                @endphp
                <div class="w-100">
                    <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                        data-items="{{ count($banner_1_imags) }}" data-xxl-items="{{ count($banner_1_imags) }}"
                        data-xl-items="{{ count($banner_1_imags) }}" data-lg-items="{{ $data_md }}"
                        data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                        data-dots="false">
                        @foreach ($banner_1_imags as $key => $value)
                            <div class="carousel-box overflow-hidden hov-scale-img">
                                <a href="{{ isset(json_decode($home_banner1_links, true)[$key]) ? json_decode($home_banner1_links, true)[$key] : '' }}"
                                    class="d-block text-reset overflow-hidden">
                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                        data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                        class="img-fluid lazyload w-100 has-transition"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Featured Products -->
    <div id="section_featured">

    </div>

    <!-- Banner Section 2 -->
    @php $homeBanner2Images = get_setting('home_banner2_images', null, $lang);   @endphp
    @if ($homeBanner2Images != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_2_imags = json_decode($homeBanner2Images);
                    $data_md = count($banner_2_imags) >= 2 ? 2 : 1;
                    $home_banner2_links = get_setting('home_banner2_links', null, $lang);
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_2_imags) }}" data-xxl-items="{{ count($banner_2_imags) }}"
                    data-xl-items="{{ count($banner_2_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ isset(json_decode($home_banner2_links, true)[$key]) ? json_decode($home_banner2_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <div class="container">
        <h6>Hot Deal Today</h6>
        <div class="line"></div>
        <div class="row">
            <div class="col-lg-3 col-md-6 pt-4 feature-products">
                <div class="d-flex flex-column align-items-center border border-dark pt-5"
                    style="max-width:300px; max-height:500px;">
                    <img src="{{ static_asset('assets/img/tv.jpg') }}" width="200" alt="">
                    <p>Product 002</p>
                    <p class="price">150.000</p>
                    <p>(87)</p>
                </div>
            </div>
            <div class="col-lg-9 col-md-6 pt-4">
                <div class="row">

                    <div class="col-md-4 col-sm-12 mb-3">
                        <div class="d-flex border border-dark p-3 h-100">
                            <svg width="55" height="53" viewBox="0 0 55 53" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.21 3.96C22.24 3.86 22.27 3.75995 22.3 3.65995C22.38 3.50995 22.45 3.36 22.53 3.21C22.65 3.05 22.78 2.88996 22.9 2.72996C22.96 2.66996 23.02 2.60996 23.08 2.54996C23.43 2.37996 23.78 2.20995 24.12 2.03995C24.18 2.01995 24.25 1.98995 24.31 1.96995C26.02 1.65995 27.74 1.81 29.46 1.78C30.36 1.76 31.16 2.06 31.84 2.65C31.94 2.75 32.03 2.83998 32.13 2.93998C32.19 3.02998 32.26 3.12995 32.32 3.21995C32.45 3.56995 32.59 3.90998 32.72 4.25998C32.87 5.37998 33.03 6.50998 33.18 7.62998C33.21 7.84998 33.16 8.2 33.29 8.28C33.59 8.47 33.97 8.53 34.31 8.65L34.42 8.71995C34.55 8.77995 34.68 8.84995 34.81 8.90995C34.86 8.93995 34.92 8.96998 34.97 9.00998C35.04 9.01998 35.11 9.02995 35.18 9.03995C35.37 9.12995 35.56 9.22998 35.75 9.31998C36.23 9.61998 36.32 9.02998 36.63 8.93998C36.69 8.87998 36.76 8.80997 36.82 8.74997C37.04 8.58997 37.26 8.42999 37.49 8.26999C37.55 8.20999 37.62 8.13999 37.68 8.07999C37.9 7.91999 38.12 7.75995 38.35 7.59995C38.42 7.52995 38.49 7.45999 38.57 7.38999C38.61 7.37999 38.66 7.35995 38.7 7.34995C38.83 7.26995 38.97 7.18996 39.1 7.10996C39.17 7.04996 39.24 6.98997 39.3 6.92997C39.39 6.86997 39.49 6.80997 39.58 6.74997C39.87 6.62997 40.16 6.45995 40.46 6.40995C40.66 6.36995 40.89 6.48995 41.1 6.53995C41.42 6.57995 41.73 6.61995 42.05 6.65995C42.18 6.71995 42.31 6.77995 42.43 6.84995C42.56 6.91995 42.68 6.97996 42.81 7.04996C44.08 8.31996 45.35 9.58995 46.62 10.85C46.69 10.98 46.75 11.1 46.82 11.23C46.92 11.52 47.03 11.8 47.13 12.09C47.07 12.14 47.01 12.2 46.97 12.23C47.06 12.34 47.14 12.45 47.23 12.56C47.49 13.11 46.96 13.5 46.94 13.99C46.87 14.11 46.8 14.24 46.73 14.36C46.57 14.58 46.41 14.81 46.25 15.03C46.16 15.16 46.06 15.2899 45.97 15.4099C45.84 15.5699 45.71 15.73 45.59 15.89C45.5 16.02 45.4 16.15 45.31 16.27C45.18 16.43 45.06 16.58 44.93 16.74C44.9 16.74 44.87 16.74 44.84 16.76H44.61C44.63 16.82 44.64 16.88 44.66 16.95L44.64 17.13C44.55 17.22 44.45 17.3199 44.36 17.4099C44.33 17.5099 44.29 17.61 44.26 17.71C44.36 17.96 44.47 18.2199 44.57 18.4699C44.6 18.5599 44.62 18.65 44.65 18.73C44.69 18.77 44.73 18.8099 44.77 18.85L44.84 18.95C44.84 18.95 44.84 19.01 44.86 19.04C44.89 19.07 44.91 19.11 44.94 19.14C44.97 19.24 44.99 19.34 45.02 19.44C45.06 19.56 45.1 19.68 45.14 19.8L45.25 19.99C45.34 20.14 45.42 20.3 45.51 20.45C45.57 20.48 45.64 20.51 45.7 20.55H46.18C46.28 20.58 46.37 20.61 46.47 20.65C46.63 20.65 46.79 20.65 46.95 20.65C47.08 20.65 47.2 20.65 47.33 20.65C47.46 20.68 47.58 20.72 47.71 20.75C48.25 20.81 48.79 20.88 49.33 20.94C49.71 21.1 50.1 21.26 50.48 21.42C50.44 21.79 50.68 21.83 50.96 21.81C50.93 22.09 50.98 22.33 51.35 22.29C51.45 22.48 51.55 22.67 51.64 22.87C51.64 22.93 51.62 23 51.61 23.06C51.59 23.08 51.56 23.1 51.54 23.12C51.56 23.13 51.58 23.1399 51.61 23.1599C51.67 23.2199 51.74 23.29 51.8 23.35C51.8 25.28 51.8 27.22 51.8 29.15C51.75 29.28 51.69 29.41 51.64 29.54C51.51 29.8 51.37 30.05 51.24 30.31C50.91 30.17 50.97 30.42 50.96 30.6C50.9 30.66 50.83 30.72 50.77 30.79C50.7 30.86 50.64 30.92 50.57 30.99C50.38 31.11 50.19 31.2299 49.99 31.35C49.51 31.42 49.02 31.48 48.54 31.56C47.78 31.68 47.02 31.94 46.28 31.89C45.67 31.85 45.34 31.95 45.15 32.51C45.06 32.57 44.96 32.64 44.87 32.7C44.92 32.76 44.98 32.82 45.03 32.88C45 33.01 44.97 33.13 44.94 33.26C44.85 33.48 44.75 33.71 44.66 33.93C44.53 34.18 44.4 34.44 44.28 34.69L44.38 34.98C44.47 35.08 44.56 35.17 44.65 35.27C44.65 35.33 44.67 35.39 44.68 35.45C44.67 35.52 44.66 35.5899 44.65 35.6599L44.86 35.64C44.86 35.64 44.91 35.65 44.94 35.65C45.07 35.81 45.2 35.97 45.33 36.14C45.33 36.2 45.34 36.25 45.35 36.31C45.34 36.38 45.33 36.45 45.32 36.52C45.39 36.52 45.46 36.5 45.53 36.5C45.56 36.5 45.58 36.51 45.61 36.51C45.74 36.73 45.88 36.95 46.01 37.17C45.99 37.23 45.98 37.3 45.96 37.36C46.04 37.36 46.11 37.36 46.19 37.36C46.31 37.52 46.44 37.68 46.56 37.84C46.59 37.91 46.62 37.97 46.66 38.04C46.81 38.33 47.04 38.61 47.1 38.92C47.16 39.24 47.46 39.62 47.07 39.94C47.03 40.29 47 40.64 46.96 40.99L46.69 41.38C46.28 41.36 46.18 41.6 46.2 41.96C45.19 42.97 44.17 43.99 43.16 45C43.1 45.06 43.03 45.13 42.97 45.19C42.77 45.34 42.58 45.5 42.38 45.65C42.16 45.72 41.94 45.79 41.72 45.87C41.08 45.89 40.44 46.08 39.81 45.77C39.71 45.7 39.62 45.64 39.52 45.57C39.54 45.07 39.13 45.18 38.85 45.09C38.79 45.05 38.72 45.0099 38.66 44.9699C38.62 44.9399 38.59 44.92 38.55 44.89C38.43 44.79 38.31 44.69 38.19 44.59C38.1 44.5 38.01 44.4 37.91 44.31C37.87 44.08 37.87 43.81 37.52 44.04C37.43 44 37.33 43.96 37.24 43.93C37.17 43.84 37.11 43.76 37.04 43.67C37.02 43.43 37.04 43.14 36.66 43.38C36.63 43.37 36.6 43.36 36.57 43.36C36.51 43.33 36.44 43.3 36.38 43.26C35.97 42.65 35.67 43.2599 35.32 43.3499C35.19 43.3899 35.07 43.43 34.94 43.48C34.9 43.5 34.87 43.53 34.83 43.55C34.74 43.59 34.65 43.63 34.56 43.67C34.43 43.7 34.31 43.73 34.18 43.76C34.1 43.71 34.01 43.6499 33.93 43.5999C33.93 43.68 33.91 43.7699 33.9 43.8499C33.75 43.9199 33.58 43.95 33.46 44.05C33.36 44.14 33.31 44.2899 33.24 44.4099C33.15 44.4599 33.06 44.51 32.97 44.57C33.03 44.68 33.08 44.78 33.14 44.89C33.14 45.02 33.14 45.14 33.14 45.27C33.11 45.37 33.08 45.46 33.04 45.56C33.01 45.76 32.98 45.9599 32.96 46.1599C32.89 46.7899 32.82 47.42 32.75 48.04C32.59 48.42 32.43 48.81 32.27 49.19C31.92 49.16 31.9 49.41 31.86 49.65C31.59 49.65 31.36 49.69 31.4 50.05C31.16 50.14 30.92 50.27 30.67 50.32C30.47 50.36 30.25 50.3 30.25 50.61H24.72C24.65 50.49 24.59 50.37 24.52 50.25C24.46 50.33 24.4 50.41 24.34 50.5C23.82 50.34 23.33 50.15 23 49.68C23.18 49.24 22.9 49.1399 22.56 49.0999C22.52 49.0099 22.48 48.91 22.43 48.82C22.4 48.79 22.38 48.7499 22.35 48.7199C22.29 48.3999 22.22 48.08 22.16 47.77C22.4 47.59 22.39 47.53 22.06 47.39C22.06 47.23 22.04 47.07 22.04 46.92C22.02 46.86 21.99 46.79 21.97 46.73C21.9 46.09 21.84 45.46 21.77 44.82C21.73 44.76 21.7 44.69 21.66 44.63C21.81 44.19 21.47 44.1099 21.19 43.9699C21.19 43.3299 20.76 43.73 20.51 43.69C20.06 43.51 19.62 43.31 19.17 43.15C19.01 43.09 18.76 43.07 18.65 43.15C17.83 43.76 17.04 44.4 16.24 45.03C16.2 45.06 16.17 45.08 16.13 45.11C15.96 45.24 15.79 45.38 15.61 45.49C14.35 46.26 13.39 46.17 12.33 45.49C12.3 44.95 12.18 44.85 11.76 45.01C10.74 43.99 9.73002 42.98 8.71002 41.96C8.66002 41.73 8.88001 41.29 8.32001 41.48L7.78003 40.24C7.83003 40.16 7.88 40.08 7.94 40C7.85 39.95 7.76999 39.91 7.67999 39.86C7.64999 39.27 7.84001 38.74 8.14001 38.24C8.70001 38.25 8.54002 37.7399 8.71002 37.4699C9.09002 36.9599 9.46998 36.45 9.84998 35.95C9.90998 35.89 9.97998 35.82 10.04 35.76C10.16 35.71 10.27 35.66 10.39 35.61C10.34 35.56 10.3 35.51 10.25 35.45C10.4 35.24 10.56 35.0299 10.69 34.8499C10.44 34.2199 10.19 33.62 9.95001 33.01C9.97001 32.9 9.99001 32.79 10.01 32.68C9.96001 32.7 9.90999 32.71 9.85999 32.73C9.61999 32.1966 9.19001 31.9367 8.57001 31.95C8.57001 31.95 8.49 31.9199 8.44 31.9099C7.59 31.7999 6.73 31.72 5.88 31.56C5.39 31.46 4.92 31.23 4.44 31.05C4.43 31.05 4.42998 31.02 4.41998 31.01C4.50998 30.63 4.44 30.57 4 30.7C3.98 30.7 3.96002 30.6799 3.96002 30.6599C4.07002 30.3599 4.14002 30.09 3.65002 30.25C3.51002 29.96 3.35997 29.68 3.21997 29.39C3.29997 29.33 3.38002 29.27 3.46002 29.2C3.34002 29.14 3.21998 29.07 3.09998 29.01C3.09998 28.98 3.09998 28.9499 3.09998 28.9099V28.62C3.09998 26.9 3.09998 25.1899 3.09998 23.4699C3.15998 23.3699 3.22002 23.28 3.27002 23.18C3.23002 22.63 3.58999 22.26 3.85999 21.86C3.91999 21.82 3.97998 21.78 4.03998 21.74C4.42998 21.89 4.51 21.83 4.62 21.3C4.94 21.19 5.26001 21.08 5.57001 20.98C6.22001 20.94 6.88 20.98 7.5 20.67C7.74 20.55 8.08 20.64 8.38 20.62C8.75 20.59 9.11999 20.55 9.48999 20.52C9.60999 20.26 9.72998 20.01 9.84998 19.75C9.89998 19.77 9.95 19.78 10 19.8L9.94 19.4699V19.29C10.07 19 10.19 18.71 10.31 18.42C10.44 18.17 10.56 17.9099 10.69 17.6599C10.58 17.5299 10.46 17.4 10.35 17.27C10.33 17.21 10.31 17.15 10.29 17.08C10.61 16.68 10.31 16.7 10.04 16.71C9.91998 16.55 9.78998 16.39 9.66998 16.24C9.88998 15.86 9.64999 15.84 9.35999 15.85C9.27999 15.79 9.18999 15.7199 9.10999 15.6599C9.06999 15.5699 9.04 15.48 9 15.39C9.22 15.01 8.98 14.99 8.69 15C8.61 14.94 8.52 14.87 8.44 14.81C8.37 14.68 8.30999 14.55 8.23999 14.42C8.10999 14.23 7.98999 14.04 7.85999 13.85C7.81999 13.66 7.77999 13.48 7.73999 13.29C7.73999 13.23 7.73999 13.16 7.73999 13.1C7.73999 12.91 7.76002 12.72 7.77002 12.53C7.77002 12.42 7.76 12.32 7.75 12.21C7.74 12.17 7.73002 12.14 7.71002 12.1C7.79002 11.89 7.87001 11.6799 7.95001 11.4699C8.05001 11.3299 8.15 11.2 8.25 11.06C8.34 11.01 8.45 10.9799 8.5 10.9099C9.34 9.58995 10.58 8.63997 11.67 7.55997C12.02 7.57997 12.34 7.53998 12.32 7.06998C12.35 7.00998 12.39 6.96 12.42 6.9C12.74 6.81 13.05 6.70997 13.37 6.61997L13.75 6.49997C13.94 6.49997 14.13 6.52 14.32 6.53C14.42 6.55 14.51 6.57995 14.61 6.59995C14.83 6.66995 15.05 6.73998 15.27 6.81998C15.4 6.93998 15.53 7.05996 15.65 7.16996C15.78 7.23996 15.91 7.30998 16.05 7.37998C16.08 7.40998 16.1 7.44995 16.13 7.47996C16.32 7.59996 16.51 7.72995 16.7 7.84995C16.77 7.91995 16.84 7.97996 16.91 8.04996C16.94 8.07996 16.96 8.12 16.99 8.15C17.21 8.3 17.44 8.44995 17.66 8.59995C17.7 8.63995 17.73 8.67995 17.77 8.71995C17.8 8.74995 17.82 8.78998 17.85 8.81998C18.04 8.93998 18.23 9.06998 18.42 9.18998C18.48 9.21998 18.54 9.25995 18.6 9.28995C18.74 9.34995 18.89 9.48 19.02 9.46C19.24 9.42 19.45 9.28999 19.66 9.19999L19.94 9.06998C19.94 9.06998 19.99 9.01997 20.02 8.99997L20.52 8.71995C20.62 8.68995 20.71 8.65998 20.81 8.62998C21.08 8.54998 21.36 8.48 21.62 8.4C21.66 8.2 21.7 8.02995 21.74 7.84995C21.74 7.78995 21.74 7.71995 21.74 7.65995C21.9 6.73995 22.08 5.82995 22.22 4.90995C22.25 4.68995 22.18 4.45996 22.15 4.22996C22.17 4.16996 22.2 4.09995 22.22 4.03995L22.21 3.96ZM43 36.4699C42.94 36.4099 42.87 36.34 42.81 36.28L42.33 35.61C42.58 35.19 42.33 35.09 41.98 35.03C42.07 34.7 42.13 34.35 42.26 34.03C42.41 33.67 42.66 33.3399 42.81 32.9699C43.03 32.4599 43.19 31.92 43.38 31.4C43.53 31.27 43.68 31.14 43.81 31C43.82 30.99 43.67 30.83 43.6 30.74C43.8 30.31 44.02 29.9399 44.6 30.1599C44.64 30.1699 44.7 30.1 44.76 30.09C45.26 29.96 45.76 29.78 46.27 29.71C46.95 29.62 47.64 29.65 48.32 29.59C48.65 29.56 48.98 29.45 49.31 29.38C49.33 29.36 49.36 29.33 49.38 29.31C49.75 28.96 49.88 28.55 49.87 28.04C49.85 26.79 49.87 25.53 49.87 24.28C49.87 23.8 49.77 23.35 49.39 23.02C49.37 23 49.34 22.97 49.32 22.95C49.28 22.91 49.24 22.87 49.2 22.83C49.18 22.81 49.15 22.78 49.13 22.76C48.73 22.97 48.29 22.83 47.89 22.81C47.19 22.78 46.49 22.63 45.8 22.53C45.73 22.41 45.66 22.3 45.59 22.18L45.42 22.43C45.29 22.43 45.17 22.43 45.04 22.43C44.97 22.31 44.9 22.2 44.83 22.08C44.77 22.16 44.72 22.25 44.66 22.33C44.19 22.34 43.86 22.13 43.69 21.68L43.86 21.35C43.74 21.3 43.62 21.25 43.5 21.2C43.44 21.01 43.38 20.82 43.31 20.63C43.33 20.49 43.35 20.35 43.37 20.21C43.32 20.23 43.27 20.24 43.22 20.26C43.09 19.91 42.96 19.55 42.82 19.2C42.79 19.14 42.77 19.09 42.74 19.03L42.26 18.25L42.41 17.89H42.07C42.04 17.72 42.02 17.55 41.99 17.39C42.36 17.3 42.55 17.11 42.35 16.71C42.48 16.55 42.6 16.4 42.73 16.24C43 16.24 43.19 16.18 43.02 15.85C43.04 15.79 43.04 15.72 43.07 15.68C43.59 15.01 44.12 14.34 44.64 13.67C44.69 13.63 44.74 13.6 44.79 13.56C44.75 13.53 44.7 13.5 44.66 13.48C44.66 13.42 44.66 13.35 44.66 13.29C44.81 13.22 44.96 13.16 45.12 13.09C45.1 12.68 45.21 12.2599 44.84 11.9099C43.79 10.8899 42.76 9.82997 41.71 8.80997C41.55 8.65997 41.28 8.56995 41.06 8.53995C40.38 8.43995 39.98 8.97997 39.5 9.30997C39.46 9.33997 39.43 9.35999 39.39 9.38999C39.14 9.58999 38.89 9.77996 38.64 9.97996C38.6 10.01 38.57 10.03 38.53 10.06C38 10.48 37.46 10.9 36.93 11.32L36.82 11.4C36.42 11.74 36.04 11.74 35.55 11.52C34.38 10.99 33.17 10.53 31.97 10.05L31.77 9.97996C31.62 9.80996 31.38 9.66996 31.32 9.47996C31.2 9.11996 31.19 8.72996 31.13 8.35996C31.17 8.32996 31.22 8.29998 31.26 8.25998C31.18 8.22998 31.11 8.19996 31.03 8.16996C31.01 7.66996 31.01 7.15995 30.97 6.65995C30.91 5.94995 30.81 5.24 30.72 4.46C30.34 4.35 30.11 3.77996 29.5 3.79996C28.09 3.83996 26.67 3.78999 25.26 3.82999C24.95 3.83999 24.65 4.10998 24.34 4.25998C24.25 4.35998 24.16 4.44996 24.07 4.54996C24.07 4.79996 24.07 5.04996 24.05 5.29996C23.93 6.40996 23.81 7.51998 23.67 8.62998C23.61 9.10998 23.61 9.66997 23.1 9.92997C22.68 10.14 22.22 10.26 21.77 10.4C21.3 10.54 20.83 10.65 20.36 10.78C20.33 10.78 20.32 10.83 20.29 10.85C20.09 11.02 19.91 11.25 19.67 11.35C19.18 11.56 18.7 11.9399 18.13 11.4699C17.45 10.9099 16.73 10.39 16.04 9.84C15.85 9.69 15.71 9.49998 15.54 9.31998C15.48 9.27998 15.43 9.25 15.37 9.21C15.15 9.07 14.91 8.94995 14.71 8.78995C14.28 8.44995 13.84 8.47995 13.37 8.65995C13.34 8.67995 13.3 8.70996 13.27 8.72996C12.23 9.75996 11.19 10.79 10.15 11.82C9.61002 12.36 9.60003 12.93 10.09 13.5C10.19 13.61 10.26 13.75 10.35 13.88C10.1 14.27 10.4 14.24 10.64 14.26C10.77 14.42 10.89 14.58 11.02 14.74C10.88 15.04 10.92 15.08 11.31 15.12C11.44 15.28 11.56 15.44 11.69 15.6C11.67 15.66 11.66 15.73 11.64 15.79C11.72 15.79 11.79 15.79 11.87 15.79C12.03 16.01 12.19 16.24 12.36 16.46C12.34 16.52 12.33 16.58 12.31 16.64C12.4 16.65 12.49 16.66 12.58 16.67C12.6 16.67 12.61 16.6899 12.62 16.7199C12.47 17.0499 12.52 17.31 12.91 17.42C12.88 17.58 12.86 17.7399 12.83 17.9099C12.75 17.9099 12.67 17.92 12.58 17.93C12.62 18.02 12.67 18.11 12.71 18.2C12.31 19.12 11.9 20.04 11.5 20.95C11.18 21.12 11 21.32 11.28 21.67C11.09 22.05 10.83 22.25 10.36 22.3C9.21999 22.43 8.09001 22.67 6.95001 22.84C6.60001 22.89 6.23 22.86 5.87 22.87C5.78 22.9 5.69999 22.92 5.60999 22.95C5.43999 23.22 5.14001 23.48 5.14001 23.76C5.10001 25.28 5.14 26.8 5.13 28.32C5.13 28.84 5.55001 29.06 5.76001 29.42C5.80001 29.49 5.94999 29.51 6.04999 29.52C6.65999 29.59 7.27 29.6399 7.88 29.7199C8.75 29.8299 9.61999 29.97 10.49 30.09C10.87 30.14 11.14 30.32 11.27 30.7C11.32 30.85 11.36 30.99 11.41 31.14C11.5 31.4 11.59 31.6499 11.68 31.9099C11.65 31.9599 11.63 32.01 11.6 32.06C11.66 32.07 11.72 32.09 11.78 32.1C12.02 32.64 12.28 33.18 12.49 33.73C12.66 34.16 13.05 34.53 12.91 35.06C12.61 35.1 12.45 35.2299 12.65 35.54C12.39 35.8899 12.13 36.24 11.88 36.59C11.8 36.59 11.73 36.59 11.65 36.59C11.67 36.65 11.68 36.72 11.7 36.78C11.54 37 11.38 37.23 11.21 37.45C11.13 37.45 11.06 37.45 10.98 37.45C11 37.51 11.01 37.58 11.03 37.64C10.87 37.86 10.71 38.09 10.54 38.31C10.46 38.31 10.39 38.31 10.31 38.31C10.33 38.37 10.34 38.44 10.36 38.5C10.27 38.63 10.2 38.76 10.1 38.88C9.66998 39.38 9.63998 40.0099 10.1 40.4699C11.15 41.5399 12.23 42.59 13.3 43.64C13.33 43.66 13.37 43.69 13.4 43.71C13.74 43.97 14.09 44.01 14.46 43.76C14.68 43.62 14.9 43.47 15.11 43.33C15.49 43.57 15.47 43.28 15.49 43.04C15.65 42.91 15.81 42.7899 15.97 42.6599C16.27 42.7999 16.31 42.76 16.35 42.37L16.83 41.99C17.24 42.26 17.21 41.96 17.21 41.7C17.37 41.57 17.53 41.45 17.69 41.32C18.01 41.44 18.54 41.17 18.74 40.77C18.87 40.77 18.99 40.77 19.12 40.77C19.12 41.15 19.31 41.19 19.61 41.04C19.86 41.17 20.11 41.29 20.37 41.42L20.72 41.56C21.24 41.77 21.76 41.98 22.28 42.19C22.42 42.6 22.67 42.6499 23 42.4099C23.07 42.4399 23.14 42.47 23.22 42.49C23.25 42.51 23.29 42.54 23.32 42.56C23.41 42.82 23.5 43.08 23.59 43.34C23.23 43.57 23.47 43.6399 23.69 43.7199C23.73 43.9899 23.76 44.27 23.8 44.54C23.93 45.37 24.06 46.2099 24.18 47.04C24.2 47.11 24.23 47.17 24.25 47.24C24.23 47.43 24.21 47.62 24.18 47.81C24.21 47.87 24.25 47.94 24.28 48C24.51 48.41 24.88 48.55 25.32 48.55C25.83 48.55 26.33 48.55 26.84 48.55C27.79 48.55 28.74 48.55 29.69 48.55C30.14 48.55 30.8 48.13 30.83 47.82C30.88 47.28 30.88 46.73 30.94 46.19C31.01 45.58 31.11 44.98 31.2 44.37C31.26 44.34 31.31 44.31 31.37 44.28C31.33 44.25 31.28 44.22 31.24 44.19C31.24 44.03 31.24 43.87 31.24 43.71C31.36 43.64 31.47 43.57 31.59 43.51C31.51 43.45 31.43 43.39 31.34 43.33C31.31 42.82 31.58 42.46 32.07 42.36C32.14 42.42 32.21 42.4799 32.28 42.54C32.34 42.42 32.4 42.31 32.46 42.19C33.33 41.84 34.19 41.49 35.06 41.14C35.21 41.08 35.36 40.99 35.51 40.92C35.58 40.98 35.65 41.04 35.72 41.11C35.78 40.99 35.84 40.88 35.9 40.76C36.06 40.76 36.22 40.76 36.38 40.76C36.42 41.06 36.55 41.22 36.86 41.02C36.91 41.02 36.97 41.02 37 41.04C38.09 41.8899 39.17 42.75 40.25 43.61C40.74 44 41.25 44.01 41.66 43.61C42.74 42.54 43.82 41.47 44.88 40.38C45.03 40.22 45.09 39.9499 45.15 39.7199C45.28 39.2199 44.86 38.93 44.67 38.56C44.68 38.44 44.7 38.31 44.71 38.19C44.6 38.19 44.49 38.19 44.37 38.19C44.02 37.75 43.68 37.3 43.33 36.86C43.5 36.53 43.31 36.47 43.04 36.48L43 36.4699Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M31.47 50.02C31.44 50.2 31.41 50.39 31.37 50.57H30.23C30.23 50.26 30.45 50.32 30.65 50.28C30.9 50.23 31.14 50.1 31.38 50.01H31.43H31.47V50.02Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M24.51 50.57C24.45 50.53 24.38 50.49 24.32 50.45C24.38 50.37 24.44 50.29 24.5 50.2C24.57 50.32 24.63 50.44 24.7 50.56H24.51V50.57Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M3.19 29.32C3.15 29.26 3.11 29.19 3.06 29.13C3.06 29.07 3.06 29 3.06 28.94C3.18 29 3.29998 29.07 3.41998 29.13C3.33998 29.19 3.25999 29.25 3.17999 29.32H3.19Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M51.96 23.31C51.89 23.31 51.83 23.31 51.76 23.31C51.7 23.25 51.63 23.18 51.57 23.12C51.7 23.12 51.83 23.12 51.96 23.12V23.31Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M3.23999 23.12C3.17999 23.22 3.12001 23.31 3.07001 23.41C3.07001 23.31 3.07001 23.22 3.07001 23.12C3.13001 23.12 3.18999 23.12 3.23999 23.12Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M3.06 28.56V28.85" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M24.89 50.57H25.08" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M50.44 21.4C50.06 21.24 49.67 21.08 49.29 20.92C49.32 20.85 49.34 20.75 49.39 20.72C49.72 20.53 50.51 21 50.53 21.4C50.5 21.42 50.47 21.42 50.44 21.4Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M32.72 4.25C32.59 3.9 32.45 3.56002 32.32 3.21002C32.58 2.97002 32.71 3.21001 32.77 3.38001C32.85 3.62001 32.85 3.89997 32.87 4.15997C32.87 4.18997 32.78 4.22 32.72 4.25Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.55 18.45C44.45 18.2 44.34 17.94 44.24 17.69H44.34C44.49 17.81 44.68 17.91 44.78 18.06C44.82 18.13 44.68 18.31 44.63 18.45C44.6 18.45 44.58 18.45 44.55 18.45Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M42.05 6.64003C41.73 6.60003 41.42 6.56003 41.1 6.52003C41.11 6.21003 41.23 6.04002 41.53 6.26002C41.7 6.39002 42.11 6.20003 42.05 6.64003Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M5.53998 20.91C5.21998 21.02 4.90003 21.13 4.59003 21.23C4.53003 21.26 4.46002 21.28 4.40002 21.31C4.41002 20.96 4.51999 20.76 4.92999 20.88C5.01999 20.91 5.15002 20.79 5.27002 20.78C5.36002 20.78 5.44998 20.85 5.53998 20.9V20.91Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M19.65 9.11998C19.44 9.20998 19.23 9.33999 19.01 9.37999C18.88 9.39999 18.73 9.27001 18.59 9.21001C18.79 9.13001 18.98 9.00997 19.18 8.98997C19.33 8.96997 19.49 9.06998 19.65 9.11998Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M10.67 17.59C10.54 17.84 10.42 18.1 10.29 18.35C10.25 18.22 10.16 18.07 10.18 17.96C10.23 17.73 10.37 17.54 10.66 17.59H10.67Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M35.75 9.29999C35.56 9.20999 35.37 9.11002 35.18 9.02002C35.35 8.98002 35.52 8.93001 35.69 8.89001C35.71 9.03001 35.73 9.15999 35.74 9.29999H35.75Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M17.65 8.52002C17.43 8.37002 17.2 8.22001 16.98 8.07001C16.98 8.04001 16.98 7.99997 16.98 7.96997C17.31 8.01997 17.63 8.09002 17.65 8.52002Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M12.3 7C12.32 7.48 12.01 7.50999 11.65 7.48999C11.8 7.32999 11.96 7.16 12.11 7C12.17 7 12.23 7 12.3 7Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M7.83002 13.77C7.96002 13.96 8.08002 14.15 8.21002 14.34C8.09002 14.34 7.88 14.35 7.87 14.32C7.83 14.14 7.84002 13.95 7.83002 13.76V13.77Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M16.7 7.77002C16.51 7.65002 16.32 7.52002 16.13 7.40002C16.13 7.37002 16.13 7.32999 16.13 7.29999C16.37 7.39999 16.77 7.30002 16.7 7.77002Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M4.40002 21.32C4.46002 21.29 4.53003 21.27 4.59003 21.24C4.48003 21.78 4.40001 21.84 4.01001 21.68C4.05001 21.62 4.08 21.56 4.12 21.5C4.21 21.44 4.31002 21.38 4.40002 21.31V21.32Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M50.81 21.61C50.91 21.56 51 21.52 51.1 21.47C51.13 21.64 51.16 21.82 51.19 21.99C51.1 21.92 51.01 21.85 50.91 21.78C50.87 21.73 50.84 21.67 50.8 21.61H50.81Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M46.91 20.63C46.75 20.63 46.59 20.63 46.43 20.63C46.52 20.51 46.6 20.4 46.69 20.28C46.76 20.4 46.83 20.51 46.91 20.63Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M47.21 12.54C47.12 12.43 47.04 12.32 46.95 12.21C46.99 12.17 47.05 12.12 47.11 12.07C47.23 12.14 47.35 12.21 47.46 12.28C47.37 12.37 47.29 12.45 47.2 12.54H47.21Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M8.40999 14.73C8.48999 14.79 8.57999 14.86 8.65999 14.92C8.72999 15.04 8.80002 15.17 8.88002 15.29C8.54002 15.31 8.31999 15.04 8.40999 14.72V14.73Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M46.15 20.53H45.67C45.76 20.41 45.84 20.3 45.93 20.18C46 20.3 46.07 20.41 46.15 20.53Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M15.65 7.09003C15.52 6.97003 15.39 6.84999 15.27 6.73999C15.35 6.67999 15.44 6.62 15.52 6.56C15.56 6.63 15.63 6.70003 15.65 6.78003C15.67 6.88003 15.65 6.98998 15.65 7.09998V7.09003Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M9.08004 15.59C9.16004 15.65 9.25004 15.72 9.33004 15.78C9.40004 15.9 9.48001 16.03 9.55001 16.15C9.21001 16.17 8.99004 15.9 9.08004 15.58V15.59Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M46.72 14.34C46.79 14.22 46.86 14.09 46.93 13.97C47.01 14.04 47.17 14.17 47.16 14.18C47.06 14.34 46.96 14.57 46.72 14.34Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M18.41 9.10999C18.22 8.98999 18.03 8.85999 17.84 8.73999C17.84 8.70999 17.84 8.67001 17.84 8.64001C18.08 8.74001 18.48 8.63999 18.41 9.10999Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M39.57 6.73999C39.48 6.79999 39.38 6.85998 39.29 6.91998C39.29 6.80998 39.31 6.69002 39.32 6.58002C39.4 6.63002 39.49 6.68999 39.57 6.73999Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M39.09 7.09998C38.96 7.17998 38.82 7.26003 38.69 7.34003C38.66 7.27003 38.62 7.2 38.59 7.13C38.76 7.13 38.92 7.10998 39.09 7.09998Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M9.54999 16.15C9.47999 16.03 9.40002 15.9 9.33002 15.78C9.62002 15.77 9.86001 15.78 9.64001 16.17C9.61001 16.17 9.57999 16.17 9.54999 16.15Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M50.81 21.61C50.85 21.67 50.88 21.73 50.92 21.78C50.63 21.81 50.4 21.77 50.44 21.39C50.47 21.4 50.5 21.4 50.53 21.39C50.62 21.46 50.72 21.54 50.81 21.61Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M8.88 15.3C8.81 15.18 8.73997 15.05 8.65997 14.93C8.93997 14.92 9.17997 14.93 8.96997 15.32C8.93997 15.32 8.91 15.32 8.88 15.3Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M50.92 21.78C51.01 21.85 51.1 21.92 51.2 21.99C51.24 22.08 51.28 22.17 51.31 22.26C50.94 22.3 50.89 22.07 50.92 21.78Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M10.01 16.65C10.29 16.65 10.59 16.62 10.26 17.02C10.18 16.96 10.11 16.89 10.03 16.83C10.03 16.77 10.01 16.71 10 16.65H10.01Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M9.92999 19.22C9.92999 19.28 9.92998 19.34 9.91998 19.4C9.87998 19.46 9.85 19.53 9.81 19.59C9.76 19.49 9.70997 19.38 9.65997 19.28C9.74997 19.26 9.83999 19.24 9.92999 19.22Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M13.74 6.42999L13.36 6.54999C13.41 6.44999 13.47 6.36001 13.52 6.26001C13.6 6.32001 13.67 6.36999 13.75 6.42999H13.74Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M7.93002 11.4C7.85002 11.61 7.77003 11.82 7.69003 12.03C7.64003 11.77 7.52002 11.48 7.93002 11.4Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.48 20.44C45.39 20.29 45.31 20.13 45.22 19.98C45.59 19.98 45.45 20.26 45.48 20.44Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M45.95 15.4C46.04 15.27 46.14 15.14 46.23 15.02C46.37 15.32 46.21 15.4 45.95 15.4Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M45.28 16.26C45.37 16.13 45.47 16 45.56 15.88C45.7 16.18 45.54 16.26 45.28 16.26Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M10.04 16.83C10.12 16.89 10.19 16.96 10.27 17.02C10.29 17.08 10.31 17.14 10.33 17.21C9.94005 17.17 9.90001 17.13 10.04 16.83Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M47.67 20.72C47.54 20.69 47.42 20.65 47.29 20.62C47.48 20.39 47.53 20.4 47.67 20.72Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M42.81 7.03001C42.68 6.96001 42.56 6.9 42.43 6.83C42.69 6.64 42.82 6.70001 42.81 7.03001Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M46.81 11.21C46.74 11.08 46.68 10.96 46.61 10.83C46.93 10.83 46.99 10.95 46.81 11.21Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M32.13 2.93C32.03 2.83 31.94 2.74003 31.84 2.64003C32.0267 2.56003 32.1233 2.65667 32.13 2.93Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M22.53 3.21002C22.45 3.36002 22.38 3.50997 22.3 3.65997C22.17 3.40997 22.21 3.24002 22.53 3.21002Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M7.72998 12.13C7.72998 12.24 7.74 12.34 7.75 12.45C7.69 12.41 7.63001 12.37 7.57001 12.33C7.62001 12.26 7.67998 12.2 7.72998 12.13Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.82 16.74C44.82 16.74 44.88 16.72 44.91 16.72C44.92 16.93 44.94 17.14 44.62 17.11L44.64 16.93C44.7 16.87 44.76 16.81 44.82 16.74Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M23.09 2.53998C23.03 2.59998 22.97 2.65997 22.91 2.71997C22.89 2.64997 22.86 2.57 22.84 2.5C22.92 2.51 23.01 2.52998 23.09 2.53998Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M14.6 6.52002C14.5 6.50002 14.41 6.47001 14.31 6.45001C14.35 6.39001 14.39 6.34003 14.43 6.28003L14.6 6.52002Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M12.3 7.00002C12.24 7.00002 12.18 7.00002 12.11 7.00002C12.11 6.79002 12.16 6.63005 12.4 6.84005C12.37 6.90005 12.33 6.95003 12.3 7.01003V7.00002Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M9.81 19.6C9.85 19.54 9.87998 19.47 9.91998 19.41C9.93998 19.52 9.95998 19.63 9.97998 19.74C9.92998 19.72 9.88002 19.71 9.83002 19.69C9.83002 19.66 9.83 19.63 9.81 19.6Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M38.56 7.38C38.49 7.45 38.42 7.52003 38.34 7.59003C38.32 7.53003 38.31 7.46997 38.29 7.40997C38.38 7.40997 38.47 7.39001 38.55 7.39001L38.56 7.38Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M4.12 21.51L4.01001 21.69C3.95001 21.73 3.89002 21.77 3.83002 21.81C3.93002 21.71 4.03 21.61 4.12 21.52V21.51Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M20.8 8.54999C20.7 8.57999 20.61 8.61001 20.51 8.64001" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path d="M37.68 8.07001C37.62 8.13001 37.55 8.20001 37.49 8.26001" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.11 19.78C45.07 19.66 45.03 19.54 44.99 19.42C45 19.44 45.02 19.47 45.03 19.49C45.06 19.53 45.08 19.56 45.11 19.6C45.11 19.66 45.11 19.72 45.12 19.78H45.11Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M36.82 8.72998C36.76 8.78998 36.69 8.85998 36.63 8.91998" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.34 17.69H44.24C44.27 17.59 44.31 17.5 44.34 17.4C44.34 17.5 44.34 17.59 44.34 17.69Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M24.32 1.96002C24.26 1.98002 24.19 2.01003 24.13 2.03003" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M51.57 23.02C51.57 22.96 51.59 22.89 51.6 22.83C51.64 22.86 51.69 22.89 51.73 22.92C51.68 22.95 51.62 22.99 51.57 23.02Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M22.21 3.96002C22.19 4.02002 22.16 4.09002 22.14 4.15002" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M21.73 7.59003C21.73 7.65003 21.73 7.72003 21.73 7.78003C21.69 7.75003 21.64 7.71999 21.6 7.67999C21.65 7.64999 21.69 7.62003 21.74 7.59003H21.73Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M7.71997 13.02C7.71997 13.08 7.71997 13.15 7.71997 13.21C7.66997 13.18 7.63002 13.15 7.58002 13.12L7.71997 13.02Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.55 18.45C44.55 18.45 44.6 18.45 44.63 18.45C44.63 18.54 44.63 18.62 44.63 18.71C44.6 18.62 44.58 18.53 44.55 18.45Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M44.81 18.94L44.74 18.84" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M44.91 19.12C44.91 19.12 44.86 19.05 44.83 19.02C44.86 19.05 44.88 19.09 44.91 19.12Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M8.22998 10.99C8.22998 10.97 8.25 10.94 8.25 10.92C8.25 10.94 8.23998 10.96 8.22998 10.99Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M45.1 19.6C45.1 19.6 45.05 19.53 45.02 19.49C45.05 19.53 45.07 19.56 45.1 19.6Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M20.01 8.91998C20.01 8.91998 19.96 8.96999 19.93 8.98999C19.96 8.96999 19.98 8.93998 20.01 8.91998Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M34.97 8.98999C34.92 8.95999 34.86 8.92001 34.81 8.89001" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M34.42 8.71002C34.42 8.71002 34.35 8.66001 34.31 8.64001C34.35 8.66001 34.38 8.69002 34.42 8.71002Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M17.84 8.63C17.84 8.63 17.84 8.69998 17.84 8.72998C17.81 8.69998 17.79 8.66 17.76 8.63C17.79 8.63 17.81 8.63 17.84 8.63Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M16.98 7.96997C16.98 7.96997 16.98 8.04001 16.98 8.07001C16.95 8.04001 16.93 7.99997 16.9 7.96997C16.93 7.96997 16.95 7.96997 16.98 7.96997Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M16.12 7.29999C16.12 7.29999 16.12 7.37002 16.12 7.40002C16.09 7.37002 16.07 7.32999 16.04 7.29999C16.07 7.29999 16.09 7.29999 16.12 7.29999Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M47.02 39.9C47.16 39.9 47.29 39.92 47.46 39.93C47.43 40.19 47.44 40.43 47.37 40.65C47.31 40.84 47.28 41.18 46.91 40.95C46.95 40.6 46.98 40.25 47.02 39.9Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M32.72 48C32.8 48.04 32.92 48.07 32.95 48.14C33.09 48.45 32.6 49.21 32.25 49.25C32.25 49.22 32.25 49.19 32.25 49.16C32.41 48.78 32.57 48.39 32.73 48.01L32.72 48Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.33 43.22C36.06 43.32 35.8 43.43 35.52 43.5C35.46 43.52 35.36 43.38 35.27 43.32C35.62 43.22 35.92 42.62 36.33 43.23V43.22Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M17.64 41.32C17.93 41.02 18.22 40.71 18.69 40.77C18.49 41.17 17.96 41.44 17.64 41.32Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.62 33.89C44.93 34.25 44.84 34.52 44.34 34.75C44.3 34.72 44.27 34.68 44.23 34.65C44.36 34.4 44.49 34.14 44.61 33.89H44.62Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M12.31 45.44C12.12 45.28 11.93 45.12 11.74 44.96C12.16 44.8 12.28 44.9 12.31 45.44Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M43.38 31.41C43.45 31.19 43.52 30.97 43.59 30.75C43.67 30.84 43.82 31 43.8 31.01C43.67 31.16 43.52 31.28 43.37 31.41H43.38Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M42.33 45.61C42.39 45.95 42.13 46.01 41.9 46.05C41.84 46.06 41.74 45.9 41.67 45.82C41.89 45.75 42.11 45.68 42.33 45.6V45.61Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M39.76 45.73C39.65 45.78 39.47 45.89 39.45 45.87C39.33 45.7 39.24 45.52 39.13 45.33C39.24 45.4 39.35 45.46 39.46 45.53C39.56 45.6 39.65 45.66 39.75 45.73H39.76Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M33.2 44.38C33.28 44.47 33.37 44.56 33.45 44.64C33.33 44.71 33.21 44.78 33.1 44.85C33.04 44.74 32.99 44.64 32.93 44.53C33.02 44.48 33.11 44.42 33.2 44.37V44.38Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M50.53 30.95C50.45 31.11 50.38 31.29 50.27 31.43C50.25 31.45 50.06 31.35 49.96 31.31C50.15 31.19 50.34 31.07 50.54 30.95H50.53Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M8.12 38.18L8.69 37.41C8.52 37.68 8.69 38.2 8.12 38.18Z" fill="black"
                                    stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M41.97 17.4C42.09 17.17 42.21 16.95 42.33 16.72C42.53 17.12 42.34 17.31 41.97 17.4Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M22.98 49.63C22.83 49.44 22.69 49.24 22.54 49.05C22.89 49.09 23.16 49.19 22.98 49.63Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M42.32 35.61C42.2 35.42 42.08 35.23 41.97 35.03C42.32 35.08 42.57 35.19 42.32 35.61Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M12.58 16.71C12.68 16.94 12.77 17.17 12.87 17.41C12.48 17.3 12.44 17.05 12.58 16.71Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M22.23 42.18C22.47 42.25 22.71 42.33 22.95 42.4C22.61 42.64 22.37 42.59 22.23 42.18Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M39.47 45.53C39.36 45.46 39.25 45.4 39.14 45.33C39.06 45.29 38.98 45.26 38.91 45.22C38.88 45.16 38.84 45.11 38.81 45.05C39.08 45.14 39.5 45.02 39.48 45.53H39.47Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M21.17 43.91C20.94 43.82 20.71 43.72 20.49 43.63C20.74 43.67 21.17 43.27 21.17 43.91Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M46.64 41.33C46.48 41.52 46.32 41.71 46.15 41.91C46.12 41.56 46.22 41.31 46.64 41.33Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.28 36.1C45.38 36.1 45.48 36.08 45.59 36.07C45.59 36.2 45.57 36.34 45.57 36.47C45.54 36.47 45.51 36.47 45.49 36.46C45.43 36.4 45.37 36.34 45.31 36.27C45.31 36.21 45.3 36.16 45.29 36.1H45.28Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M8.67999 41.91C8.54999 41.75 8.41998 41.59 8.28998 41.43C8.84998 41.24 8.62999 41.69 8.67999 41.91Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M43.66 21.7C43.6 21.54 43.53 21.38 43.47 21.22C43.59 21.27 43.71 21.32 43.83 21.37C43.77 21.48 43.71 21.59 43.66 21.7Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M42.23 18.26L42.04 17.88H42.38C42.33 18.01 42.28 18.13 42.23 18.26Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M11.46 20.93C11.39 21.17 11.32 21.41 11.24 21.65C10.95 21.3 11.13 21.09 11.46 20.93Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M4.40002 30.95C4.26002 30.85 4.11998 30.74 3.97998 30.64C4.40998 30.51 4.48002 30.56 4.40002 30.95Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.61 35.23H44.95C44.93 35.36 44.92 35.48 44.9 35.61C44.87 35.61 44.84 35.61 44.82 35.6C44.76 35.54 44.7 35.48 44.64 35.41C44.64 35.35 44.62 35.29 44.61 35.23Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.61 38.57C44.51 38.44 44.42 38.32 44.32 38.19C44.43 38.19 44.54 38.19 44.66 38.19C44.65 38.31 44.63 38.44 44.62 38.56L44.61 38.57Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.09 32.75C45.15 32.86 45.2 32.97 45.26 33.08C45.14 33.13 45.02 33.18 44.9 33.23C44.93 33.1 44.96 32.98 44.99 32.85C45.02 32.82 45.06 32.78 45.09 32.75Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M3.92999 30.59C3.82999 30.45 3.72 30.31 3.62 30.18C4.11 30.03 4.03999 30.3 3.92999 30.59Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.33 40.77C36.49 40.86 36.65 40.94 36.81 41.03C36.49 41.23 36.37 41.07 36.33 40.77Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M12.87 35.04C12.78 35.2 12.7 35.36 12.61 35.52C12.41 35.21 12.56 35.08 12.87 35.04Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M35.47 40.93C35.6 40.88 35.73 40.82 35.86 40.77C35.8 40.89 35.74 41 35.68 41.12C35.61 41.06 35.54 41 35.47 40.93Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M34.52 43.64C34.46 43.75 34.4 43.87 34.34 43.98C34.27 43.92 34.2 43.86 34.13 43.8C34.13 43.78 34.13 43.75 34.13 43.73C34.26 43.7 34.38 43.67 34.51 43.64H34.52Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M16.79 41.99C16.92 41.89 17.04 41.8 17.17 41.7C17.17 41.96 17.2 42.26 16.79 41.99Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M31.47 50.02H31.43H31.38C31.34 49.66 31.5701 49.62 31.8401 49.62L31.86 49.64C31.86 49.67 31.86 49.69 31.85 49.72C31.72 49.82 31.6 49.93 31.47 50.03V50.02Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45 22.44C44.87 22.41 44.75 22.38 44.62 22.34C44.68 22.26 44.73 22.17 44.79 22.09C44.86 22.21 44.93 22.32 45 22.44Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M31.2 43.71C31.23 43.58 31.27 43.46 31.3 43.33C31.38 43.39 31.46 43.45 31.55 43.51C31.43 43.58 31.32 43.65 31.2 43.71Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M38.8 45.06C38.83 45.12 38.87 45.17 38.9 45.23C38.52 45.47 38.54 45.19 38.52 44.94H38.57H38.61C38.67 44.98 38.74 45.02 38.8 45.06Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M32.04 42.36C32.17 42.31 32.3 42.25 32.43 42.2C32.37 42.32 32.31 42.43 32.25 42.55C32.18 42.49 32.11 42.43 32.04 42.37V42.36Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.61 43.34C36.99 43.1 36.97 43.39 36.99 43.63C36.93 43.63 36.87 43.61 36.81 43.61C36.74 43.52 36.67 43.43 36.61 43.34Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M15.07 43.32C15.2 43.22 15.32 43.13 15.45 43.03C15.43 43.27 15.45 43.56 15.07 43.32Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M37.67 44.27C37.6 44.18 37.54 44.09 37.47 44C37.82 43.77 37.83 44.04 37.86 44.27L37.84 44.29L37.66 44.27H37.67Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.77 22.53C45.64 22.5 45.52 22.46 45.39 22.43L45.56 22.18C45.63 22.3 45.7 22.41 45.77 22.53Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M15.93 42.65C16.06 42.55 16.18 42.46 16.31 42.36C16.27 42.75 16.23 42.79 15.93 42.65Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.81 43.61C36.87 43.61 36.93 43.63 36.99 43.63C37.06 43.72 37.12 43.8 37.19 43.89C36.9 44.03 36.85 43.99 36.81 43.61Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M19.08 40.77C19.24 40.86 19.4 40.95 19.57 41.04C19.27 41.2 19.09 41.15 19.08 40.77Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M10.99 14.73C11.09 14.86 11.1801 14.98 11.2801 15.11C10.8901 15.07 10.85 15.02 10.99 14.73Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M22.14 47.71C22.07 47.66 22.01 47.61 21.96 47.57C21.99 47.48 22.02 47.4 22.04 47.32C22.36 47.46 22.38 47.52 22.14 47.7V47.71Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M32.24 49.15V49.24C32.21 49.3 32.17 49.36 32.13 49.42C32.04 49.49 31.95 49.56 31.86 49.63L31.84 49.61C31.87 49.37 31.9 49.12 32.25 49.15H32.24Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M10.32 13.87C10.42 14 10.51 14.12 10.61 14.25C10.37 14.23 10.07 14.25 10.32 13.87Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M43.29 36.85C43.19 36.72 43.09 36.6 43 36.47C43.28 36.47 43.46 36.52 43.29 36.85Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M42.71 16.26L43 15.87C43.17 16.2 42.99 16.26 42.71 16.26Z" fill="black"
                                    stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M34.14 43.72C34.14 43.72 34.14 43.77 34.14 43.79C34.05 43.79 33.96 43.8 33.87 43.81C33.87 43.73 33.89 43.64 33.9 43.56C33.98 43.61 34.07 43.67 34.15 43.72H34.14Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M7.76001 40.18C7.73001 40.05 7.68997 39.93 7.65997 39.8C7.74997 39.85 7.82998 39.89 7.91998 39.94C7.86998 40.02 7.82001 40.1 7.76001 40.18Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M12.79 17.89C12.75 17.99 12.71 18.08 12.67 18.18C12.63 18.09 12.58 18 12.54 17.91C12.62 17.91 12.7 17.9 12.79 17.89Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M43.28 20.65C43.25 20.53 43.22 20.4 43.18 20.28C43.23 20.26 43.28 20.25 43.33 20.23C43.31 20.37 43.29 20.51 43.27 20.65H43.28Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M10.01 35.7C10.08 35.6 10.15 35.49 10.22 35.39C10.27 35.44 10.31 35.49 10.36 35.55C10.24 35.6 10.13 35.65 10.01 35.7Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M23.54 43.33C23.57 43.46 23.6 43.58 23.64 43.71C23.42 43.63 23.18 43.55 23.54 43.33Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.09 32.75C45.09 32.75 45.02 32.82 44.99 32.85C44.94 32.79 44.88 32.73 44.83 32.67C44.92 32.61 45.02 32.54 45.11 32.48C45.11 32.57 45.1 32.67 45.09 32.76V32.75Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M44.64 13.3C44.79 13.23 44.94 13.17 45.1 13.1C44.95 13.17 44.8 13.23 44.64 13.3Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M51.77 29.12C51.72 29.25 51.66 29.38 51.61 29.51" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M33.11 45.24C33.16 45.3 33.22 45.35 33.27 45.41C33.19 45.45 33.1 45.49 33.02 45.53C33.05 45.43 33.08 45.34 33.12 45.24H33.11Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M51.2 30.28C51.11 30.38 51.01 30.47 50.92 30.57C50.93 30.39 50.87 30.14 51.2 30.28Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M9.91998 32.94C9.88998 32.85 9.86002 32.75 9.83002 32.66C9.88002 32.64 9.92998 32.63 9.97998 32.61C9.95998 32.72 9.93998 32.83 9.91998 32.94Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M10.5 38.29C10.44 38.35 10.38 38.42 10.32 38.48C10.3 38.42 10.29 38.35 10.27 38.29C10.35 38.29 10.42 38.29 10.5 38.29Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M11.17 37.43C11.11 37.49 11.05 37.56 10.99 37.62C10.97 37.56 10.96 37.49 10.94 37.43C11.02 37.43 11.09 37.43 11.17 37.43Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.97 37.13L46.15 37.32C46.07 37.32 46 37.32 45.92 37.32C45.94 37.26 45.95 37.19 45.97 37.13Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M24.32 4.25C24.23 4.35 24.14 4.43998 24.05 4.53998" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M11.84 36.57C11.78 36.63 11.72 36.7 11.66 36.76C11.64 36.7 11.63 36.63 11.61 36.57C11.69 36.57 11.76 36.57 11.84 36.57Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M11.66 15.59C11.72 15.65 11.78 15.71 11.84 15.78C11.76 15.78 11.69 15.78 11.61 15.78C11.63 15.72 11.64 15.65 11.66 15.59Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.3 36.27C45.36 36.33 45.42 36.39 45.48 36.46C45.41 36.46 45.34 36.48 45.27 36.48C45.28 36.41 45.29 36.34 45.3 36.27Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.64 35.41C44.7 35.47 44.76 35.53 44.82 35.6L44.61 35.62C44.62 35.55 44.63 35.48 44.64 35.41Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M12.32 16.44C12.39 16.51 12.47 16.58 12.54 16.66C12.45 16.65 12.36 16.64 12.27 16.63C12.29 16.57 12.3 16.51 12.32 16.45V16.44Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.82 16.74C44.76 16.8 44.7 16.86 44.64 16.93C44.62 16.87 44.61 16.8 44.59 16.74H44.82Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M11.23 30.69C11.28 30.84 11.32 30.98 11.37 31.13" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M21.75 44.76C21.69 44.74 21.63 44.72 21.57 44.7C21.59 44.66 21.62 44.62 21.64 44.57C21.68 44.63 21.71 44.7 21.75 44.76Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.61 43.34C36.68 43.43 36.75 43.52 36.81 43.61C36.71 43.51 36.62 43.42 36.52 43.32C36.55 43.32 36.58 43.32 36.61 43.34Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M38.14 44.55H38.09H38.04C37.97 44.46 37.91 44.37 37.84 44.28L37.86 44.26C37.95 44.35 38.04 44.45 38.14 44.54V44.55Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.23 34.65C44.23 34.65 44.3 34.72 44.34 34.75C44.34 34.82 44.34 34.88 44.34 34.95L44.24 34.66L44.23 34.65Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M31.11 8.34998C31.08 8.28998 31.05 8.21997 31.01 8.15997C31.09 8.18997 31.16 8.22 31.24 8.25C31.2 8.28 31.15 8.30998 31.11 8.34998Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M20.32 41.41C20.44 41.46 20.55 41.5 20.67 41.55" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M43.11 44.95C43.05 45.01 42.98 45.08 42.92 45.14" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M9.83002 35.89C9.89002 35.83 9.96002 35.76 10.02 35.7" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path d="M43 36.48C42.94 36.42 42.87 36.35 42.81 36.29" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M50.92 30.56C50.86 30.62 50.79 30.69 50.73 30.75" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M46.52 37.8C46.55 37.87 46.58 37.93 46.62 38C46.59 37.93 46.56 37.87 46.52 37.8Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M11.64 31.89C11.67 31.95 11.71 32.02 11.74 32.08C11.68 32.07 11.62 32.05 11.56 32.04C11.59 31.99 11.61 31.94 11.64 31.89Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M24.14 47.81C24.17 47.87 24.21 47.94 24.24 48" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M22.02 46.86C22 46.8 21.97 46.73 21.95 46.67" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M44.62 13.69C44.62 13.63 44.63 13.56 44.64 13.5L44.77 13.58C44.72 13.62 44.67 13.65 44.62 13.69Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M31.17 44.37C31.18 44.31 31.19 44.25 31.21 44.19C31.25 44.22 31.3 44.25 31.34 44.28C31.28 44.31 31.23 44.34 31.17 44.37Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M5.83002 22.86C5.74002 22.89 5.66001 22.91 5.57001 22.94" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path d="M24.13 47.04C24.15 47.11 24.18 47.17 24.2 47.24" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M15.53 9.29999C15.47 9.25999 15.42 9.23 15.36 9.19" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path d="M31.95 10.05C31.88 10.03 31.82 9.99998 31.75 9.97998" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path d="M42.79 19.21C42.76 19.15 42.74 19.1 42.71 19.04" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M38.62 44.93L38.58 44.95H38.53C38.53 44.95 38.52 44.88 38.51 44.86C38.55 44.89 38.58 44.91 38.62 44.94V44.93Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M23.17 42.48C23.17 42.48 23.24 42.53 23.27 42.55C23.24 42.53 23.2 42.5 23.17 42.48Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M34.9 43.44C34.9 43.44 34.83 43.49 34.79 43.51C34.83 43.49 34.86 43.46 34.9 43.44Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M49.36 23.03C49.36 23.03 49.31 22.98 49.29 22.96C49.31 22.98 49.34 23.01 49.36 23.03Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M36.9 11.32C36.9 11.32 36.83 11.37 36.79 11.4C36.83 11.37 36.86 11.35 36.9 11.32Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M38.62 9.98999C38.62 9.98999 38.55 10.04 38.51 10.07C38.55 10.04 38.58 10.02 38.62 9.98999Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M16.22 44.97C16.22 44.97 16.15 45.02 16.11 45.05C16.15 45.02 16.18 45 16.22 44.97Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M39.47 9.32001C39.47 9.32001 39.4 9.37002 39.36 9.40002C39.4 9.37002 39.43 9.35001 39.47 9.32001Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M49.29 29.39L49.36 29.32C49.36 29.32 49.31 29.37 49.29 29.39Z" fill="black"
                                    stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M13.36 8.65002C13.36 8.65002 13.29 8.69997 13.26 8.71997C13.29 8.69997 13.33 8.67002 13.36 8.65002Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M22.41 48.77C22.41 48.77 22.36 48.7 22.33 48.67C22.36 48.7 22.38 48.74 22.41 48.77Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M49.17 22.83C49.17 22.83 49.12 22.78 49.1 22.76C49.12 22.78 49.15 22.81 49.17 22.83Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M13.25 43.62C13.25 43.62 13.32 43.67 13.35 43.69C13.32 43.67 13.28 43.64 13.25 43.62Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M37.85 44.29C37.92 44.38 37.98 44.47 38.05 44.56C37.76 44.7 37.71 44.66 37.67 44.27C37.73 44.27 37.79 44.28 37.85 44.29Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M31.86 49.63C31.95 49.56 32.04 49.49 32.13 49.42C32.13 49.6933 32.0334 49.79 31.84 49.71C31.84 49.71 31.84 49.66 31.85 49.63H31.86Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.8 29.99C36.61 30.43 36.42 30.87 36.23 31.31C35.96 31.2 36.05 31.39 36.06 31.51C35.8 31.8 35.54 32.1 35.28 32.39C35.26 32.39 35.23 32.39 35.21 32.39C35.23 32.41 35.26 32.43 35.28 32.45C34.93 33.13 34.42 33.64 33.75 34C33.73 34.02 33.7 34.05 33.68 34.07C33.39 34.3 33.09 34.53 32.8 34.76C32.71 34.79 32.6199 34.81 32.5399 34.84C32.0699 35.39 31.39 35.55 30.75 35.8C29.41 36.31 28.03 36.48 26.62 36.36C24.7 36.2 22.97 35.5 21.4 34.36C20.12 33.43 19.1899 32.23 18.4099 30.87C17.7999 29.81 17.54 28.66 17.37 27.48C17.05 25.37 17.43 23.38 18.43 21.51C19.07 20.3 19.94 19.27 21 18.38C22.29 17.3 23.75 16.55 25.37 16.26C26.45 16.06 27.58 16.11 28.68 16.19C29.49 16.25 30.28 16.55 31.09 16.74L31.2899 16.81C31.6499 17 32.02 17.2 32.38 17.39C32.49 17.45 32.6099 17.51 32.7199 17.56C32.7499 17.57 32.78 17.58 32.81 17.59C32.84 17.62 32.87 17.65 32.9 17.68C32.96 17.71 33.03 17.75 33.09 17.78C34.3 18.58 35.2699 19.61 36.0399 20.82L36.13 21.01C36.23 21.17 36.34 21.33 36.44 21.49L36.52 21.59C36.62 21.84 36.71 22.09 36.81 22.34C36.79 22.36 36.76 22.39 36.74 22.41C36.76 22.41 36.79 22.41 36.81 22.42C37.03 23.14 37.32 23.85 37.46 24.59C37.58 25.26 37.58 25.96 37.57 26.65C37.55 27.73 37.35 28.78 36.9 29.78C36.87 29.85 36.84 29.91 36.8 29.98V29.99ZM19.58 28.08C19.61 28.21 19.64 28.33 19.67 28.46C19.76 28.72 19.84 28.97 19.93 29.23L20.02 29.42C20.11 29.61 20.21 29.8 20.3 29.99C20.31 30.02 20.32 30.05 20.33 30.08L20.4099 30.18C20.8599 31.15 21.63 31.85 22.4 32.55C22.44 32.58 22.47 32.6 22.51 32.63C22.89 32.86 23.27 33.1 23.65 33.33C23.84 33.42 24.0299 33.52 24.2199 33.61L24.7 33.8C24.86 33.85 25.02 33.91 25.18 33.96C25.31 33.99 25.43 34.02 25.56 34.05C25.66 34.08 25.7499 34.12 25.8499 34.15C26.2699 34.35 26.78 33.94 27.17 34.35C27.19 34.37 27.26 34.36 27.31 34.35C27.75 34.27 28.16 34.19 28.63 34.21C29.27 34.23 29.98 34.03 30.57 33.73C31.96 33.02 33.23 32.12 34.13 30.79C34.48 30.27 34.94 29.73 35.06 29.15C35.21 28.41 35.71 27.68 35.39 26.86C35.75 26.48 35.5 26.01 35.59 25.59C35.59 25.49 35.57 25.4 35.56 25.3C35.4 24.57 35.24 23.84 35.08 23.11C35.06 23.04 35.03 22.98 35.01 22.91C34.91 22.78 34.8 22.67 34.73 22.53C34.02 21.16 33.05 20.05 31.71 19.27C31.33 19.05 30.9699 18.78 30.5999 18.54C30.5999 18.52 30.5999 18.49 30.5999 18.47C30.5799 18.49 30.56 18.52 30.53 18.54C30.3 18.51 30.0599 18.51 29.8499 18.44C28.9199 18.13 27.98 18.03 27.01 18.08C26.88 18.08 26.76 18.08 26.63 18.08C26.19 18.18 25.74 18.27 25.3 18.37C25.05 18.32 24.82 18.66 24.55 18.38C24.52 18.35 24.33 18.45 24.24 18.52C24.01 18.68 23.8 18.86 23.58 19.04L23.2899 19.2L22.9099 19.48L22.53 19.7C22.53 19.7 22.46 19.75 22.42 19.78C21.73 20.3 21.1499 20.92 20.7199 21.68C20.6899 21.71 20.67 21.75 20.64 21.78L20.43 22.15C20.21 22.41 19.9299 22.64 19.7899 22.93C19.6699 23.17 19.71 23.49 19.69 23.78C19.66 23.86 19.6299 23.94 19.5999 24.01C19.5699 24.19 19.53 24.36 19.5 24.54C19.47 24.79 19.43 25.05 19.4 25.3C19.33 25.35 19.2699 25.4 19.2199 25.44C19.2499 25.53 19.28 25.61 19.3 25.69C19.36 26.39 19.43 27.09 19.49 27.79C19.52 27.89 19.55 27.98 19.59 28.08H19.58Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M36.8 29.99C36.83 29.92 36.86 29.86 36.9 29.79C36.87 29.86 36.84 29.92 36.8 29.99Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.06 31.51C36.06 31.39 35.96 31.2 36.23 31.31C36.17 31.38 36.12 31.44 36.06 31.51Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M36.13 21.03L36.04 20.84" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M32.54 34.85C32.63 34.82 32.72 34.8 32.8 34.77C32.71 34.8 32.62 34.82 32.54 34.85Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M31.28 16.81L31.08 16.74" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M33.09 17.79C33.03 17.76 32.96 17.72 32.9 17.69" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M32.8 17.6C32.8 17.6 32.74 17.58 32.71 17.57C32.73 17.54 32.75 17.5 32.78 17.47C32.78 17.51 32.8 17.56 32.81 17.6H32.8Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.81 22.43C36.81 22.43 36.76 22.43 36.74 22.42C36.76 22.4 36.79 22.37 36.81 22.35C36.81 22.38 36.81 22.4 36.81 22.43Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M36.52 21.61L36.44 21.51" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M35.28 32.46C35.28 32.46 35.23 32.42 35.21 32.4C35.23 32.4 35.26 32.4 35.28 32.4C35.28 32.42 35.28 32.44 35.28 32.47V32.46Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M33.69 34.08C33.69 34.08 33.74 34.03 33.76 34.01C33.74 34.03 33.71 34.06 33.69 34.08Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M20.41 22.16C20.66 22.6 20.41 22.83 20.03 23C20.14 23.38 20.16 23.71 19.66 23.79C19.69 23.5 19.65 23.18 19.76 22.94C19.9 22.65 20.18 22.42 20.4 22.16H20.41Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M25.27 18.37C25.03 18.73 24.72 18.89 24.31 18.69C23.98 19.3 23.88 19.34 23.56 19.04C23.78 18.87 23.99 18.69 24.22 18.52C24.31 18.45 24.51 18.35 24.53 18.38C24.79 18.65 25.03 18.32 25.28 18.37H25.27Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M19.67 28.46C20.1 28.61 20.19 28.85 19.93 29.23C19.84 28.97 19.76 28.72 19.67 28.46Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M20.02 29.42C20.18 29.51 20.33 29.61 20.49 29.7C20.43 29.8 20.36 29.89 20.3 29.99C20.21 29.8 20.11 29.61 20.02 29.42Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M23.65 33.3401C23.73 33.2801 23.89 33.17 23.89 33.18C24.01 33.32 24.11 33.47 24.22 33.63C24.03 33.54 23.84 33.44 23.65 33.35V33.3401Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M19.38 25.31C19.46 25.37 19.55 25.42 19.63 25.48C19.51 25.55 19.4 25.62 19.28 25.69C19.25 25.61 19.23 25.53 19.2 25.44C19.25 25.4 19.31 25.35 19.38 25.3V25.31Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M24.7 33.81L24.9 33.62C24.99 33.74 25.09 33.85 25.18 33.97C25.02 33.92 24.86 33.86 24.7 33.81Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M19.58 24.02C19.76 24.24 19.86 24.44 19.48 24.55C19.51 24.37 19.55 24.2 19.58 24.02Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M26.99 18.09C26.9 18.18 26.82 18.26 26.73 18.35L26.6 18.09C26.73 18.09 26.85 18.09 26.98 18.09H26.99Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M23.27 19.2C23.25 19.44 23.27 19.73 22.89 19.48C23.02 19.39 23.15 19.29 23.27 19.2Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M35.58 25.6C35.52 25.55 35.46 25.5 35.39 25.44L35.55 25.31C35.55 25.41 35.57 25.5 35.58 25.6Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M19.48 27.79C19.56 27.84 19.63 27.88 19.71 27.93L19.58 28.08C19.55 27.98 19.52 27.89 19.48 27.79Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M25.56 34.06C25.56 34.06 25.66 33.97 25.71 33.93C25.76 34.01 25.8 34.08 25.85 34.16C25.75 34.13 25.66 34.09 25.56 34.06Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M35.07 23.12C35.05 23.05 35.02 22.99 35 22.92" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path
                                    d="M30.59 18.55C30.59 18.55 30.54 18.55 30.51 18.55C30.53 18.53 30.55 18.5 30.58 18.48C30.58 18.5 30.58 18.53 30.58 18.55H30.59Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M22.51 19.71C22.51 19.71 22.44 19.76 22.4 19.79C22.44 19.76 22.47 19.74 22.51 19.71Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M20.7 21.69C20.7 21.69 20.65 21.76 20.62 21.79C20.65 21.76 20.67 21.72 20.7 21.69Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M20.33 30.08L20.41 30.18" stroke="black" stroke-width="2"
                                    stroke-miterlimit="10" />
                                <path d="M22.4 32.56C22.4 32.56 22.47 32.61 22.51 32.64C22.47 32.61 22.44 32.59 22.4 32.56Z"
                                    fill="black" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                            </svg>

                            <div style="margin-left: 8px">
                                <h6>Support 24/7</h6>
                                <p>We support online 24 hours a day</p>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12 mb-3">
                        <div class="d-flex border border-dark p-3 h-100">
                            <svg width="48" height="49" viewBox="0 0 48 49" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M37.52 5.42C37.63 5.52 37.74 5.61999 37.85 5.71999C37.83 6.07999 38.12 6.31999 38.45 6.21999C38.75 6.45999 39.06 6.70001 39.36 6.93001L39.27 7.18001C39.4 7.20001 39.53 7.21 39.66 7.23C40.26 7.83 40.87 8.42999 41.47 9.03999C41.49 9.16999 41.5 9.30001 41.52 9.43001C41.6 9.40001 41.69 9.37004 41.77 9.34004C41.87 9.47004 41.97 9.61001 42.07 9.74001C42.14 9.81001 42.2 9.88003 42.27 9.95003C42.34 10.05 42.41 10.15 42.48 10.26C42.48 10.37 42.46 10.47 42.46 10.58C42.54 10.55 42.63 10.52 42.71 10.48L42.77 10.62C42.77 10.71 42.78 10.81 42.79 10.9C42.85 10.88 42.92 10.87 42.98 10.85C43.09 11.02 43.19 11.19 43.3 11.35C43.15 11.75 43.3 11.98 43.8 12.06C43.96 12.3 44.11 12.54 44.27 12.79C44.13 13.13 44.15 13.37 44.6 13.38C44.88 13.96 45.16 14.54 45.45 15.11C45.51 15.24 45.56 15.37 45.62 15.49C45.78 15.89 45.94 16.3 46.1 16.7C45.83 16.98 45.95 17.35 46.4 17.61C46.61 18.38 46.81 19.15 47.02 19.92C47.02 19.99 47.02 20.05 47.02 20.12C47.12 20.55 47.25 20.97 47.31 21.41C47.38 21.89 47.39 22.38 47.43 22.86L47.23 23.08C47.32 23.14 47.42 23.2 47.51 23.27C47.51 24.31 47.51 25.35 47.51 26.4C47.46 26.43 47.41 26.47 47.36 26.5C47.41 26.53 47.46 26.57 47.5 26.6C47.41 27.23 47.34 27.87 47.21 28.49C46.96 29.69 46.72 30.9 46.39 32.08C46.14 32.96 45.74 33.8 45.4 34.66C45.37 34.7 45.35 34.73 45.32 34.77C44.9 35.63 44.49 36.51 44.04 37.36C43.89 37.64 43.61 37.86 43.39 38.1C42.99 38.09 42.9 38.26 43.08 38.61C42.85 38.91 42.61 39.22 42.38 39.52C42.31 39.46 42.23 39.4 42.16 39.34C42.16 39.46 42.18 39.59 42.19 39.71C42.09 39.85 41.98 39.98 41.88 40.12C41.8 40.09 41.71 40.06 41.63 40.03C41.61 40.16 41.6 40.29 41.58 40.42C41.38 40.65 41.18 40.89 40.97 41.12C40.69 40.64 40.53 41.1 40.42 41.23C40.3 41.37 39.75 41.49 40.27 41.82C40.04 42.02 39.8 42.22 39.57 42.43C39.44 42.45 39.31 42.46 39.18 42.48C39.21 42.56 39.24 42.65 39.27 42.73C39.13 42.83 39 42.94 38.86 43.04C38.79 43.02 38.72 43.01 38.65 42.99C38.65 43.07 38.65 43.15 38.65 43.23C38.34 43.47 38.04 43.7 37.73 43.94C37.63 43.93 37.53 43.91 37.43 43.9C37.43 43.98 37.43 44.06 37.43 44.14C37.19 44.31 36.96 44.48 36.72 44.65C36.65 44.59 36.57 44.52 36.5 44.46C36.34 44.66 36.18 44.85 36.01 45.05C35.91 45.11 35.81 45.17 35.7 45.23C35.63 45.19 35.57 45.15 35.5 45.11C35.5 45.19 35.5 45.27 35.5 45.35C35.27 45.49 35.03 45.62 34.8 45.76C34.44 45.5 34.28 45.58 34.19 46.07C33.75 46.26 33.31 46.45 32.88 46.65C32.83 46.59 32.76 46.48 32.73 46.49C32.37 46.59 32.01 46.7 31.65 46.81C31.69 46.91 31.72 47.01 31.76 47.11C31.56 47.17 31.37 47.23 31.17 47.29C31.05 47.22 30.93 47.16 30.81 47.09C30.76 47.21 30.71 47.34 30.66 47.46C29.85 47.67 29.04 47.9 28.22 48.08C27.62 48.21 27 48.31 26.39 48.38C26.15 48.41 25.89 48.3 25.66 48.31C25.29 48.37 24.91 48.48 24.54 48.49C21.41 48.59 18.39 48.02 15.45 46.94C15.44 46.94 15.44 46.91 15.43 46.9C15.36 46.8 15.29 46.7 15.22 46.61C15.16 46.67 15.09 46.72 15.03 46.78C13.85 46.18 12.68 45.57 11.5 44.97C11.42 44.82 11.34 44.68 11.26 44.53C11.2 44.59 11.15 44.64 11.09 44.7C10.92 44.6 10.75 44.5 10.59 44.4C10.56 43.87 10.52 43.83 10.09 44C9.86003 43.83 9.62001 43.66 9.39001 43.49C9.36001 42.96 9.31001 42.92 8.88 43.09C8.81001 43.02 8.74999 42.96 8.67999 42.89C8.62999 42.76 8.58998 42.62 8.53998 42.49C8.48998 42.55 8.43001 42.62 8.38 42.68C8.11 42.44 7.84001 42.21 7.57001 41.97C7.76001 41.34 7.47997 41.05 6.65997 41.06C6.48997 40.86 6.32997 40.66 6.15997 40.46C6.39997 39.98 6.12 39.93 5.75 39.95L5.65997 39.86C5.83997 39.51 5.64998 39.44 5.34998 39.45C5.14998 39.18 4.94999 38.91 4.73999 38.64C4.73999 38.5 4.76002 38.36 4.77002 38.22C4.66002 38.22 4.55001 38.24 4.45001 38.24C4.25001 37.97 4.04998 37.7 3.84998 37.43C3.81998 37.4 3.80002 37.36 3.77002 37.33C3.70002 37.2 3.61999 37.06 3.54999 36.93C3.59999 36.81 3.66002 36.69 3.71002 36.56C3.59002 36.55 3.46998 36.54 3.34998 36.53C3.17998 36.23 3.01003 35.92 2.84003 35.62C3.04003 35.12 2.99003 35 2.53003 34.92C2.36003 34.55 2.20003 34.18 2.03003 33.81C2.08003 33.71 2.19998 33.55 2.16998 33.51C2.08998 33.41 1.95002 33.37 1.83002 33.3C1.64002 32.73 1.45001 32.16 1.26001 31.59C1.22001 31.52 1.18001 31.44 1.14001 31.37C0.920015 30.37 0.67999 29.36 0.48999 28.35C0.39999 27.86 0.399985 27.34 0.359985 26.84C0.449985 26.74 0.540005 26.64 0.630005 26.54C0.520005 26.47 0.419998 26.41 0.309998 26.34C0.279998 25.95 0.23998 25.56 0.22998 25.17C0.22998 24.55 0.22999 23.93 0.23999 23.31C0.36999 23.24 0.489995 23.18 0.619995 23.11C0.529995 23.01 0.439976 22.91 0.349976 22.8C0.349976 22.63 0.350027 22.46 0.340027 22.3C0.430027 22.25 0.519985 22.2 0.609985 22.16C0.549985 22.07 0.479983 21.99 0.419983 21.9C0.489983 21.4 0.570015 20.89 0.640015 20.39C0.760015 20.31 0.89001 20.24 1.01001 20.16C0.92001 20.07 0.82999 19.98 0.73999 19.88C0.87999 19.34 1.01002 18.8 1.15002 18.26C1.17002 18.22 1.19997 18.19 1.21997 18.15C1.33997 18.08 1.47003 18.01 1.59003 17.93C1.51003 17.84 1.42998 17.75 1.34998 17.65C1.41998 17.45 1.49001 17.25 1.57001 17.05C2.00001 16.98 2.37998 16.26 2.16998 15.88C2.14998 15.85 2.08003 15.85 2.03003 15.83C2.24003 15.33 2.44997 14.82 2.65997 14.32C2.68997 14.32 2.71999 14.32 2.73999 14.32C2.85999 14.27 2.97998 14.23 3.09998 14.18C3.00998 14.12 2.92002 14.07 2.83002 14.01C3.54002 12.9 4.25001 11.79 4.95001 10.68C5.51001 11 5.25998 10.11 5.66998 10.2C5.66998 10.06 5.66002 9.92004 5.65002 9.77004C5.69002 9.70004 5.74003 9.64002 5.78003 9.57002C6.11003 9.62002 6.19997 9.45004 6.15997 9.15004C6.32997 8.95004 6.48997 8.75 6.65997 8.55C7.05997 8.65 7.61998 8.38002 7.72998 8.00002C7.75998 7.90002 7.62001 7.76003 7.57001 7.64003C7.84001 7.40003 8.11 7.16001 8.38 6.93001C8.48001 6.98001 8.57999 7.03003 8.67999 7.08003C8.64999 6.96003 8.61002 6.85 8.58002 6.73C8.68002 6.66 8.78 6.60005 8.88 6.53005C9.01 6.55005 9.14003 6.56003 9.28003 6.58003C9.28003 6.46003 9.28003 6.34 9.28003 6.23C9.38003 6.13 9.47001 6.04002 9.57001 5.94002C9.61001 5.91002 9.65 5.89 9.69 5.86C9.79 5.79 9.87998 5.71003 9.97998 5.64003C10.05 5.64003 10.12 5.64003 10.2 5.64003C10.55 5.78003 10.48 5.51003 10.5 5.33003C10.7 5.20003 10.9 5.06001 11.1 4.93001C11.56 5.11001 11.76 4.98003 11.81 4.45003L13.01 3.82002L13.12 3.74001C13.12 3.74001 13.18 3.71999 13.21 3.71999C13.25 3.68999 13.28 3.67003 13.32 3.64003C13.69 3.47003 14.06 3.30002 14.43 3.13002C14.7 3.63002 14.94 3.09004 15.2 3.09004C15.28 3.09004 15.36 2.85 15.44 2.73C17.17 2.09 18.94 1.56999 20.78 1.40999C22.15 1.28999 23.53 1.27002 24.9 1.19002C25.07 1.19002 25.24 1.11001 25.41 1.06001C25.47 1.04001 25.57 0.980007 25.58 0.990007C25.91 1.45001 26.46 1.09004 26.85 1.34004C26.92 1.39004 27.08 1.42002 27.13 1.38002C27.43 1.14002 27.65 1.39999 27.91 1.46999C28.75 1.67999 29.6 1.87003 30.44 2.08003C30.76 2.16003 31.07 2.29004 31.39 2.40004C31.59 2.87004 31.77 2.93001 32.09 2.62001C32.46 2.78001 32.84 2.93999 33.21 3.09999L33.16 3.26003C33.24 3.24003 33.32 3.22003 33.41 3.20003C33.64 3.09003 33.78 3.11002 34.02 3.32002C34.39 3.66002 34.88 3.85 35.33 4.11C35.33 4.56 35.58 4.58002 35.91 4.44002C36.05 4.53002 36.19 4.62004 36.33 4.71004C36.43 5.26004 36.68 5.42 37.44 5.42C37.47 5.42 37.49 5.42 37.52 5.42ZM43.29 26.69C43.25 26.62 43.22 26.55 43.18 26.49C43.22 25.88 43.28 25.26 43.28 24.65C43.28 24.05 43.23 23.46 43.21 22.86C43.26 22.81 43.31 22.77 43.36 22.72C43.28 22.66 43.19 22.61 43.11 22.55C43.11 22.42 43.11 22.28 43.11 22.15C43.2 22.09 43.29 22.03 43.38 21.97C43.26 21.9 43.13 21.82 43.01 21.75C42.88 21.11 42.74 20.47 42.61 19.83C42.7 19.73 42.8 19.63 42.89 19.53C42.76 19.46 42.64 19.39 42.51 19.32C42.3 18.72 42.09 18.11 41.88 17.51C41.85 17.47 41.83 17.44 41.8 17.4C41.79 17.37 41.78 17.34 41.78 17.31C41.75 17.27 41.73 17.24 41.7 17.2C41.7 17.17 41.69 17.13 41.68 17.1L41.58 16.79C41.78 16.48 41.58 15.65 41.27 15.52C41.19 15.49 41.07 15.57 40.97 15.6C40.87 15.4 40.76 15.19 40.66 14.99C40.92 14.68 40.67 14.7 40.46 14.69C40.36 14.56 40.26 14.42 40.16 14.29C40.18 14.17 40.2 14.06 40.21 13.94C40.13 13.96 40.04 13.97 39.96 13.99C39.89 13.89 39.83 13.79 39.76 13.69V13.5C39.76 13.5 39.67 13.42 39.63 13.38C39.57 13.32 39.51 13.26 39.45 13.2C39.15 12.83 38.84 12.45 38.54 12.08C38.69 11.61 38.64 11.56 38.13 11.67C37.73 11.28 37.33 10.88 36.94 10.49C37.02 10.39 37.1 10.29 37.18 10.18C36.99 10.18 36.81 10.18 36.62 10.17C36.52 10.07 36.42 9.97001 36.32 9.87001C36.32 9.67001 36.34 9.41 36.02 9.67C35.58 9.36 35.15 9.06002 34.71 8.75002C34.72 8.66002 34.73 8.58001 34.74 8.49001C34.63 8.51001 34.52 8.53 34.4 8.55C34.3 8.48 34.2 8.40003 34.1 8.33003C34.04 8.18003 33.97 8.02001 33.91 7.87001L33.69 8.06001C33.52 7.98001 33.36 7.90003 33.19 7.83003C33.15 7.44003 32.58 6.90004 32.22 6.96004C32.13 6.98004 32.06 7.12999 31.98 7.21999C31.87 7.17999 31.76 7.15 31.65 7.11C31.59 7.07 31.54 7.04002 31.48 7.00002C30.77 6.73002 30.06 6.47003 29.36 6.20003C29.3 6.08003 29.24 5.95003 29.18 5.83003C29.07 5.92003 28.97 6.01 28.86 6.11C28.19 5.98 27.51 5.84004 26.84 5.71004C26.8 5.68004 26.77 5.66002 26.73 5.63002C26.53 5.63002 26.33 5.62 26.14 5.61C26.08 5.48 26.02 5.36 25.95 5.23C25.84 5.3 25.74 5.36001 25.63 5.43001C25.63 5.49001 25.63 5.55 25.63 5.61C25.08 5.55 24.53 5.45002 23.98 5.44002C23.36 5.43002 22.73 5.49999 22.1 5.53999C22.04 5.43999 21.98 5.35002 21.93 5.25002C21.85 5.37002 21.78 5.50001 21.7 5.62001C21.6 5.62001 21.5 5.62001 21.4 5.62001C21.32 5.53001 21.24 5.43999 21.16 5.34999C21.07 5.44999 20.99 5.55004 20.9 5.65004L19.79 5.84999C19.68 5.77999 19.57 5.72004 19.46 5.65004C19.4 5.75004 19.35 5.85004 19.29 5.96004C18.49 6.23004 17.69 6.48003 16.89 6.76003C16.58 6.87003 16.28 7.02999 15.97 7.15999C15.66 6.97999 14.75 7.20003 14.59 7.51003C14.56 7.57003 14.63 7.68003 14.66 7.76003C14.55 7.82003 14.44 7.88001 14.33 7.93001C13.99 7.79001 13.75 7.81003 13.75 8.26003C13.62 8.36003 13.48 8.46001 13.35 8.56001C12.93 8.41001 12.83 8.47 12.85 8.86C12.51 9.1 12.17 9.34002 11.84 9.57002C11.77 9.55002 11.7 9.54004 11.63 9.52004C11.63 9.60004 11.63 9.68003 11.64 9.76003C11.51 9.86003 11.37 9.96001 11.24 10.06C11.08 10.09 10.9 10.08 10.77 10.15C10.55 10.28 10.6 10.4 10.84 10.46C10.43 10.87 10.03 11.27 9.62 11.68C9.55999 11.44 9.44 11.39 9.31 11.61C9.23 11.74 9.24997 11.92 9.21997 12.08C9.11997 12.21 9.01998 12.35 8.91998 12.48C8.84998 12.48 8.77001 12.46 8.70001 12.45C8.71001 12.52 8.71998 12.6 8.72998 12.67C8.54998 12.97 8.37 13.27 8.19 13.57C8.16 13.6 8.13999 13.62 8.10999 13.65C8.07999 13.66 8.04001 13.67 8.01001 13.68C7.67001 13.63 7.58997 13.74 7.71997 14.08C7.61997 14.25 7.51997 14.42 7.40997 14.58C6.95997 14.58 6.93002 14.82 7.08002 15.16C7.02002 15.23 6.96997 15.31 6.90997 15.38C6.52997 15.45 6.05998 16.18 6.16998 16.54C6.16998 16.57 6.26 16.57 6.31 16.59C6.18 16.93 6.05998 17.28 5.91998 17.62C5.77998 17.98 5.61997 18.35 5.46997 18.71C5.41997 18.74 5.37001 18.77 5.32001 18.81C5.37001 18.84 5.41002 18.88 5.46002 18.91C5.43002 19.08 5.4 19.25 5.37 19.42C5.33999 19.46 5.31998 19.49 5.28998 19.53C5.10998 20.27 4.94001 21 4.76001 21.74C4.67001 21.8 4.5 21.86 4.5 21.92C4.5 22.03 4.59997 22.14 4.65997 22.25C4.65997 22.35 4.68 22.45 4.69 22.55C4.13 22.62 4.41002 22.85 4.58002 23.07C4.58002 23.92 4.57002 24.77 4.58002 25.62C4.58002 25.91 4.62997 26.2 4.65997 26.49C4.56997 26.57 4.47001 26.65 4.38 26.73C4.48 26.82 4.59 26.91 4.69 27C4.77 27.58 4.84 28.15 4.94 28.72C5 29.06 5.1 29.39 5.19 29.72C5.12 29.83 5.04998 29.93 4.97998 30.04C5.07998 30.1 5.18003 30.16 5.28003 30.22C5.34003 30.25 5.40002 30.29 5.46002 30.32C5.55002 30.68 5.60997 31.05 5.71997 31.4C5.87997 31.89 6.08002 32.36 6.27002 32.84C6.22002 32.99 6.08 33.21 6.13 33.26C6.37 33.53 6.31 34.1 6.88 34.05C6.95001 34.16 7.01002 34.26 7.08002 34.37C6.94002 34.71 6.95997 34.95 7.40997 34.95C7.49997 35.09 7.58999 35.22 7.67999 35.36C7.63999 35.43 7.6 35.49 7.56 35.56C7.64 35.56 7.71999 35.56 7.79999 35.56C8.26999 36.2 8.74002 36.83 9.21002 37.47C9.21002 37.61 9.17999 37.78 9.23999 37.9C9.34999 38.12 9.50998 38.22 9.60999 37.88C9.97999 38.25 10.35 38.62 10.72 38.99C10.67 39.38 10.84 39.55 11.23 39.5C11.36 39.59 11.49 39.67 11.62 39.76C11.89 39.95 12.16 40.14 12.43 40.33C12.47 40.36 12.51 40.38 12.55 40.41C12.71 40.55 12.87 40.69 13.04 40.83C13.04 41.12 13.14 41.28 13.45 41.11C13.58 41.19 13.71 41.26 13.84 41.34C13.84 41.64 13.94 41.78 14.25 41.61C14.38 41.68 14.51 41.76 14.64 41.83C14.7 42.4 15.17 42.65 15.75 42.41C15.92 42.48 16.09 42.55 16.25 42.62C16.37 42.67 16.5 42.71 16.62 42.76C17.24 42.98 17.85 43.2 18.47 43.42C18.54 43.52 18.61 43.62 18.68 43.73C18.78 43.64 18.88 43.54 18.98 43.45C19.41 43.57 19.85 43.7 20.28 43.82C20.48 43.86 20.68 43.91 20.89 43.95C20.97 44.04 21.05 44.13 21.12 44.22C21.18 44.16 21.23 44.09 21.29 44.03C21.32 44.03 21.36 44.03 21.39 44.03C21.59 44.03 21.79 44 21.99 44C22.5 44 23 44.03 23.51 44.04C23.61 44.04 23.71 43.99 23.81 44C24.1 44.04 24.39 44.14 24.67 44.13C25.46 44.09 26.24 44 27.03 43.93C27.14 44 27.24 44.11 27.35 44.12C27.4 44.12 27.48 43.95 27.54 43.86C27.78 43.79 28.01 43.73 28.25 43.66L28.36 43.9C28.42 43.78 28.49 43.67 28.55 43.55C29.26 43.35 29.96 43.15 30.67 42.95C30.82 43 31.04 43.13 31.1 43.08C31.3 42.91 31.78 43.02 31.67 42.54C31.8 42.47 31.94 42.41 32.07 42.34C32.25 42.38 32.48 42.5 32.59 42.43C32.72 42.35 32.75 42.11 32.83 41.93C33.05 41.82 33.26 41.71 33.48 41.6C33.56 41.67 33.7 41.8 33.7 41.8C33.94 41.55 34.47 41.56 34.39 41.03C34.66 40.85 34.93 40.68 35.19 40.5C35.24 40.56 35.28 40.61 35.33 40.67C35.38 40.54 35.44 40.42 35.49 40.29C35.66 40.16 35.83 40.02 36 39.89C36.14 39.89 36.29 39.9 36.43 39.91L36.3 39.59C36.47 39.45 36.64 39.32 36.8 39.18C36.92 39.46 37.11 39.37 37.28 39.25C37.53 39.07 37.61 38.85 37.4 38.59C37.5 38.49 37.6 38.39 37.7 38.29C38.33 38.45 38.42 38.36 38.41 37.57C38.49 37.47 38.56 37.38 38.64 37.28C38.78 37.28 38.93 37.26 39.07 37.26C39.05 37.13 39.03 37 39.01 36.88C39.14 36.71 39.28 36.54 39.41 36.37C39.54 36.32 39.66 36.26 39.79 36.21C39.73 36.16 39.68 36.12 39.62 36.07C39.82 35.77 40.03 35.46 40.23 35.16C40.75 35.48 40.56 34.73 40.87 34.73C40.83 34.6 40.79 34.46 40.75 34.33C40.9 34.01 41.06 33.69 41.21 33.36C41.31 33.41 41.41 33.48 41.52 33.49C41.55 33.49 41.66 33.3 41.63 33.26C41.58 33.17 41.46 33.12 41.36 33.06C41.45 32.89 41.55 32.72 41.64 32.55C42.14 32.66 42.05 32.17 42.21 31.95C42.26 31.89 42.1 31.68 42.04 31.54C42.13 31.2 42.23 30.87 42.31 30.52C42.34 30.39 42.31 30.25 42.34 30.13C42.39 29.96 42.47 29.79 42.54 29.63C42.61 29.56 42.68 29.49 42.75 29.42L43.02 29.25C42.93 29.21 42.84 29.16 42.75 29.12C42.79 28.89 42.83 28.65 42.87 28.42C42.99 28.37 43.23 28.31 43.23 28.27C43.2 28.01 43.12 27.76 43.05 27.51C43.05 27.34 43.07 27.18 43.08 27.01C43.14 26.91 43.2 26.81 43.27 26.71L43.29 26.69Z"
                                    fill="#231F20" />
                                <path
                                    d="M7.58002 7.64001C7.64002 7.76001 7.76999 7.9 7.73999 8C7.63999 8.38 7.06998 8.65999 6.66998 8.54999C6.96998 8.24999 7.27001 7.94001 7.57001 7.64001H7.58002Z"
                                    fill="#231F20" />
                                <path d="M6.66998 41.02C7.48998 41.02 7.77002 41.3 7.58002 41.93L6.66998 41.02Z"
                                    fill="#231F20" />
                                <path
                                    d="M2.03003 15.81C2.03003 15.81 2.14998 15.83 2.16998 15.86C2.37998 16.23 2.00001 16.96 1.57001 17.03C1.72001 16.63 1.88003 16.22 2.03003 15.82V15.81Z"
                                    fill="#231F20" />
                                <path
                                    d="M40.27 41.82C39.75 41.49 40.3 41.37 40.42 41.23C40.53 41.1 40.69 40.64 40.97 41.12C40.74 41.35 40.5 41.59 40.27 41.82Z"
                                    fill="#231F20" />
                                <path
                                    d="M37.43 5.41998C36.67 5.41998 36.43 5.26002 36.32 4.71002C36.66 4.86002 36.99 5.00002 37.33 5.15002C37.35 5.18002 37.38 5.19998 37.4 5.22998C37.4 5.25998 37.42 5.30002 37.43 5.33002C37.43 5.36002 37.43 5.39999 37.43 5.42999V5.41998Z"
                                    fill="#231F20" />
                                <path
                                    d="M31.78 47.09C31.74 46.99 31.71 46.89 31.67 46.79C32.03 46.68 32.39 46.57 32.75 46.47C32.78 46.47 32.85 46.58 32.9 46.63C32.53 46.78 32.15 46.93 31.78 47.08V47.09Z"
                                    fill="#231F20" />
                                <path
                                    d="M5.65997 9.76001C5.65997 9.90001 5.66999 10.04 5.67999 10.19C5.26999 10.1 5.52002 10.99 4.96002 10.67C5.19002 10.37 5.42997 10.07 5.65997 9.77002V9.76001Z"
                                    fill="#231F20" />
                                <path
                                    d="M15.45 2.71997C15.37 2.84997 15.29 3.08002 15.21 3.08002C14.95 3.08002 14.71 3.61 14.44 3.12C14.78 2.99 15.11 2.84997 15.45 2.71997Z"
                                    fill="#231F20" />
                                <path
                                    d="M46.39 17.62C45.94 17.36 45.8201 17 46.0901 16.71C46.1901 17.01 46.29 17.31 46.39 17.62Z"
                                    fill="#231F20" />
                                <path
                                    d="M11.82 4.44C11.77 4.96 11.58 5.08998 11.11 4.91998C11.35 4.75998 11.58 4.6 11.82 4.44Z"
                                    fill="#231F20" />
                                <path d="M43.8 12.07C43.31 11.99 43.15 11.76 43.3 11.36C43.47 11.6 43.63 11.83 43.8 12.07Z"
                                    fill="#231F20" />
                                <path
                                    d="M36.03 45.06C36.19 44.86 36.35 44.67 36.52 44.47C36.59 44.53 36.67 44.6 36.74 44.66C36.5 44.79 36.27 44.93 36.03 45.06Z"
                                    fill="#231F20" />
                                <path
                                    d="M2.53003 34.87C2.99003 34.95 3.04003 35.07 2.84003 35.57C2.74003 35.34 2.63003 35.1 2.53003 34.87Z"
                                    fill="#231F20" />
                                <path
                                    d="M38.45 6.21997C38.12 6.31997 37.83 6.07997 37.85 5.71997C37.88 5.71997 37.91 5.71998 37.94 5.72998C37.99 5.75998 38.03 5.78 38.08 5.81C38.2 5.94 38.33 6.08002 38.45 6.21002V6.21997Z"
                                    fill="#231F20" />
                                <path
                                    d="M32.09 2.62C31.77 2.92 31.59 2.87002 31.39 2.40002C31.62 2.47002 31.86 2.55 32.09 2.62Z"
                                    fill="#231F20" />
                                <path
                                    d="M34.21 46.06C34.3 45.57 34.46 45.49 34.82 45.75C34.62 45.85 34.41 45.95 34.21 46.06Z"
                                    fill="#231F20" />
                                <path
                                    d="M5.76001 39.91C6.13001 39.89 6.40998 39.94 6.16998 40.42C6.02998 40.25 5.90001 40.08 5.76001 39.91Z"
                                    fill="#231F20" />
                                <path
                                    d="M8.89001 43.04C9.32001 42.87 9.36002 42.91 9.40002 43.44C9.23002 43.31 9.06001 43.17 8.89001 43.04Z"
                                    fill="#231F20" />
                                <path d="M10.1 43.95C10.53 43.79 10.57 43.82 10.6 44.35C10.43 44.22 10.26 44.08 10.1 43.95Z"
                                    fill="#231F20" />
                                <path
                                    d="M30.68 47.45C30.73 47.33 30.78 47.2 30.83 47.08C30.95 47.15 31.07 47.21 31.19 47.28C31.02 47.34 30.85 47.39 30.68 47.45Z"
                                    fill="#231F20" />
                                <path
                                    d="M1.34998 17.62C1.42998 17.71 1.51003 17.8 1.59003 17.9C1.47003 17.97 1.33997 18.05 1.21997 18.12C1.25997 17.95 1.30998 17.79 1.34998 17.62Z"
                                    fill="#231F20" />
                                <path
                                    d="M4.46002 38.2C4.57002 38.2 4.68003 38.18 4.78003 38.18C4.78003 38.32 4.76 38.46 4.75 38.6C4.65 38.47 4.55001 38.33 4.45001 38.2H4.46002Z"
                                    fill="#231F20" />
                                <path
                                    d="M3.34998 36.48C3.46998 36.49 3.59002 36.5 3.71002 36.51C3.66002 36.63 3.59999 36.75 3.54999 36.88C3.47999 36.75 3.41998 36.61 3.34998 36.48Z"
                                    fill="#231F20" />
                                <path
                                    d="M0.349976 22.77C0.439976 22.87 0.529995 22.97 0.619995 23.08C0.489995 23.15 0.36999 23.21 0.23999 23.28C0.27999 23.11 0.319976 22.94 0.349976 22.78V22.77Z"
                                    fill="#231F20" />
                                <path
                                    d="M9.29999 6.21997V6.57001C9.15999 6.55001 9.03002 6.54002 8.90002 6.52002C9.03002 6.42002 9.16999 6.32002 9.29999 6.21002V6.21997Z"
                                    fill="#231F20" />
                                <path
                                    d="M0.309998 26.3C0.419998 26.37 0.520005 26.43 0.630005 26.5C0.540005 26.6 0.449985 26.7 0.359985 26.8C0.339985 26.63 0.329998 26.47 0.309998 26.3Z"
                                    fill="#231F20" />
                                <path
                                    d="M0.75 19.84C0.84 19.93 0.93002 20.02 1.02002 20.12C0.90002 20.2 0.770024 20.27 0.650024 20.35C0.680024 20.18 0.72 20.01 0.75 19.85V19.84Z"
                                    fill="#231F20" />
                                <path
                                    d="M1.83002 33.25C1.95002 33.32 2.08998 33.36 2.16998 33.46C2.19998 33.49 2.08003 33.65 2.03003 33.76C1.96003 33.59 1.90002 33.42 1.83002 33.26V33.25Z"
                                    fill="#231F20" />
                                <path d="M43.08 38.6C42.9 38.25 43 38.08 43.39 38.09C43.29 38.26 43.18 38.43 43.08 38.6Z"
                                    fill="#231F20" />
                                <path
                                    d="M2.84003 13.99C2.93003 14.05 3.01999 14.1 3.10999 14.16C2.98999 14.21 2.87 14.25 2.75 14.3C2.75 14.26 2.75 14.23 2.75 14.19C2.78 14.13 2.81003 14.06 2.84003 14V13.99Z"
                                    fill="#231F20" />
                                <path
                                    d="M11.11 44.66C11.17 44.6 11.22 44.55 11.28 44.49C11.36 44.64 11.44 44.78 11.52 44.93C11.38 44.84 11.25 44.75 11.11 44.65V44.66Z"
                                    fill="#231F20" />
                                <path d="M44.6 13.39C44.15 13.39 44.13 13.14 44.27 12.8C44.38 12.99 44.49 13.19 44.6 13.39Z"
                                    fill="#231F20" />
                                <path
                                    d="M47.51 23.27C47.42 23.21 47.32 23.15 47.23 23.08C47.3 23.01 47.36 22.93 47.43 22.86C47.46 23 47.48 23.13 47.51 23.27Z"
                                    fill="#231F20" />
                                <path
                                    d="M35.9 4.44C35.56 4.58 35.32 4.55999 35.32 4.10999C35.51 4.21999 35.71 4.33 35.9 4.44Z"
                                    fill="#231F20" />
                                <path
                                    d="M8.59003 6.71997C8.62003 6.83997 8.66 6.95001 8.69 7.07001C8.59 7.02001 8.49001 6.96998 8.39001 6.91998C8.46001 6.84998 8.52003 6.78997 8.59003 6.71997Z"
                                    fill="#231F20" />
                                <path
                                    d="M42.19 39.71C42.19 39.59 42.17 39.46 42.16 39.34C42.23 39.4 42.31 39.46 42.38 39.52C42.32 39.59 42.25 39.65 42.19 39.72V39.71Z"
                                    fill="#231F20" />
                                <path
                                    d="M39.26 42.73L39.17 42.48C39.3 42.46 39.43 42.45 39.56 42.43C39.46 42.53 39.36 42.63 39.26 42.73Z"
                                    fill="#231F20" />
                                <path
                                    d="M8.39001 42.64C8.44001 42.58 8.49999 42.51 8.54999 42.45C8.59999 42.58 8.64 42.72 8.69 42.85C8.59 42.78 8.49001 42.71 8.39001 42.64Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.77 9.34998C41.69 9.37998 41.6 9.41 41.52 9.44C41.5 9.31 41.49 9.17999 41.47 9.04999C41.57 9.14999 41.67 9.24998 41.77 9.34998Z"
                                    fill="#231F20" />
                                <path
                                    d="M5.35999 39.4C5.64999 39.4 5.84998 39.46 5.66998 39.81C5.56998 39.67 5.46999 39.54 5.35999 39.4Z"
                                    fill="#231F20" />
                                <path
                                    d="M0.419983 21.86C0.479983 21.95 0.549985 22.03 0.609985 22.12C0.519985 22.17 0.430027 22.22 0.340027 22.26C0.370027 22.13 0.389983 21.99 0.419983 21.86Z"
                                    fill="#231F20" />
                                <path
                                    d="M39.66 7.22998C39.53 7.20998 39.4 7.19999 39.27 7.17999L39.36 6.92999C39.46 7.02999 39.56 7.12998 39.66 7.22998Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.57 40.42C41.59 40.29 41.6 40.16 41.62 40.03C41.7 40.06 41.79 40.09 41.87 40.12C41.77 40.22 41.67 40.32 41.57 40.43V40.42Z"
                                    fill="#231F20" />
                                <path
                                    d="M42.72 10.48C42.64 10.51 42.55 10.54 42.47 10.58C42.47 10.47 42.49 10.37 42.49 10.26C42.57 10.33 42.64 10.41 42.72 10.48Z"
                                    fill="#231F20" />
                                <path
                                    d="M10.51 5.31C10.49 5.49 10.56 5.76 10.21 5.62C10.21 5.58 10.21 5.55001 10.21 5.51001C10.31 5.44001 10.41 5.37 10.51 5.31Z"
                                    fill="#231F20" />
                                <path
                                    d="M37.44 44.14C37.44 44.06 37.44 43.98 37.44 43.9C37.54 43.91 37.64 43.93 37.74 43.94C37.64 44.01 37.54 44.07 37.44 44.14Z"
                                    fill="#231F20" />
                                <path
                                    d="M6.16998 9.14001C6.20998 9.43001 6.11998 9.6 5.78998 9.56C5.91998 9.42 6.03998 9.28001 6.16998 9.14001Z"
                                    fill="#231F20" />
                                <path
                                    d="M15.05 46.74C15.11 46.68 15.18 46.63 15.24 46.57C15.31 46.67 15.38 46.77 15.45 46.86C15.32 46.82 15.18 46.78 15.05 46.73V46.74Z"
                                    fill="#231F20" />
                                <path
                                    d="M35.52 45.35C35.52 45.27 35.52 45.19 35.52 45.11C35.59 45.15 35.65 45.19 35.72 45.23C35.65 45.27 35.59 45.31 35.52 45.35Z"
                                    fill="#231F20" />
                                <path
                                    d="M42.98 10.86C42.92 10.88 42.85 10.89 42.79 10.91C42.79 10.82 42.78 10.72 42.77 10.63C42.84 10.71 42.91 10.79 42.98 10.86Z"
                                    fill="#231F20" />
                                <path
                                    d="M38.65 43.24V43C38.71 43.02 38.78 43.03 38.85 43.05C38.78 43.11 38.72 43.18 38.65 43.24Z"
                                    fill="#231F20" />
                                <path
                                    d="M33.41 3.19C33.33 3.21 33.25 3.23 33.16 3.25L33.21 3.09003C33.28 3.12003 33.34 3.14999 33.41 3.17999V3.19Z"
                                    fill="#231F20" />
                                <path d="M45.61 15.5C45.55 15.37 45.5 15.25 45.44 15.12C45.5 15.25 45.55 15.38 45.61 15.5Z"
                                    fill="#231F20" />
                                <path
                                    d="M38.07 5.81L37.93 5.72998C37.93 5.72998 38.02 5.67997 38.07 5.65997C38.07 5.70997 38.07 5.76 38.07 5.81Z"
                                    fill="#231F20" />
                                <path
                                    d="M47.5 26.6C47.5 26.6 47.4 26.53 47.36 26.5C47.41 26.47 47.46 26.43 47.51 26.4C47.51 26.47 47.51 26.53 47.51 26.6H47.5Z"
                                    fill="#231F20" />
                                <path
                                    d="M10.21 5.52002C10.21 5.52002 10.21 5.59 10.21 5.63C10.14 5.63 10.07 5.63 9.98999 5.63C10.06 5.59 10.13 5.56002 10.2 5.52002H10.21Z"
                                    fill="#231F20" />
                                <path
                                    d="M37.43 5.41998C37.43 5.41998 37.43 5.35001 37.43 5.32001C37.46 5.35001 37.48 5.38998 37.51 5.41998C37.48 5.41998 37.46 5.41998 37.43 5.41998Z"
                                    fill="#231F20" />
                                <path
                                    d="M37.4 5.21997C37.4 5.21997 37.35 5.17001 37.33 5.14001C37.35 5.17001 37.38 5.18997 37.4 5.21997Z"
                                    fill="#231F20" />
                                <path
                                    d="M9.70001 5.84998C9.70001 5.84998 9.62002 5.89999 9.58002 5.92999C9.62002 5.89999 9.66001 5.87998 9.70001 5.84998Z"
                                    fill="#231F20" />
                                <path
                                    d="M45.32 34.76C45.32 34.76 45.37 34.69 45.4 34.65C45.37 34.69 45.35 34.72 45.32 34.76Z"
                                    fill="#231F20" />
                                <path
                                    d="M2.73999 14.18C2.73999 14.18 2.73999 14.25 2.73999 14.29C2.70999 14.29 2.67997 14.29 2.65997 14.29C2.68997 14.25 2.70999 14.22 2.73999 14.18Z"
                                    fill="#231F20" />
                                <path
                                    d="M13.33 3.63C13.33 3.63 13.26 3.68002 13.22 3.71002C13.26 3.68002 13.29 3.66 13.33 3.63Z"
                                    fill="#231F20" />
                                <path
                                    d="M1.22998 18.12C1.22998 18.12 1.17997 18.19 1.15997 18.23C1.17997 18.19 1.20998 18.16 1.22998 18.12Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.47 16.82C41.3 16.42 41.13 16.02 40.96 15.62C41.06 15.59 41.18 15.51 41.26 15.54C41.58 15.67 41.77 16.51 41.57 16.81C41.54 16.81 41.5 16.81 41.47 16.81V16.82Z"
                                    fill="#231F20" />
                                <path
                                    d="M33.2 7.82999C32.8 7.62999 32.39 7.42996 31.99 7.22996C32.07 7.13996 32.14 6.97995 32.23 6.96995C32.59 6.90995 33.16 7.44 33.2 7.84V7.82999Z"
                                    fill="#231F20" />
                                <path
                                    d="M15.97 7.13999C15.53 7.33999 15.1 7.53997 14.66 7.73997C14.63 7.65997 14.56 7.54997 14.59 7.48997C14.75 7.17997 15.66 6.94999 15.97 7.13999Z"
                                    fill="#231F20" />
                                <path
                                    d="M6.26001 32.85C6.46001 33.25 6.66 33.66 6.87 34.06C6.3 34.11 6.37 33.54 6.12 33.27C6.07 33.22 6.21001 32.99 6.26001 32.85Z"
                                    fill="#231F20" />
                                <path
                                    d="M6.88999 15.41C6.68999 15.81 6.48995 16.22 6.28995 16.62C6.23995 16.6 6.16 16.6 6.15 16.57C6.04 16.21 6.50999 15.48 6.88999 15.41Z"
                                    fill="#231F20" />
                                <path
                                    d="M14.64 41.84C15.01 42.03 15.38 42.22 15.75 42.42C15.17 42.66 14.69 42.42 14.64 41.84Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.66 32.54C41.79 32.2 41.93 31.87 42.06 31.53C42.12 31.67 42.28 31.89 42.23 31.94C42.06 32.15 42.15 32.64 41.66 32.54Z"
                                    fill="#231F20" />
                                <path
                                    d="M20.29 43.82C20.47 43.23 20.88 43.8 21.16 43.65C21.17 43.65 21.32 43.89 21.4 44.02C21.37 44.02 21.33 44.02 21.3 44.02C21.16 43.99 21.03 43.97 20.89 43.94C20.69 43.9 20.49 43.85 20.28 43.81L20.29 43.82Z"
                                    fill="#231F20" />
                                <path
                                    d="M30.68 42.95C31.02 42.81 31.35 42.68 31.69 42.54C31.79 43.02 31.31 42.91 31.12 43.08C31.06 43.13 30.83 43 30.69 42.95H30.68Z"
                                    fill="#231F20" />
                                <path
                                    d="M33.5 41.61C33.8 41.42 34.11 41.23 34.41 41.03C34.49 41.56 33.96 41.55 33.72 41.8C33.72 41.8 33.58 41.67 33.5 41.6V41.61Z"
                                    fill="#231F20" />
                                <path
                                    d="M36.83 39.19L37.43 38.59C37.64 38.86 37.55 39.08 37.31 39.25C37.14 39.37 36.95 39.47 36.83 39.18V39.19Z"
                                    fill="#231F20" />
                                <path
                                    d="M40.25 35.16C40.42 34.88 40.6 34.61 40.77 34.33C40.81 34.46 40.85 34.6 40.89 34.73C40.58 34.73 40.78 35.48 40.25 35.16Z"
                                    fill="#231F20" />
                                <path
                                    d="M37.73 38.29C37.97 38.05 38.2 37.81 38.44 37.57C38.44 38.35 38.36 38.44 37.73 38.29Z"
                                    fill="#231F20" />
                                <path
                                    d="M42.9 28.41C42.96 28.11 43.02 27.8 43.08 27.5C43.15 27.75 43.23 28 43.26 28.26C43.26 28.29 43.03 28.36 42.9 28.41Z"
                                    fill="#231F20" />
                                <path
                                    d="M32.09 42.34C32.34 42.21 32.6 42.07 32.85 41.94C32.77 42.11 32.74 42.36 32.61 42.44C32.49 42.51 32.27 42.38 32.09 42.35V42.34Z"
                                    fill="#231F20" />
                                <path
                                    d="M36.94 10.49C36.84 10.38 36.73 10.28 36.63 10.17C36.82 10.17 37 10.17 37.19 10.18C37.11 10.28 37.03 10.38 36.95 10.49H36.94Z"
                                    fill="#231F20" />
                                <path
                                    d="M4.64001 26.5C4.64001 26.67 4.65998 26.84 4.66998 27.01C4.56998 26.92 4.45999 26.83 4.35999 26.74C4.44999 26.66 4.55001 26.58 4.64001 26.5Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.24 33.36C41.29 33.26 41.34 33.15 41.39 33.05C41.48 33.12 41.6 33.16 41.66 33.25C41.69 33.3 41.58 33.49 41.55 33.48C41.45 33.47 41.35 33.4 41.24 33.35V33.36Z"
                                    fill="#231F20" />
                                <path
                                    d="M4.66999 22.56C4.62999 22.73 4.60001 22.91 4.56001 23.08C4.39001 22.86 4.10999 22.63 4.66999 22.56Z"
                                    fill="#231F20" />
                                <path
                                    d="M42.59 19.84C42.56 19.67 42.53 19.5 42.5 19.34C42.63 19.41 42.75 19.48 42.88 19.55C42.79 19.65 42.69 19.75 42.6 19.85L42.59 19.84Z"
                                    fill="#231F20" />
                                <path
                                    d="M9.19998 37.47C9.32998 37.61 9.46995 37.74 9.59995 37.88C9.49995 38.22 9.33995 38.12 9.22995 37.9C9.16995 37.78 9.20998 37.62 9.19998 37.47Z"
                                    fill="#231F20" />
                                <path
                                    d="M26.14 5.60999C26.04 5.60999 25.94 5.60999 25.84 5.60999L25.64 5.42999C25.75 5.35999 25.85 5.29998 25.96 5.22998C26.02 5.35998 26.08 5.47999 26.15 5.60999H26.14Z"
                                    fill="#231F20" />
                                <path
                                    d="M38.67 37.28C38.79 37.14 38.92 37.01 39.04 36.87C39.06 37 39.08 37.13 39.1 37.25C38.96 37.25 38.81 37.27 38.67 37.27V37.28Z"
                                    fill="#231F20" />
                                <path
                                    d="M29.37 6.21002C29.2 6.18002 29.03 6.13999 28.87 6.10999C28.98 6.01999 29.08 5.93002 29.19 5.83002C29.25 5.95002 29.31 6.08001 29.37 6.20001V6.21002Z"
                                    fill="#231F20" />
                                <path
                                    d="M9.60999 11.68C9.47999 11.82 9.34002 11.9501 9.21002 12.0901C9.24002 11.9301 9.22999 11.75 9.29999 11.62C9.42999 11.4 9.54999 11.45 9.60999 11.69V11.68Z"
                                    fill="#231F20" />
                                <path
                                    d="M13.34 8.56003C13.17 8.66003 13.01 8.76002 12.84 8.86002C12.81 8.47002 12.92 8.41003 13.34 8.56003Z"
                                    fill="#231F20" />
                                <path
                                    d="M11.23 10.07C11.1 10.2 10.96 10.34 10.83 10.47C10.59 10.41 10.54 10.29 10.76 10.16C10.89 10.08 11.07 10.1 11.23 10.07Z"
                                    fill="#231F20" />
                                <path
                                    d="M38.54 12.09C38.4 11.95 38.27 11.82 38.13 11.68C38.63 11.57 38.68 11.62 38.54 12.09Z"
                                    fill="#231F20" />
                                <path
                                    d="M27.04 43.93C27.21 43.91 27.38 43.88 27.55 43.86C27.49 43.95 27.41 44.13 27.36 44.12C27.25 44.1 27.15 44 27.04 43.93Z"
                                    fill="#231F20" />
                                <path
                                    d="M22.11 5.53003C21.97 5.56003 21.84 5.57999 21.7 5.60999C21.78 5.48999 21.85 5.35999 21.93 5.23999C21.99 5.33999 22.05 5.43003 22.1 5.53003H22.11Z"
                                    fill="#231F20" />
                                <path
                                    d="M19.79 5.83002C19.62 5.87002 19.46 5.9 19.29 5.94C19.35 5.84 19.4 5.74 19.46 5.63C19.57 5.7 19.68 5.76002 19.79 5.83002Z"
                                    fill="#231F20" />
                                <path
                                    d="M34.11 8.33002C33.97 8.24002 33.84 8.15 33.7 8.06C33.77 8 33.85 7.93 33.92 7.87C33.98 8.02 34.05 8.18002 34.11 8.33002Z"
                                    fill="#231F20" />
                                <path
                                    d="M18.48 43.43L18.99 43.46C18.89 43.55 18.79 43.65 18.69 43.74C18.62 43.64 18.55 43.54 18.48 43.43Z"
                                    fill="#231F20" />
                                <path
                                    d="M36.02 39.9C36.12 39.8 36.22 39.7 36.32 39.6L36.45 39.92C36.31 39.92 36.16 39.91 36.02 39.9Z"
                                    fill="#231F20" />
                                <path
                                    d="M10.7199 38.99C10.8899 39.16 11.06 39.33 11.23 39.5C10.84 39.55 10.6699 39.39 10.7199 38.99Z"
                                    fill="#231F20" />
                                <path
                                    d="M5.17999 29.73C5.23999 29.87 5.31 30.01 5.37 30.15C5.34 30.18 5.30002 30.2 5.27002 30.23C5.17002 30.17 5.06997 30.11 4.96997 30.05C5.03997 29.94 5.10999 29.84 5.17999 29.73Z"
                                    fill="#231F20" />
                                <path
                                    d="M14.32 7.92001C14.13 8.03001 13.93 8.14002 13.74 8.25002C13.74 7.80002 13.98 7.77001 14.32 7.92001Z"
                                    fill="#231F20" />
                                <path
                                    d="M21.4 5.60999C21.23 5.60999 21.07 5.63001 20.9 5.64001C20.99 5.54001 21.07 5.44003 21.16 5.34003C21.24 5.43003 21.32 5.51999 21.4 5.60999Z"
                                    fill="#231F20" />
                                <path
                                    d="M4.75 21.76C4.72 21.93 4.68002 22.1 4.65002 22.26C4.59002 22.15 4.48999 22.04 4.48999 21.93C4.48999 21.87 4.66 21.81 4.75 21.75V21.76Z"
                                    fill="#231F20" />
                                <path
                                    d="M7.98997 13.7C7.88997 13.83 7.79 13.97 7.7 14.1C7.57 13.76 7.65997 13.65 7.98997 13.7Z"
                                    fill="#231F20" />
                                <path
                                    d="M43.1 22.16C43.07 22.03 43.03 21.89 43 21.76C43.12 21.83 43.25 21.91 43.37 21.98C43.28 22.04 43.19 22.1 43.1 22.16Z"
                                    fill="#231F20" />
                                <path
                                    d="M42.57 29.42C42.64 29.32 42.71 29.22 42.78 29.12C42.87 29.16 42.96 29.21 43.05 29.25L42.78 29.42C42.71 29.42 42.64 29.42 42.57 29.42Z"
                                    fill="#231F20" />
                                <path
                                    d="M7.38999 14.6C7.27999 14.79 7.16997 14.99 7.05997 15.18C6.91997 14.84 6.93999 14.59 7.38999 14.6Z"
                                    fill="#231F20" />
                                <path
                                    d="M7.06002 34.38C7.17002 34.57 7.28004 34.77 7.39004 34.96C6.94004 34.96 6.91002 34.72 7.06002 34.38Z"
                                    fill="#231F20" />
                                <path
                                    d="M20.9 43.96C21.04 43.99 21.17 44.01 21.31 44.04C21.25 44.1 21.2 44.17 21.14 44.23C21.06 44.14 20.98 44.05 20.91 43.96H20.9Z"
                                    fill="#231F20" />
                                <path
                                    d="M40.15 14.3C40.08 14.2 40.02 14.1 39.95 14C40.03 13.98 40.12 13.97 40.2 13.95C40.18 14.07 40.16 14.18 40.15 14.3Z"
                                    fill="#231F20" />
                                <path
                                    d="M39.44 36.37C39.51 36.27 39.58 36.17 39.65 36.07C39.71 36.12 39.76 36.16 39.82 36.21C39.69 36.26 39.57 36.32 39.44 36.37Z"
                                    fill="#231F20" />
                                <path
                                    d="M35.21 40.5C35.31 40.43 35.41 40.36 35.51 40.29C35.46 40.42 35.4 40.54 35.35 40.67C35.3 40.61 35.26 40.56 35.21 40.5Z"
                                    fill="#231F20" />
                                <path
                                    d="M28.26 43.66C28.36 43.62 28.46 43.59 28.56 43.55C28.5 43.67 28.43 43.78 28.37 43.9L28.26 43.66Z"
                                    fill="#231F20" />
                                <path
                                    d="M13.03 40.83C13.17 40.92 13.3 41.02 13.44 41.11C13.13 41.28 13.03 41.13 13.03 40.83Z"
                                    fill="#231F20" />
                                <path
                                    d="M13.84 41.34C13.98 41.43 14.12 41.52 14.25 41.61C13.94 41.78 13.84 41.63 13.84 41.34Z"
                                    fill="#231F20" />
                                <path
                                    d="M43.1 27C43.06 26.9 43.02 26.8 42.97 26.7C43.07 26.7 43.18 26.7 43.28 26.7C43.22 26.8 43.16 26.9 43.09 27H43.1Z"
                                    fill="#231F20" />
                                <path
                                    d="M34.71 8.75C34.61 8.68 34.51 8.61999 34.41 8.54999C34.52 8.52999 34.63 8.50999 34.75 8.48999C34.74 8.57999 34.73 8.66 34.72 8.75H34.71Z"
                                    fill="#231F20" />
                                <path
                                    d="M40.65 15.01C40.58 14.91 40.52 14.81 40.45 14.71C40.66 14.72 40.9 14.71 40.65 15.01Z"
                                    fill="#231F20" />
                                <path
                                    d="M36.32 9.86998C36.22 9.79998 36.12 9.72997 36.02 9.66997C36.34 9.41997 36.31 9.66998 36.32 9.86998Z"
                                    fill="#231F20" />
                                <path
                                    d="M43.2 22.87C43.17 22.77 43.13 22.67 43.1 22.57L43.35 22.74C43.35 22.74 43.25 22.83 43.2 22.88V22.87Z"
                                    fill="#231F20" />
                                <path
                                    d="M11.83 9.57001C11.76 9.63001 11.7 9.70001 11.63 9.76001C11.63 9.68001 11.63 9.60002 11.62 9.52002C11.69 9.54002 11.76 9.55001 11.83 9.57001Z"
                                    fill="#231F20" />
                                <path
                                    d="M8.90002 12.49L8.71002 12.69C8.70002 12.62 8.68999 12.54 8.67999 12.47C8.74999 12.47 8.83002 12.49 8.90002 12.5V12.49Z"
                                    fill="#231F20" />
                                <path
                                    d="M7.66998 35.37C7.70998 35.43 7.74998 35.5 7.78998 35.56C7.70998 35.56 7.62999 35.56 7.54999 35.56C7.58999 35.49 7.62998 35.43 7.66998 35.36V35.37Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.47 16.82C41.47 16.82 41.54 16.82 41.57 16.82C41.6 16.92 41.64 17.03 41.67 17.13C41.6 17.03 41.54 16.93 41.47 16.83V16.82Z"
                                    fill="#231F20" />
                                <path
                                    d="M43.28 26.7C43.18 26.7 43.07 26.7 42.97 26.7C43.04 26.63 43.1 26.56 43.17 26.49C43.21 26.56 43.24 26.63 43.28 26.69V26.7Z"
                                    fill="#231F20" />
                                <path
                                    d="M42.57 29.42C42.64 29.42 42.71 29.42 42.78 29.42C42.71 29.49 42.64 29.56 42.57 29.63C42.57 29.56 42.57 29.49 42.57 29.42Z"
                                    fill="#231F20" />
                                <path
                                    d="M16.26 42.62C16.38 42.67 16.51 42.72 16.63 42.76C16.51 42.71 16.38 42.66 16.26 42.62Z"
                                    fill="#231F20" />
                                <path
                                    d="M5.45001 18.73V18.93C5.40001 18.9 5.34999 18.86 5.29999 18.83C5.34999 18.8 5.40001 18.77 5.45001 18.73Z"
                                    fill="#231F20" />
                                <path
                                    d="M25.64 5.41998L25.84 5.59998C25.77 5.59998 25.71 5.59998 25.64 5.59998C25.64 5.53998 25.64 5.47998 25.64 5.41998Z"
                                    fill="#231F20" />
                                <path
                                    d="M5.27002 30.23C5.27002 30.23 5.34 30.18 5.37 30.15L5.45001 30.33C5.39001 30.3 5.33002 30.26 5.27002 30.23Z"
                                    fill="#231F20" />
                                <path
                                    d="M12.43 40.33C12.43 40.33 12.51 40.38 12.55 40.41C12.51 40.38 12.47 40.36 12.43 40.33Z"
                                    fill="#231F20" />
                                <path
                                    d="M26.85 5.71002C26.85 5.71002 26.78 5.66 26.74 5.63C26.78 5.66 26.81 5.68002 26.85 5.71002Z"
                                    fill="#231F20" />
                                <path
                                    d="M8.16998 13.59C8.16998 13.59 8.12003 13.64 8.09003 13.67C8.12003 13.64 8.13998 13.62 8.16998 13.59Z"
                                    fill="#231F20" />
                                <path
                                    d="M5.34998 19.44C5.34998 19.44 5.30002 19.51 5.27002 19.55C5.30002 19.51 5.31998 19.48 5.34998 19.44Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.87 17.53C41.87 17.53 41.82 17.46 41.79 17.42C41.82 17.46 41.84 17.49 41.87 17.53Z"
                                    fill="#231F20" />
                                <path
                                    d="M41.77 17.33C41.77 17.33 41.72 17.26 41.69 17.22C41.72 17.26 41.74 17.29 41.77 17.33Z"
                                    fill="#231F20" />
                                <path
                                    d="M31.98 29.83C32.61 30.63 32.59 31.58 32.16 32.29C31.63 33.19 30.66 33.46 29.79 33.33C29.5 33.29 29.24 33.07 28.97 32.94C28.86 32.82 28.75 32.69 28.64 32.57C26.5 30.4 24.35 28.24 22.21 26.08C21.84 25.8 21.8 25.4 21.8 24.97C21.8 20.49 21.8 16.01 21.81 11.53C21.81 10.42 22.96 9.71002 24.07 9.81002C25.01 9.89002 25.52 10.34 25.87 11.08C26.03 11.41 26.05 11.82 26.05 12.2C26.06 15.87 26.05 19.55 26.05 23.22C26.05 23.4 26.07 23.59 26.07 23.77C26.12 23.88 26.13 24.03 26.21 24.11C28.12 26.02 30.04 27.93 31.96 29.84L31.98 29.83Z"
                                    fill="#231F20" />
                            </svg>

                            <div style="margin-left: 8px">
                                <h6>FREE RETURN</h6>
                                <p>14 days money back guarantee</p>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12 mb-3">
                        <div class="d-flex border border-dark p-3 h-100">
                            <svg width="48" height="40" viewBox="0 0 48 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.06999 12.44H5.89005C6.27005 10.86 6.63007 9.31003 7.03007 7.78003C7.34007 6.59003 7.7001 5.40998 8.0601 4.22998C8.1401 3.97998 8.33002 3.76002 8.48002 3.52002C8.51002 3.47002 8.53999 3.42 8.56999 3.37C9.26999 2.71 10.05 2.15998 11 1.91998C11.36 1.82998 11.75 1.81 12.13 1.81C20.27 1.81 28.4101 1.81 36.5401 1.81C38.0001 1.81 39.23 2.37998 40.19 3.41998C40.73 3.99998 40.9601 4.81003 41.1501 5.59003C41.5201 7.06003 41.86 8.53 42.22 10C42.38 10.67 42.55 11.34 42.7 12.01C42.76 12.3 42.89 12.44 43.21 12.42C43.85 12.39 44.5 12.35 45.1 12.67C45.16 12.7 45.2101 12.73 45.2701 12.77C45.3901 13.51 45.14 13.79 44.36 13.79C43.98 13.79 43.6 13.79 43.22 13.8C43.2 13.8 43.1801 13.8 43.1501 13.81C43.1701 13.83 43.19 13.85 43.21 13.88C43.36 14.55 43.5501 15.22 43.6601 15.91C43.7301 16.36 43.8 16.77 44.2 17.06C44.25 17.09 44.24 17.22 44.25 17.3C44.27 17.36 44.2901 17.42 44.3101 17.47L44.85 18.24C44.93 18.35 45.01 18.47 45.09 18.58C45.6 19.19 46.01 19.86 46.13 20.67C46.14 20.75 46.2301 20.82 46.2801 20.89V31.93C46.0201 32.08 45.77 32.22 45.51 32.37C45.46 32.35 45.41 32.33 45.33 32.3C45.33 32.4 45.35 32.47 45.35 32.53C45.35 34.04 45.35 35.55 45.34 37.06C45.34 37.81 45.08 38.08 44.36 38.08C42.09 38.08 39.8301 38.06 37.5601 38.09C36.7701 38.09 36.58 37.75 36.6 37.11C36.63 36.27 36.6 35.43 36.6 34.59C36.6 34.44 36.6 34.3 36.6 34.15C36.71 33.78 37.0001 33.66 37.3101 33.74C37.5801 33.81 37.8001 34.03 38.0401 34.2C38.0601 34.22 37.99 34.35 37.99 34.42C37.99 35.16 37.99 35.89 37.99 36.65H43.94V32.52C44.02 32.09 43.6801 32.27 43.5301 32.27C30.7601 32.27 18 32.27 5.23002 32.27C5.14002 32.27 5.04002 32.24 4.98002 32.27C4.91002 32.32 4.86999 32.43 4.81999 32.52C4.81999 33.89 4.81999 35.25 4.81999 36.64H10.7701C10.7701 35.89 10.7701 35.14 10.7701 34.39C10.7701 33.87 10.99 33.68 11.5 33.72C11.89 33.74 12.1301 33.99 12.1401 34.45C12.1601 35.39 12.1601 36.33 12.1401 37.27C12.1301 37.79 11.8001 38.08 11.2801 38.08C8.94007 38.08 6.60006 38.08 4.27006 38.08C3.61006 38.08 3.41007 37.88 3.41007 37.23C3.41007 35.6 3.41006 33.98 3.40006 32.35C3.38006 32.33 3.35 32.3 3.33 32.28C2.65 32.24 2.48002 32.05 2.48002 31.37C2.48002 27.94 2.45005 24.5 2.51005 21.07C2.51005 20.49 2.81 19.88 3.08 19.33C3.36 18.76 3.77004 18.25 4.13004 17.72C4.15004 17.69 4.17999 17.66 4.19999 17.63C4.37999 17.35 4.55002 17.06 4.73002 16.78C4.75002 16.75 4.78009 16.72 4.80009 16.69C5.05009 15.73 5.30009 14.78 5.55009 13.83C4.98009 13.79 4.42003 13.77 3.87003 13.69C3.71003 13.67 3.49 13.46 3.46 13.3C3.42 13.11 3.55001 12.89 3.60001 12.68C3.66001 12.65 3.71006 12.62 3.77006 12.59C3.86006 12.55 3.96009 12.5 4.05009 12.46L4.06999 12.44ZM44.87 30.86C44.87 30.72 44.8901 30.61 44.8901 30.5C44.8901 27.56 44.8901 24.63 44.8901 21.69C44.8901 21.48 44.8601 21.26 44.7901 21.07C44.6201 20.59 44.44 20.12 44.23 19.66C44.02 19.21 43.75 18.78 43.51 18.34C43.5 18.32 43.47 18.29 43.45 18.28C42.9 17.85 42.61 17.26 42.44 16.61C41.88 14.4 41.3301 12.19 40.7801 9.96997C40.4201 8.49997 40.0701 7.02 39.6801 5.56C39.5101 4.92 39.14 4.35998 38.61 3.91998C37.99 3.39998 37.27 3.21997 36.48 3.21997C28.64 3.21997 20.8 3.21997 12.96 3.21997C12.51 3.21997 12.05 3.22001 11.6 3.26001C10.36 3.37001 9.4 4.31999 9.08 5.42999C8.61 7.07999 8.23999 8.77 7.81999 10.44C7.40999 12.08 7 13.73 6.58 15.37C6.42 16 6.33008 16.66 6.04008 17.23C5.61008 18.08 5.06005 18.87 4.51005 19.65C4.05005 20.31 3.87003 21.02 3.87003 21.8C3.87003 24.67 3.87003 27.53 3.87003 30.4C3.87003 30.55 3.87003 30.7 3.87003 30.82C3.94003 30.85 3.96001 30.87 3.97001 30.87C7.33001 30.87 10.7001 30.88 14.0601 30.87C14.1601 30.87 14.31 30.75 14.36 30.66C14.88 29.4 15.37 28.14 15.88 26.87C16.08 26.37 16.32 26.2 16.87 26.2C19.19 26.2 21.52 26.2 23.84 26.2C26.48 26.2 29.12 26.2 31.75 26.2C32.29 26.2 32.66 26.36 32.87 26.91C33.32 28.11 33.8401 29.28 34.2901 30.48C34.4101 30.78 34.53 30.89 34.85 30.88C38.06 30.87 41.27 30.88 44.47 30.88C44.59 30.88 44.72 30.87 44.86 30.86H44.87ZM32.95 30.86C32.55 29.88 32.1401 28.93 31.7901 27.97C31.6801 27.66 31.54 27.6 31.25 27.6C26.75 27.6 22.24 27.6 17.74 27.6C17.64 27.6 17.54 27.6 17.44 27.6C17.18 27.62 17.0001 27.68 16.9201 28C16.8401 28.37 16.63 28.71 16.49 29.07C16.26 29.65 16.0301 30.24 15.8001 30.84H32.96L32.95 30.86Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.09 18.57C45.01 18.46 44.93 18.34 44.85 18.23C45.08 18.23 45.2 18.32 45.09 18.57Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M36.61 34.14C36.61 34.29 36.61 34.43 36.61 34.58C36.33 34.43 36.34 34.28 36.61 34.14Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M44.3101 17.46C44.2901 17.4 44.27 17.34 44.25 17.29C44.32 17.31 44.39 17.34 44.45 17.36C44.4 17.39 44.3601 17.43 44.3101 17.46Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.26 12.76C45.2 12.73 45.15 12.7 45.09 12.66C45.12 12.62 45.14 12.59 45.17 12.55L45.26 12.76Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M45.37 32.52C45.37 32.45 45.36 32.39 45.35 32.29C45.43 32.32 45.48 32.34 45.53 32.36C45.48 32.41 45.43 32.47 45.37 32.52Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M8.56995 3.35999C8.53995 3.40999 8.50998 3.46001 8.47998 3.51001C8.45998 3.47001 8.43003 3.43002 8.41003 3.40002C8.46003 3.39002 8.51995 3.36999 8.56995 3.35999Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M3.78003 12.59C3.72003 12.62 3.66999 12.65 3.60999 12.68" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M4.06006 12.45C4.06006 12.45 4.04003 12.4 4.03003 12.38C4.05003 12.4 4.05996 12.42 4.07996 12.43L4.06006 12.45Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M43.21 13.88C43.21 13.88 43.17 13.84 43.15 13.81C43.17 13.81 43.19 13.81 43.22 13.8C43.22 13.83 43.22 13.85 43.22 13.88H43.21Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M4.80005 16.69C4.80005 16.69 4.74998 16.75 4.72998 16.78C4.74998 16.75 4.78005 16.72 4.80005 16.69Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M4.19995 17.63C4.19995 17.63 4.15 17.69 4.13 17.72C4.15 17.69 4.17995 17.66 4.19995 17.63Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M3.34998 32.28C3.34998 32.28 3.40004 32.33 3.42004 32.35C3.40004 32.33 3.36998 32.3 3.34998 32.28Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M24.35 16.09C29.58 16.09 34.8101 16.09 40.0401 16.09C40.6901 16.09 40.98 16.3 40.98 16.78C40.98 17.15 40.7601 17.42 40.3901 17.47C40.2401 17.49 40.0801 17.48 39.9201 17.48C29.5001 17.48 19.0801 17.48 8.66008 17.48C8.30008 17.48 8.0101 17.5 7.8101 17.11C7.5701 16.65 7.7901 16.14 8.3101 16.09C8.5201 16.07 8.73999 16.08 8.94999 16.08C14.08 16.08 19.21 16.08 24.34 16.08L24.35 16.09Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M8.39007 21.23C7.73007 21.23 7.0801 21.23 6.4201 21.2C6.2201 21.19 5.90002 21.09 5.84002 20.94C5.64002 20.42 5.76006 20.11 6.13006 19.93C6.22006 19.89 6.31008 19.83 6.40008 19.83C7.59008 19.83 8.79001 19.7 9.96001 20.11C11.27 20.57 12.29 22.02 12.34 23.38C12.37 24.47 12.03 25.38 11.34 26.17C11.03 26.52 10.6901 26.9 10.2801 27.08C9.83008 27.29 9.28008 27.34 8.78008 27.36C7.87008 27.4 6.96009 27.36 6.04009 27.36C5.60009 27.36 5.17999 27.07 5.18999 26.77C5.19999 26.29 5.51007 25.98 6.02007 25.96C6.79007 25.94 7.56001 25.96 8.33001 25.94C8.66001 25.94 9.00001 25.88 9.33001 25.82C9.40001 25.81 9.45007 25.69 9.52007 25.62C9.60007 25.54 9.68007 25.42 9.77007 25.41C10.4201 25.34 10.66 24.84 10.83 24.35C11.06 23.7 11.09 23 10.62 22.41C10.14 21.81 9.60005 21.27 8.75005 21.28C8.63005 21.26 8.52008 21.23 8.40008 21.21L8.39007 21.23Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path
                                    d="M41.27 27.48C40.4 27.36 39.53 27.26 38.67 27.11C38.45 27.07 38.2501 26.92 38.0601 26.77C36.8001 25.8 36.1499 24.42 36.4399 22.86C36.8099 20.86 38.56 19.81 40.24 19.8C40.87 19.8 41.49 19.79 42.12 19.8C42.78 19.82 43.07 20.24 42.87 20.82C42.75 21.16 42.4699 21.18 42.1999 21.19C41.6899 21.21 41.17 21.17 40.66 21.2C40.21 21.23 39.7301 21.24 39.3101 21.39C38.5201 21.66 38.0099 22.23 37.8199 23.07C37.6099 24.01 37.91 24.81 38.64 25.37C39.11 25.73 39.6899 25.96 40.3199 25.95C41.0499 25.94 41.77 25.94 42.5 25.95C42.72 25.95 43 25.97 43.13 26.1C43.32 26.28 43.54 26.63 43.48 26.81C43.4 27.04 43.0701 27.28 42.8101 27.32C42.3101 27.4 41.79 27.34 41.28 27.34C41.28 27.37 41.28 27.41 41.27 27.44V27.48Z"
                                    fill="#231F20" stroke="black" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M8.39001 21.23C8.51001 21.25 8.61999 21.28 8.73999 21.3" stroke="black"
                                    stroke-width="2" stroke-miterlimit="10" />
                            </svg>
                            <div style="margin-left: 8px">
                                <h6>FREE SHIPPING</h6>
                                <p>Free shipping on all orders</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="section_best_selling">
                </div>
            </div>
        </div>

    </div>

    <!-- Best Selling  -->
    {{-- <div id="section_best_selling"> --}}

    </div>

    <!-- New Products -->
    <div id="section_newest">

    </div>

    <!-- Banner Section 3 -->
    @php $homeBanner3Images = get_setting('home_banner3_images', null, $lang);   @endphp
    @if ($homeBanner3Images != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_3_imags = json_decode($homeBanner3Images);
                    $data_md = count($banner_3_imags) >= 2 ? 2 : 1;
                    $home_banner3_links = get_setting('home_banner3_links', null, $lang);
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_3_imags) }}" data-xxl-items="{{ count($banner_3_imags) }}"
                    data-xl-items="{{ count($banner_3_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_3_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ isset(json_decode($home_banner3_links, true)[$key]) ? json_decode($home_banner3_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Auction Product -->
    @if (addon_is_activated('auction'))
        <div id="auction_products">

        </div>
    @endif

    <!-- Cupon -->
    @if (get_setting('coupon_system') == 1)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3"
            style="background-color: {{ get_setting('cupon_background_color', '#292933') }}">
            <div class="container">
                <div class="row py-5">
                    <div class="col-xl-8 text-center text-xl-left">
                        <div class="d-lg-flex">
                            <div class="mb-3 mb-lg-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="109.602" height="93.34" viewBox="0 0 109.602 93.34">
                                    <defs>
                                        <clipPath id="clip-pathcup">
                                            <path id="Union_10" data-name="Union 10" d="M12263,13778v-15h64v-41h12v56Z"
                                                transform="translate(-11966 -8442.865)" fill="none" stroke="#fff"
                                                stroke-width="2" />
                                        </clipPath>
                                    </defs>
                                    <g id="Group_24326" data-name="Group 24326"
                                        transform="translate(-274.201 -5254.611)">
                                        <g id="Mask_Group_23" data-name="Mask Group 23"
                                            transform="translate(-3652.459 1785.452) rotate(-45)"
                                            clip-path="url(#clip-pathcup)">
                                            <g id="Group_24322" data-name="Group 24322"
                                                transform="translate(207 18.136)">
                                                <g id="Subtraction_167" data-name="Subtraction 167"
                                                    transform="translate(-12177 -8458)" fill="none">
                                                    <path
                                                        d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                        stroke="none" />
                                                    <path
                                                        d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                        stroke="none" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                        <g id="Group_24321" data-name="Group 24321"
                                            transform="translate(-3514.477 1653.317) rotate(-45)">
                                            <g id="Subtraction_167-2" data-name="Subtraction 167"
                                                transform="translate(-12177 -8458)" fill="none">
                                                <path
                                                    d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                    stroke="none" />
                                                <path
                                                    d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                    stroke="none" fill="#fff" />
                                            </g>
                                            <g id="Group_24325" data-name="Group 24325">
                                                <rect id="Rectangle_18578" data-name="Rectangle 18578" width="8"
                                                    height="2" transform="translate(120 5287)" fill="#fff" />
                                                <rect id="Rectangle_18579" data-name="Rectangle 18579" width="8"
                                                    height="2" transform="translate(132 5287)" fill="#fff" />
                                                <rect id="Rectangle_18581" data-name="Rectangle 18581" width="8"
                                                    height="2" transform="translate(144 5287)" fill="#fff" />
                                                <rect id="Rectangle_18580" data-name="Rectangle 18580" width="8"
                                                    height="2" transform="translate(108 5287)" fill="#fff" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="ml-lg-3">
                                <h5 class="fs-36 fw-400 text-white mb-3">
                                    {{ translate(get_setting('cupon_title')) }}</h5>
                                <h5 class="fs-20 fw-400 text-gray">{{ translate(get_setting('cupon_subtitle')) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 text-center text-xl-right mt-4">
                        <a href="{{ route('coupons.all') }}"
                            class="btn text-white hov-bg-white hov-text-dark border border-width-2 fs-16 px-4"
                            style="border-radius: 28px;background: rgba(255, 255, 255, 0.2);box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.16);">{{ translate('View All Coupons') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Category wise Products -->
    <div id="section_home_categories" class="mb-2 mb-md-3 mt-2 mt-md-3">

    </div>

    <!-- Classified Product -->
    @if (get_setting('classified_product') == 1)
        @php
            $classified_products = get_home_page_classified_products(6);
        @endphp
        @if (count($classified_products) > 0)
            <section class="mb-2 mb-md-3 mt-2 mt-md-3">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Classified Ads') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('customer.products') }}">{{ translate('View All Products') }}</a>
                        </div>
                    </div>
                    <!-- Banner -->
                    @php
                        $classifiedBannerImage = get_setting('classified_banner_image', null, $lang);
                        $classifiedBannerImageSmall = get_setting('classified_banner_image_small', null, $lang);
                    @endphp
                    @if ($classifiedBannerImage != null || $classifiedBannerImageSmall != null)
                        <div class="mb-3 overflow-hidden hov-scale-img d-none d-md-block">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                        <div class="mb-3 overflow-hidden hov-scale-img d-md-none">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ $classifiedBannerImageSmall != null ? uploaded_asset($classifiedBannerImageSmall) : uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                    @endif
                    <!-- Products Section -->
                    <div class="bg-white">
                        <div class="row no-gutters border-top border-left">
                            @foreach ($classified_products as $key => $classified_product)
                                <div
                                    class="col-xl-4 col-md-6 border-right border-bottom has-transition hov-shadow-out z-1">
                                    <div class="aiz-card-box p-2 has-transition bg-white">
                                        <div class="row hov-scale-img">
                                            <div class="col-4 col-md-5 mb-3 mb-md-0">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                    class="d-block overflow-hidden h-auto h-md-150px text-center">
                                                    <img class="img-fluid lazyload mx-auto has-transition"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ isset($classified_product->thumbnail->file_name) ? my_asset($classified_product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <h3
                                                    class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-3 h-35px d-none d-sm-block">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                        class="d-block text-reset hov-text-primary">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                                <div class="fs-14 mb-3">
                                                    <span
                                                        class="text-secondary">{{ $classified_product->user ? $classified_product->user->name : '' }}</span><br>
                                                    <span
                                                        class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                @if ($classified_product->conditon == 'new')
                                                    <span
                                                        class="badge badge-inline badge-soft-info fs-13 fw-700 p-3 text-info"
                                                        style="border-radius: 20px;">{{ translate('New') }}</span>
                                                @elseif($classified_product->conditon == 'used')
                                                    <span
                                                        class="badge badge-inline badge-soft-danger fs-13 fw-700 p-3 text-danger"
                                                        style="border-radius: 20px;">{{ translate('Used') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- Top Sellers -->
    @if (get_setting('vendor_system_activation') == 1)
        @php
            $best_selers = get_best_sellers(10);
        @endphp
        @if (count($best_selers) > 0)
            <section class="mb-2 mb-md-3 mt-2 mt-md-3">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="pb-3">{{ translate('Top Sellers') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('sellers') }}">{{ translate('View All Sellers') }}</a>
                        </div>
                    </div>
                    <!-- Sellers Section -->
                    <div class="aiz-carousel arrow-x-0 arrow-inactive-none" data-items="5" data-xxl-items="5"
                        data-xl-items="4" data-lg-items="3.4" data-md-items="2.5" data-sm-items="2"
                        data-xs-items="1.4" data-arrows="true" data-dots="false">
                        @foreach ($best_selers as $key => $seller)
                            @if ($seller->user != null)
                                <div
                                    class="carousel-box h-100 position-relative text-center border-right border-top border-bottom @if ($key == 0) border-left @endif has-transition hov-animate-outline">
                                    <div class="position-relative px-3" style="padding-top: 2rem; padding-bottom:2rem;">
                                        <!-- Shop logo & Verification Status -->
                                        <div class="position-relative mx-auto size-100px size-md-120px">
                                            <a href="{{ route('shop.visit', $seller->slug) }}"
                                                class="d-flex mx-auto justify-content-center align-item-center size-100px size-md-120px border overflow-hidden hov-scale-img"
                                                tabindex="0"
                                                style="border: 1px solid #e5e5e5; border-radius: 50%; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.06);">
                                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                                    data-src="{{ uploaded_asset($seller->logo) }}"
                                                    alt="{{ $seller->name }}" class="img-fit lazyload has-transition"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                            </a>
                                            <div class="absolute-top-right z-1 mr-md-2 mt-1 rounded-content bg-white">
                                                @if ($seller->verification_status == 1)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.001"
                                                        height="24" viewBox="0 0 24.001 24">
                                                        <g id="Group_25929" data-name="Group 25929"
                                                            transform="translate(-480 -345)">
                                                            <circle id="Ellipse_637" data-name="Ellipse 637"
                                                                cx="12" cy="12" r="12"
                                                                transform="translate(480 345)" fill="#fff" />
                                                            <g id="Group_25927" data-name="Group 25927"
                                                                transform="translate(480 345)">
                                                                <path id="Union_5" data-name="Union 5"
                                                                    d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"
                                                                    transform="translate(0 0)" fill="#3490f3" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24.001"
                                                        height="24" viewBox="0 0 24.001 24">
                                                        <g id="Group_25929" data-name="Group 25929"
                                                            transform="translate(-480 -345)">
                                                            <circle id="Ellipse_637" data-name="Ellipse 637"
                                                                cx="12" cy="12" r="12"
                                                                transform="translate(480 345)" fill="#fff" />
                                                            <g id="Group_25927" data-name="Group 25927"
                                                                transform="translate(480 345)">
                                                                <path id="Union_5" data-name="Union 5"
                                                                    d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"
                                                                    transform="translate(0 0)" fill="red" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Shop name -->
                                        <h2
                                            class="fs-14 fw-700 text-dark text-truncate-2 h-40px mt-3 mt-md-4 mb-0 mb-md-3">
                                            <a href="{{ route('shop.visit', $seller->slug) }}"
                                                class="text-reset hov-text-primary"
                                                tabindex="0">{{ $seller->name }}</a>
                                        </h2>
                                        <!-- Shop Rating -->
                                        <div class="rating rating-mr-1 text-dark mb-3">
                                            {{ renderStarRating($seller->rating) }}
                                            <span class="opacity-60 fs-14">({{ $seller->num_of_reviews }}
                                                {{ translate('Reviews') }})</span>
                                        </div>
                                        <!-- Visit Button -->
                                        <a href="{{ route('shop.visit', $seller->slug) }}" class="btn-visit">
                                            <span class="circle" aria-hidden="true">
                                                <span class="icon arrow"></span>
                                            </span>
                                            <span class="button-text">{{ translate('Visit Store') }}</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- Top Brands -->
    @if (get_setting('top_brands') != null)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">{{ translate('Top Brands') }}</h3>
                    <!-- Links -->
                    <div class="d-flex">
                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                            href="{{ route('brands.all') }}">{{ translate('View All Brands') }}</a>
                    </div>
                </div>
                <!-- Brands Section -->
                <div class="bg-white px-3">
                    <div
                        class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">
                        @php
                            $top_brands = json_decode(get_setting('top_brands'));
                            $brands = get_brands($top_brands);
                        @endphp
                        @foreach ($brands as $brand)
                            <div
                                class="col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">
                                <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-sm-3">
                                    <img src="{{ isset($brand->brandLogo->file_name) ? my_asset($brand->brandLogo->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="lazyload h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"
                                        alt="{{ $brand->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    <p class="text-center text-dark fs-12 fs-md-14 fw-700 mt-2">
                                        {{ $brand->getTranslation('name') }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
