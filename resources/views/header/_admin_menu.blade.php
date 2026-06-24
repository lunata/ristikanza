    <li class="nav-item dropdown"> {{-- ИНФОРМАЦИЯ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.info') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
            <a  class="dropdown-item" href="{{ route('users.adverts') }}">{{ __('navigation.famil_info') }}</a>
            <a  class="dropdown-item" href="{{ route('adverts.index') }}">{{ __('navigation.all_adverts') }}</a>
        </div>
    </li>
    
    <li class="nav-item dropdown"> {{-- ПОЛЬЗОВАТЕЛИ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.users') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a  class="dropdown-item" href="{{ route('students.list', 'matriculants') }}">{{ __('navigation.matriculants') }}</a>
            <a  class="dropdown-item" href="{{ route('students.list', 'postgraduates') }}">{{ __('navigation.postgraduates') }}</a>
            <a  class="dropdown-item" href="{{ route('students.list', 'applicants') }}">{{ __('navigation.applicants') }}</a> 
            <a  class="dropdown-item" href="{{ route('students.list', 'expelled') }}">{{ __('navigation.expelled') }}</a> 
            <a  class="dropdown-item" href="{{ route('students.list', 'not_entered') }}">{{ __('navigation.not_entered') }}</a> 
            <a  class="dropdown-item" href="{{ route('employees.index') }}">{{ __('navigation.employees') }}</a>
            <a  class="dropdown-item" href="{{ route('users.index') }}">{{ __('navigation.all_users') }}</a> 
        </div>
    </li>
    
    @include('header._admin_menu_graduate')   {{-- АСПИРАНТУРА --}}
    
    @include('header._admin_menu_docs')       {{-- ДОКУМЕНТЫ --}}
    
    @include('header._admin_menu_references') {{-- СПРАВОЧНИКИ --}}
</ul>
