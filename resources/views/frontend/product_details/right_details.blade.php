<div class="text-left ">
    <!-- For auction product -->
    @if ($detailedProduct->auction_product)
        <div class="row no-gutters mb-3">
            <div class="col-sm-2">
                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Auction Will End') }}</div>
            </div>
            <div class="col-sm-10">
                @if ($detailedProduct->auction_end_date > strtotime('now'))
                    <div class="aiz-count-down align-items-center"
                        data-date="{{ date('Y/m/d H:i:s', $detailedProduct->auction_end_date) }}"></div>
                @else
                    <p>{{ translate('Ended') }}</p>
                @endif

            </div>
        </div>

        <div class="row no-gutters mb-3">
            <div class="col-sm-2">
                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Starting Bid') }}</div>
            </div>
            <div class="col-sm-10">
                <span class="opacity-50 fs-20">
                    {{ single_price($detailedProduct->starting_bid) }}
                </span>
                @if ($detailedProduct->unit != null)
                    <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                @endif
            </div>
        </div>

        @if (Auth::check() &&
                Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first() != null)
            <div class="row no-gutters mb-3">
                <div class="col-sm-2">
                    <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('My Bidded Amount') }}</div>
                </div>
                <div class="col-sm-10">
                    <span class="opacity-50 fs-20">
                        {{ single_price(Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first()->amount) }}
                    </span>
                </div>
            </div>
            <hr>
        @endif

        @php $highest_bid = $detailedProduct->bids->max('amount'); @endphp
        <div class="row no-gutters my-2 mb-3">
            <div class="col-sm-2">
                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Highest Bid') }}</div>
            </div>
            <div class="col-sm-10">
                <strong class="h3 fw-600 text-primary">
                    @if ($highest_bid != null)
                        {{ single_price($highest_bid) }}
                    @endif
                </strong>
            </div>
        </div>
    @else
        <!-- Without auction product -->
        @if ($detailedProduct->wholesale_product == 1)
            <!-- Wholesale -->
            <table class="table mb-3">
                <thead>
                    <tr>
                        <th class="border-top-0">{{ translate('Min Qty') }}</th>
                        <th class="border-top-0">{{ translate('Max Qty') }}</th>
                        <th class="border-top-0">{{ translate('Unit Price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detailedProduct->stocks->first()->wholesalePrices as $wholesalePrice)
                        <tr>
                            <td>{{ $wholesalePrice->min_qty }}</td>
                            <td>{{ $wholesalePrice->max_qty }}</td>
                            <td>{{ single_price($wholesalePrice->price) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <!-- Without Wholesale -->
            @if (home_price($detailedProduct) != home_discounted_price($detailedProduct))
                <div class="row no-gutters mb-3">
                    {{-- <div class="col-sm-2">
                      <div class="text-secondary fs-14 fw-400">{{ translate('Item Price') }}</div>
                  </div> --}}
                    <div class="col-sm-10">
                        <div class="d-flex align-items-center">
                            <!-- Discount Price -->
                            <strong class="fs-16 fw-700 ">
                                {{ home_discounted_price($detailedProduct) }}
                            </strong>
                            <!-- Home Price -->
                            <del class="fs-14 opacity-60 ml-2">
                                {{-- {{ home_price($detailedProduct) }} --}}
                            </del>
                            <!-- Unit -->
                            @if ($detailedProduct->unit != null)
                                {{-- <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span> --}}
                            @endif
                            <!-- Discount percentage -->
                            @if (discount_in_percentage($detailedProduct) > 0)
                                {{-- <span class="bg-primary ml-2 fs-11 fw-700 text-white w-35px text-center p-1"
                                  style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($detailedProduct) }}%</span> --}}
                            @endif
                            <!-- Club Point -->
                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                <div class="ml-2 bg-secondary-base d-flex justify-content-center align-items-center px-3 py-1"
                                    style="width: fit-content;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 12 12">
                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6" cy="6"
                                                r="6" transform="translate(973 633)" fill="#fff" />
                                            <g id="Group_23920" data-name="Group 23920" transform="translate(973 633)">
                                                <path id="Path_28698" data-name="Path 28698"
                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" />
                                                <path id="Path_28699" data-name="Path 28699"
                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" opacity="0.5" />
                                                <path id="Path_28700" data-name="Path 28700"
                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                    fill="#f3af3d" />
                                            </g>
                                        </g>
                                    </svg>
                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:
                                        {{ $detailedProduct->earn_point }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row no-gutters mb-3">
                    <div class="col-sm-2">
                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>
                    </div>
                    <div class="col-sm-10">
                        <div class="d-flex align-items-center">
                            <!-- Discount Price -->
                            <strong class="fs-16 fw-700 text-primary">
                                {{ home_discounted_price($detailedProduct) }}
                            </strong>
                            <!-- Unit -->
                            @if ($detailedProduct->unit != null)
                                <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>
                            @endif
                            <!-- Club Point -->
                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)
                                <div class="ml-2 bg-secondary-base d-flex justify-content-center align-items-center px-3 py-1"
                                    style="width: fit-content;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 12 12">
                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6" cy="6"
                                                r="6" transform="translate(973 633)" fill="#fff" />
                                            <g id="Group_23920" data-name="Group 23920" transform="translate(973 633)">
                                                <path id="Path_28698" data-name="Path 28698"
                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" />
                                                <path id="Path_28699" data-name="Path 28699"
                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"
                                                    fill="#f3af3d" opacity="0.5" />
                                                <path id="Path_28700" data-name="Path 28700"
                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"
                                                    fill="#f3af3d" />
                                            </g>
                                        </g>
                                    </svg>
                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:
                                        {{ $detailedProduct->earn_point }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endif

    @if ($detailedProduct->auction_product != 1)
        <form id="option-choice-form">
            @csrf
            <input type="hidden" name="id" value="{{ $detailedProduct->id }}">

            @if ($detailedProduct->digital == 0)
                <!-- Choice Options -->
                @if ($detailedProduct->choice_options != null)
                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)
                        <div class="row no-gutters mb-3">
                            <div class="col-sm-2">
                                <div class="text-secondary fs-14 fw-400 mt-2 ">
                                    {{ get_single_attribute_name($choice->attribute_id) }}
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="aiz-radio-inline">
                                    @foreach ($choice->values as $key => $value)
                                        <label class="aiz-megabox pl-0 mr-2 mb-0">
                                            <input type="radio" name="attribute_id_{{ $choice->attribute_id }}"
                                                value="{{ $value }}"
                                                @if ($key == 0) checked @endif>
                                            <span
                                                class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center py-1 px-3">
                                                {{ $value }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- Color Options -->
                {{-- @if ($detailedProduct->colors != null && count(json_decode($detailedProduct->colors)) > 0)
                  <div class="row no-gutters mb-3">
                      <div class="col-sm-2">
                          <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Color') }}</div>
                      </div>
                      <div class="col-sm-10">
                          <div class="aiz-radio-inline">
                              @foreach (json_decode($detailedProduct->colors) as $key => $color)
                                  <label class="aiz-megabox pl-0 mr-2 mb-0" data-toggle="tooltip"
                                      data-title="{{ get_single_color_name($color) }}">
                                      <input type="radio" name="color"
                                          value="{{ get_single_color_name($color) }}"
                                          @if ($key == 0) checked @endif>
                                      <span
                                          class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center p-1">
                                          <span class="size-25px d-inline-block rounded"
                                              style="background: {{ $color }};"></span>
                                      </span>
                                  </label>
                              @endforeach
                          </div>
                      </div>
                  </div>
              @endif --}}


                <!-- Quantity + Add to cart -->
                <div class="row no-gutters mb-3">
                    <div class="col-sm-2">
                        <div class=" fs-14 fw-400 mt-2 ">{{ translate('Quantity') }}</div>
                    </div>
                    <div class="col-sm-10">
                        <div class="product-quantity d-flex align-items-center">
                            <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                <button class="btn col-auto btn-icon btn-sm btn-light rounded-0 ml-2" type="button"
                                    data-type="minus" data-field="quantity" disabled="">
                                    <i class="las la-minus"></i>
                                </button>
                                <input type="number" name="quantity"
                                    class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1"
                                    value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}"
                                    max="10" lang="en">
                                <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button"
                                    data-type="plus" data-field="quantity">
                                    <i class="las la-plus"></i>
                                </button>
                            </div>
                            @php
                                $qty = 0;
                                foreach ($detailedProduct->stocks as $key => $stock) {
                                    $qty += $stock->qty;
                                }
                            @endphp
                            <div class="avialable-amount opacity-60">
                                @if ($detailedProduct->stock_visibility_state == 'quantity')
                                    (<span id="available-quantity">{{ $qty }}</span>
                                    {{ translate('available') }})
                                @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)
                                    (<span id="available-quantity">{{ translate('In Stock') }}</span>)
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Quantity -->
                <input type="hidden" name="quantity" value="1">
            @endif

            <!-- Total Price -->
            <div class="row no-gutters pb-3 d-none" id="chosen_price_div">
                <div class="col-sm-3">
                    <div class=" fs-14 fw-400 mt-1">{{ translate('Total Price') }}</div>
                </div>
                <div class="col-sm-9">
                    <div class="product-price">
                        <strong id="chosen_price" class="fs-20 fw-700 text-primary">

                        </strong>
                    </div>
                </div>
            </div>

        </form>
    @endif

    @if ($detailedProduct->auction_product)
        @php
            $highest_bid = $detailedProduct->bids->max('amount');
            $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $detailedProduct->starting_bid;
        @endphp
        @if ($detailedProduct->auction_end_date >= strtotime('now'))
            <div class="mt-4">
                @if (Auth::check() && $detailedProduct->user_id == Auth::user()->id)
                    <span
                        class="badge badge-inline badge-danger">{{ translate('Seller cannot Place Bid to His Own Product') }}</span>
                @else
                    <button type="button" class="btn btn-primary buy-now  fw-600 min-w-150px rounded-0"
                        onclick="bid_modal()">
                        <i class="las la-gavel"></i>
                        @if (Auth::check() &&
                                Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first() != null)
                            {{ translate('Change Bid') }}
                        @else
                            {{ translate('Place Bid') }}
                        @endif
                    </button>
                @endif
            </div>
        @endif
    @else
        <!-- Add to cart & Buy now Buttons -->
        <div class="mt-3 ">
            <div class="d-flex flex-column align-items-center justify-content-center ">
                <div>
                    @if ($detailedProduct->digital == 0)
                        @if ($detailedProduct->external_link != null)
                            <a type="button" class="btn btn-primary buy-now fw-600 add-to-cart px-4 rounded-0"
                                href="{{ $detailedProduct->external_link }}">
                                <i class="la la-share"></i> {{ translate($detailedProduct->external_link_btn) }}
                            </a>
                        @else
                            <button type="button"
                                class="btn mb-2 btn-secondary-base mr-2 add-to-cart fw-600 min-w-150px d-block rounded-2 text-white"
                                @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCart()" @else onclick="showLoginModal()" @endif>
                                <i class="las la-shopping-bag"></i> {{ translate('Add to cart') }}
                            </button>
                            <button type="button"
                                class="btn btn-primary buy-now fw-600 add-to-cart mb-2 d-block min-w-150px rounded-2"
                                @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCart()" @else onclick="showLoginModal()" @endif>
                                <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                            </button>
                        @endif
                        <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>
                            <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}
                        </button>
                    @elseif ($detailedProduct->digital == 1)
                        <button type="button"
                            class="btn btn-secondary-base mr-2 add-to-cart fw-600 min-w-150px rounded-0 text-white"
                            @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCart()" @else onclick="showLoginModal()" @endif>
                            <i class="las la-shopping-bag"></i> {{ translate('Add to cart') }}
                        </button>
                        <button type="button"
                            class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0"
                            @if (Auth::check() || get_Setting('guest_checkout_activation') == 1) onclick="addToCart()" @else onclick="showLoginModal()" @endif>
                            <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}
                        </button>
                    @endif
                </div>
                <!-- Messase to seller -->
                @if (get_setting('conversation_system') == 1)
                    <div class="">
                        <button class="btn btn-sm  btn-outline-secondary-base hov-svg-white hov-text-white rounded-4"
                            onclick="show_chat_modal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 16 16" class="mr-2 has-transition">
                                <g id="Group_23918" data-name="Group 23918" transform="translate(1053.151 256.688)">
                                    <path id="Path_3012" data-name="Path 3012"
                                        d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z"
                                        transform="translate(-1178 -341)"
                                        fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                    <path id="Path_3013" data-name="Path 3013"
                                        d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1"
                                        transform="translate(-1182 -337)"
                                        fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                    <path id="Path_3014" data-name="Path 3014"
                                        d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                        transform="translate(-1181 -343.5)"
                                        fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                    <path id="Path_3015" data-name="Path 3015"
                                        d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1"
                                        transform="translate(-1181 -346.5)"
                                        fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                </g>
                            </svg>

                            {{ translate('Chat With Seller') }}
                        </button>
                    </div>
                @endif

            </div>

        </div>
        <!-- Seller Info -->
        {{-- <div class="d-flex flex-wrap align-items-center"> --}}
        {{-- <div class="d-flex align-items-center mr-4">
          <!-- Shop Name -->
          @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
              <span class="text-secondary fs-14 fw-400 mr-4 w-80px">{{ translate('Sold by') }}</span>
              <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                  class="text-reset hov-text-primary fs-14 fw-700">{{ $detailedProduct->user->shop->name }}</a>
          @else
              <p class="mb-0 fs-14 fw-700">{{ translate('Inhouse product') }}</p>
          @endif
      </div> --}}
        <!-- Messase to seller -->
        {{-- @if (get_setting('conversation_system') == 1)
          <div class="">
              <button class="btn btn-sm btn-soft-secondary-base btn-outline-secondary-base hov-svg-white hov-text-white rounded-4"
                  onclick="show_chat_modal()">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                      class="mr-2 has-transition">
                      <g id="Group_23918" data-name="Group 23918" transform="translate(1053.151 256.688)">
                          <path id="Path_3012" data-name="Path 3012"
                              d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z"
                              transform="translate(-1178 -341)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                          <path id="Path_3013" data-name="Path 3013"
                              d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1"
                              transform="translate(-1182 -337)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                          <path id="Path_3014" data-name="Path 3014"
                              d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                              transform="translate(-1181 -343.5)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                          <path id="Path_3015" data-name="Path 3015"
                              d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1"
                              transform="translate(-1181 -346.5)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                      </g>
                  </svg>

                  {{ translate('Message Seller') }}
              </button>
          </div>
      @endif --}}
        <!-- Size guide -->
        {{-- @php
          $sizeChartId = ($detailedProduct->main_category && $detailedProduct->main_category->sizeChart) ? $detailedProduct->main_category->sizeChart->id : 0;
          $sizeChartName = ($detailedProduct->main_category && $detailedProduct->main_category->sizeChart) ? $detailedProduct->main_category->sizeChart->name : null;
      @endphp
      @if ($sizeChartId != 0)
          <div class=" ml-4">
              <a href="javascript:void(1);" onclick='showSizeChartDetail({{ $sizeChartId }}, "{{ $sizeChartName }}")' class="animate-underline-primary">{{ translate('Show size guide') }}</a>
          </div>
      @endif --}}
        {{-- </div> --}}



        <!-- Promote Link -->
        {{-- <div class="d-table width-100 mt-3">
          <div class="d-table-cell">
              @if (Auth::check() && addon_is_activated('affiliate_system') && get_affliate_option_status() && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                  @php
                      if (Auth::check()) {
                          if (Auth::user()->referral_code == null) {
                              Auth::user()->referral_code = substr(Auth::user()->id . Str::random(10), 0, 10);
                              Auth::user()->save();
                          }
                          $referral_code = Auth::user()->referral_code;
                          $referral_code_url = URL::to('/product') . '/' . $detailedProduct->slug . "?product_referral_code=$referral_code";
                      }
                  @endphp
                  <div>
                      <button type="button" id="ref-cpurl-btn" class="btn btn-secondary w-200px rounded-0"
                          data-attrcpy="{{ translate('Copied') }}" onclick="CopyToClipboard(this)"
                          data-url="{{ $referral_code_url }}">{{ translate('Copy the Promote Link') }}</button>
                  </div>
              @endif
          </div>
      </div> --}}

      {{-- Addresses --}}
        <div class="ml-2 mt-4">
            <div class="info-section">
                <h2>
                    Delivery Address
                </h2>
                <p>
                    Flat# 1023, Building#25-c, Dubai, UAE
                </p>
            </div>

            <div class="info-section">
                <h2>
                    Sold By
                </h2>
                <p>
                    Shopeedo.com
                </p>
            </div>

            <div class="info-section">
                <h2>
                    Shipped By
                </h2>
                <p>
                    Shopeedo.com
                </p>
            </div>
            <!-- Refund -->
            @php
                $refund_sticker = get_setting('refund_sticker');
            @endphp
            @if (addon_is_activated('refund_request'))
                <div class="row no-gutters mt-3">
                    <div class="col-12">
                        <div class=" fs-14 fw-400 mt-2">{{ translate('Refund') }}</div>
                    </div>
                    <div class="col-12">
                        @if ($detailedProduct->refundable == 1)
                            <a href="{{ route('returnpolicy') }}" target="_blank" style="ml-1">
                                @if ($refund_sticker != null)
                                    <img src="{{ uploaded_asset($refund_sticker) }}" height="36">
                                @else
                                    <img src="{{ static_asset('assets/img/refund-sticker_new.png') }}" height="36">
                                @endif
                            </a>
                            {{-- <a href="{{ route('returnpolicy') }}" class="text-blue hov-text-primary fs-14 ml-3"
                      target="_blank">{{ translate('View Policy') }}</a> --}}
                        @else
                            <div class="text-dark fs-14 fw-400 mt-2">{{ translate('Not Applicable') }}</div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="info-section mt-2">
                <h2>
                    Free Delivery
                </h2>
                <p>
                    For Premium Customers
                </p>
            </div>
        </div>


        <!-- Seller Guarantees -->
        @if ($detailedProduct->digital == 1)
            @if ($detailedProduct->added_by == 'seller')
                <div class="row no-gutters mt-3">
                    <div class="col-2">
                        <div class="text-secondary fs-14 fw-400">{{ translate('Seller Guarantees') }}</div>
                    </div>
                    <div class="col-10">
                        @if ($detailedProduct->user->shop->verification_status == 1)
                            <span class="text-success fs-14 fw-700">{{ translate('Verified seller') }}</span>
                        @else
                            <span class="text-danger fs-14 fw-700">{{ translate('Non verified seller') }}</span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    @endif

    <!-- Share -->
    {{-- <div class="row no-gutters mt-4">
      <div class="col-sm-2">
          <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Share') }}</div>
      </div>
      <div class="col-sm-10">
          <div class="aiz-share"></div>
      </div>
  </div> --}}
    @include('modals.size_chart_show_modal')
</div>
<script>
    function show_chat_modal() {
        @if (Auth::check())
            $('#chat_modal').modal('show');
        @else
            $('#login_modal').modal('show');
        @endif
    }
</script>
