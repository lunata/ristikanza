    <li class="nav-item dropdown"> {{-- ИНФОРМАЦИЯ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.info') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a  class="dropdown-item" href="{{ route('users.adverts') }}">{{ __('navigation.famil_info') }}</a>
            <a  class="dropdown-item" href="{{ route('adverts.index') }}">{{ __('navigation.all_adverts') }}</a>
        </div>
    </li>

    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.profile') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a  class="dropdown-item" href="{{ route('home.anketa') }}">{{ trans('navigation.anketa') }}</a>
            <a  class="dropdown-item" href="{{ route('home.passw')}}">{{ trans('navigation.passw') }}</a>
        </div>
    </li>
    
    <li class="nav-item dropdown"> {{-- ПОЛЬЗОВАТЕЛИ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.users') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a  class="dropdown-item" href="{{ route('students.list', 'matriculants') }}">{{ __('navigation.matriculants') }}</a>
            <a  class="dropdown-item" href="{{ route('students.list', 'postgraduates') }}">{{ __('navigation.postgraduates') }}</a>
            <a  class="dropdown-item" href="{{ route('students.list', 'applicants') }}">{{ __('navigation.applicants') }}</a> 
        </div>
    </li>
    
    <li class="nav-item dropdown">                                              {{-- АСПИРАНТУРА --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.graduate') }}
        </a>

        <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
            <li><a  class="dropdown-item" href="{{ route('home.lecturers.schedule') }}">{{ __('navigation.schedule') }}</a></li>
@foreach (['programs', 'performance', 'attendance', 'debts'] as $v)
            <li><a  class="dropdown-item disabled" href="">{{ __('navigation.'.$v) }}</a></li>
@endforeach                    
        </ul>
    </li>
    
    <li class="nav-item dropdown"> {{-- ДОКУМЕНТЫ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.documents') }}
        </a>

        <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">    
@foreach (['orders', 'certification', 'logs', 'files'] as $v)
            <li><a  class="dropdown-item disabled" href="">{{ __('navigation.'.$v) }}</a></li>
@endforeach                    
        </ul>
    </li>
    </li>
</ul>
