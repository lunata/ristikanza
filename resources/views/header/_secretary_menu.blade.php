    <li class="nav-item">
        <a href="{{ route('users.adverts')}}" class="nav-link">
           {{ __('navigation.info') }}
        </a>
    </li>

    <li class="nav-item dropdown"> {{-- ПОЛЬЗОВАТЕЛИ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.users') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a  class="dropdown-item" href="{{ route('students.list', 'matriculants') }}">{{ __('navigation.matriculants') }}</a>
            <a  class="dropdown-item" href="{{ route('students.list', 'postgraduates') }}">{{ __('navigation.postgraduates') }}</a>
            <a  class="dropdown-item" href="{{ route('students.list', 'applicants') }}">{{ __('navigation.applicants') }}</a> 
            <a  class="dropdown-item" href="{{ route('employees.index') }}">{{ __('navigation.employees') }}</a>
        </div>
    </li>
    
    <li class="nav-item dropdown"> {{-- ПРИЁМ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.acceptance') }}
        </a>

        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <li><a  class="dropdown-item" href="{{ route('home.secretary.score_info') }}">
                {{ __('navigation.ind_achievements') }}
            @if (\App\Models\Achievement::receivedAchievements(true))
                {!! icon('lightning') !!}
            @endif
            </a></li>
            <li><a class="dropdown-item dropdown-right" href="{{ route('home.secretary.ranked_list_ee') }}">{{ __('navigation.results_ee') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
            @foreach (['ranked_list_ee', 'admit_number'] as $v)
                    <li><a  class="dropdown-item" href="{{ route('home.secretary.'.$v) }}">{{ __('lesson.'.$v) }}</a></li>
            @endforeach                    
                </ul>
            </li>
        </ul>
    </li>

    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.education') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <a  class="dropdown-item disabled" href="#">{{ trans('navigation.students_number') }}</a>
            <a  class="dropdown-item disabled" href="#">{{ trans('navigation.postgraduate_vacancies') }}</a>
        </div>
    </li>
    
    <li class="nav-item">
        <a href="#" class="nav-link">
           {{ __('navigation.data') }}
        </a>
    </li>
</ul>
