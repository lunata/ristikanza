    <li class="nav-item">
        <a href="{{ route('users.adverts')}}" class="nav-link">
           {{ __('navigation.adverts') }}
        </a>
    </li>

    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.profile') }}
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <a  class="dropdown-item" href="{{ route('home.anketa') }}">{{ trans('navigation.anketa') }}</a>
            <a  class="dropdown-item" href="{{ route('home.speciality') }}">{{ trans('ref.speciality') }}</a>
<?php /*            <a  class="dropdown-item" href="{{ route('home.passport') }}">{{ trans('navigation.passport') }}</a>
            <a  class="dropdown-item" href="{{ route('home.passw')}}">{{ trans('navigation.passw') }}</a> */ ?>
        </div>
    </li>
    
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           {{ __('navigation.education') }}
        </a>
        
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
            <li><a  class="dropdown-item disabled" href="#">{{ trans('navigation.programs') }}</a></li>
            <li><a  class="dropdown-item disabled" href="#">{{ trans('navigation.ipra') }}</a></li>
            
            <li><a  class="dropdown-item" href="{{ route('home.students.schedule') }}">{{ trans('navigation.schedule') }}</a></li>
            
            <li><a  class="dropdown-item disabled" href="#">{{ trans('navigation.performance') }}</a></li>
            <li><a  class="dropdown-item disabled" href="#">{{ trans('navigation.debts') }}</a></li>
            <li><a  class="dropdown-item" href="{{ route('home.documents') }}">
                {{ trans('navigation.documents') }} 
            @if ($user->hasNewDocs())
                {!! icon('lightning') !!}
            @endif
            </a></li>
        </ul>
    </li>

    <li class="nav-item">
        <a href="{{ route('home.feedback')}}" class="nav-link">
           {{ __('navigation.feedback') }}
        </a>
    </li>

</ul>
