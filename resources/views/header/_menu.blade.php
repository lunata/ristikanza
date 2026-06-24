@auth
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <!-- Collapsed Hamburger -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown"> {{-- О ПРОЕКТЕ --}}
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.about') }}
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                    <a  class="dropdown-item" href="{{ route('pages.about') }}">{{ __('navigation.about') }}</a>
                    <a  class="dropdown-item" href="{{ route('pages.publications') }}">{{ __('navigation.publications') }}</a>
                </div>
            </li>

            <li class="nav-item dropdown"> {{-- ОЙКОНИМЫ --}}
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.users') }}
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <a  class="dropdown-item" href="{{ route('oikonims.index') }}">{{ __('navigation.oikonims') }}</a>
                </div>
            </li>

            <li class="nav-item dropdown"> {{-- ТЕКСТЫ --}}
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.texts') }}
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <a  class="dropdown-item" href="{{ route('texts.ethnography') }}">{{ __('navigation.ethnography') }}</a>
                    <a  class="dropdown-item" href="{{ route('texts.folklore') }}">{{ __('navigation.folklore') }}</a>
                </div>
            </li>

        </ul>
        </ul>
    </div>

    <!-- Right Side Of Navbar -->
    <div class="navbar-right btn-danger">
        <form action="{{ route('logout') }}" method="POST" class="form-inline">
        @csrf
        <input type="submit" class="btn btn-danger" value="{{ __('auth.logout') }}">
        </form>
    </div>
</nav>
@endauth


