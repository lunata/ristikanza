<nav class="navbar navbar-expand-lg navbar-dark">
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
                    <a  class="dropdown-item" href="{{ LaravelLocalization::localizeURL('/pages/about') }}">{{ __('navigation.about') }}</a>
                    <a  class="dropdown-item" href="{{ LaravelLocalization::localizeURL('/pages/publications') }}">{{ __('navigation.publications') }}</a>
                </div>
            </li>

            <li class="nav-item dropdown"> {{-- ОЙКОНИМЫ --}}
                <a href="#" class="nav-link" id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.oikonyms') }}
                </a>
            </li>

            <li class="nav-item dropdown"> {{-- ТЕКСТЫ --}}
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.texts') }}
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            @foreach (['ethnography', 'folklore', 'bible', 'monuments'] as $title)
                    <a  class="dropdown-item" href="#">{{ __('navigation.'.$title) }}</a>
            @endforeach
                </div>
            </li>

            <li class="nav-item dropdown"> {{-- КАРТА --}}
                <a href="#" class="nav-link" id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.map') }}
                </a>
            </li>

            <li class="nav-item dropdown"> {{-- УЧЕБНИКИ --}}
                <a href="#" class="nav-link" id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.textbooks') }}
                </a>
            </li>

            <li class="nav-item dropdown"> {{-- БИБЛИОТЕКА --}}
                <a href="#" class="nav-link" id="navbarDropdown1" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ __('navigation.library') }}
                </a>
            </li>

        </ul>
        </ul>
    </div>

    <!-- Right Side Of Navbar -->
    <div class="navbar-right">
        @include('header.lang_switch', ['with_text'=>true])
    </div>
</nav>


