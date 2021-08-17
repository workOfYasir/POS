<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">

        </div>
    </div>
    <div class="kt-header__topbar">

        @anypermission('pos')
                <div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="@translate(POS)">
                    <span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
                        <a href="{{route('poses.create')}}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                                    <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                        </a>
                    </span>
                </div>
        @endanypermission

        <!--end: Quick panel toggler -->

        <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                            <span class="kt-header__topbar-icon">
                                                <img class=""
                                                     src="{{ asset("uploads/lang/".\App\Model\Language::where('code', Session::get('locale'))->first()->image) }}"
                                                     alt="image"/>
                                            </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    @foreach(\App\Model\Language::all() as $language)
                        <li class="kt-nav__item @if(\Illuminate\Support\Facades\Session::get('locale') == $language->code) kt-nav__item--active @endif">
                            <a href="{{route('language.change')}}" class="kt-nav__link" onclick="event.preventDefault();
                                document.getElementById('{{$language->name}}').submit();
                                ">
                                                        <span class="kt-nav__link-icon"><img
                                                                src="{{ asset("uploads/lang/". $language->image) }}"
                                                                alt="{{$language->name}}"/></span>
                                <span class="kt-nav__link-text">{{$language->name}}</span>
                            </a>
                            <form id="{{$language->name}}" class="d-none" action="{{ route('language.change') }}" method="POST">
                                @csrf
                                <input type="hidden" name="code" value="{{$language->code}}">
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--end: Language bar -->

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">@translate(Hi),</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    <img class="" alt="Pic" src="{{\App\User::find(\Illuminate\Support\Facades\Auth::id())->image != null ?
                  asset('uploads/users/'.\App\User::find(\Illuminate\Support\Facades\Auth::id())->image) :
                   asset('uploads/user.jpg')}}">
                </div>
            </div>

            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden-" alt="Pic"
                             src="{{\App\User::find(\Illuminate\Support\Facades\Auth::id())->image != null ?
                  asset('uploads/users/'.\App\User::find(\Illuminate\Support\Facades\Auth::id())->image) :
                   asset('uploads/user.jpg')}}"/>
                        <span
                            class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                    </div>
                    <div class="kt-user-card__name">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </div>
                </div>

                <div class="kt-notification">
                    <a href="{{url('user/edit/'.\Illuminate\Support\Facades\Auth::user()->id)}}"
                       class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                @translate(My Profile)
                            </div>
                            <div class="kt-notification__item-time">
                                @translate(Account settings and more)
                            </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between float-left">
                        <a class="btn btn-primary" href="{{ route('logout') }}">
                            @translate(Sign Out)
                        </a>
                    </div>
                    <div class="kt-notification__custom kt-space-between float-right">
                        <a class="btn btn-success"
                           href="{{ route('passwords.change', \Illuminate\Support\Facades\Auth::id()) }}">@translate(Change
                            Password)</a>
                    </div>
                </div>
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>
