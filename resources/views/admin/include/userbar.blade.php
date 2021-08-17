<div class="kt-header__topbar-item kt-header__topbar-item--user">
    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
        <span class="kt-header__topbar-welcome kt-visible-desktop"> @translate(Hi),</span>
        <span
            class="kt-header__topbar-username kt-visible-desktop">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
        <img alt="Pic"
             src="{{\App\User::find(\Illuminate\Support\Facades\Auth::id())->image != null ?
                  asset('/uploads/users/'.\App\User::find(\Illuminate\Support\Facades\Auth::id())->image) :
                   asset('/uploads/user.jpg')}}"/>
        <span class="kt-header__topbar-icon kt-bg-brand kt-hidden"><b>S</b></span>
    </div>
    <div
        class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
        <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
            <div class="kt-user-card__avatar">
                <img class="kt-hidden-" alt="Pic"
                     src="{{\App\User::find(\Illuminate\Support\Facades\Auth::id())->image != null ?
                  asset('/uploads/users/'.\App\User::find(\Illuminate\Support\Facades\Auth::id())->image) :
                   asset('/uploads/user.jpg')}}"/>
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
                <a class="btn btn-primary" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    @translate(Sign Out)
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
            <div class="kt-notification__custom kt-space-between float-right">
                <a class="btn btn-success"
                   href="{{ route('passwords.change', \Illuminate\Support\Facades\Auth::id()) }}">@translate(Change
                    Password)</a>
            </div>
        </div>
    </div>
</div>
