<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            @if (!Auth::guest())
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('dashboard.index') }}" class="btn btn-link"><i class="fa fa-tachometer" aria-hidden="true"></i> {{ trans('miscellaneous.dashboard') }}</a></li>
                    @can ('list-ticket')
                        <li><a href="{{ route('ticket.index') }}" class="btn btn-link"><i class="fa fa-life-ring" aria-hidden="true"></i> {{ trans_choice('miscellaneous.ticket', 2) }}</a></li>
                    @endcan
                    @can ('create-ticket')
                        <li class="active"><a href="{{ route('ticket.report') }}" class="btn btn-link"><i class="fa fa-flag" aria-hidden="true"></i> {{ trans('miscellaneous.report') }}</a></li>
                    @endcan
                    @can ('see-auxiliares')
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-link" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-bars" aria-hidden="true"></i> {{ trans_choice('miscellaneous.auxiliary', 2) }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('category.index') }}">{{ trans_choice('miscellaneous.category', 2) }}</a></li>
                                <li><a href="{{ route('priority.index') }}">{{ trans_choice('miscellaneous.priority', 2) }}</a></li>
                                <li class="disabled"><a href="#">{{ trans_choice('miscellaneous.department', 2) }}</a></li>
                            </ul>
                        </li>
                    @endcan
                </ul>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">{{ trans('miscellaneous.sign_in') }}</a></li>
                    <li><a href="{{ route('register') }}">{{ trans('miscellaneous.register') }}</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @can ('edit-profile')
                                <li><a href="{{ route('user.profile') }}"><i class="fa fa-gears" aria-hidden="true"></i> {{ trans('miscellaneous.edit_profile') }}</a></li>
                            @endcan
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" class="logout"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> {{ trans('miscellaneous.sign_out') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
