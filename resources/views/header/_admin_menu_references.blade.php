    <li class="nav-item dropdown"> {{-- СПРАВОЧНИКИ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.references') }}
        </a>

        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
            <li>
                <a class="dropdown-item dropdown-right" href="#">{{ __('navigation.person_info') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
            @foreach (['langs', 'countries', 'subdivisions', 'positions', 'degrees', 
                       'atitles', 'vspecs'] as $v)
                    <li><a  class="dropdown-item" href="{{ route($v.'.index') }}">{{ __('navigation.'.$v) }}</a></li>
            @endforeach                    
                </ul>
            </li>
            <li>
                <a class="dropdown-item dropdown-right" href="#">{{ __('navigation.profiles_specialities') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
            @foreach (['directions', 'profiles', 'specgroups', 'specialities', 'vacancies'] as $v)
                    <li><a  class="dropdown-item" href="{{ route($v.'.index') }}">{{ __('navigation.'.$v) }}</a></li>
            @endforeach                    
                </ul>
            </li>
            <li>
                <a class="dropdown-item dropdown-right" href="#">{{ __('navigation.schedule') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
                    <li><a  class="dropdown-item" href="{{ route('struct_op_up') }}">{{ __('navigation.struct_op_up') }}</a></li>
            @foreach (['disciplines', 'groups', 'corps', 'cabinets'] as $v)
                    <li><a  class="dropdown-item" href="{{ route($v.'.index') }}">{{ __('navigation.'.$v) }}</a></li>
            @endforeach                    
                </ul>
            </li>
            <li>
                <a class="dropdown-item dropdown-right" href="#">{{ __('navigation.orders') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
            @foreach (['oclasses', 'signatories', 'signings'] as $v)
                    <li><a  class="dropdown-item" href="{{ route($v.'.index') }}">{{ __('navigation.'.$v) }}</a></li>
            @endforeach                    
                </ul>
            </li>
            <li>
                <a class="dropdown-item dropdown-right" href="#">{{ __('navigation.virtual_reception') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
            @foreach (['subjects'] as $v)
                    <li><a  class="dropdown-item" href="{{ route($v.'.index') }}">{{ __('navigation.'.$v) }}</a></li>
            @endforeach                    
                </ul>
            </li>
            @foreach (['settings'] as $v)
            <li><a  class="dropdown-item" href="{{ route($v.'.index') }}">{{ __('navigation.'.$v) }}</a></li>
            @endforeach
{{--          <li>
            <a class="dropdown-item" href="#">
              Submenu &raquo;
            </a>
            <ul class="dropdown-menu dropdown-submenu">
              <li>
                <a class="dropdown-item" href="#">Submenu item 1</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
                <ul class="dropdown-menu dropdown-submenu">
                  <li>
                    <a class="dropdown-item" href="#">Multi level 1</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Multi level 2</a>
                  </li>
                </ul>
              </li>
            </ul>
          </li> --}}
        </ul>
    </li>
</ul>
