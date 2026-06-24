    <li class="nav-item dropdown">                                              {{-- АСПИРАНТУРА --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.graduate') }}
        </a>

        <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
            <li>                                                                {{-- Прием --}}
                <a class="dropdown-item dropdown-right" href="#">{{ __('navigation.acceptance') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
                    <li><a class="dropdown-item disabled" href="">{{ __('navigation.programs_ee') }}</a></li>
                    <li><a class="dropdown-item" href="{{ route('achievements.index') }}">
                            {{ __('navigation.ind_achievements') }}
            @if (\App\Models\Achievement::receivedAchievements(false))
                            {!! icon('lightning') !!}
            @endif
                        </a></li>
                    <li><a class="dropdown-item" href="{{ route('schedules.index', ['search_activity'=>1]) }}">{{ __('navigation.schedules_ee') }}</a></li>
                    <li><a class="dropdown-item dropdown-right" href="{{ route('exams.ranked_list_ee') }}">{{ __('navigation.results_ee') }}</a>
                        <ul class="dropdown-menu dropdown-submenu">
                    @foreach (['ranked_list_ee', 'admit_number'] as $v)
                            <li><a  class="dropdown-item" href="{{ route('exams.'.$v) }}">{{ __('lesson.'.$v) }}</a></li>
                    @endforeach                    
                        </ul>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('users.create_passwords') }}">{{ __('navigation.new_passwords') }}</a></li>
                </ul>
            </li>
            
            <li>                                                                {{-- Обучение --}}
                <a class="dropdown-item dropdown-right" href="{{ route('schedules.index') }}">{{ __('navigation.education') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
                    <li><a  class="dropdown-item" href="{{ route('iplans.index') }}">{{ __('navigation.ind_plans') }}</a></li>
                    <li><a  class="dropdown-item disabled" href="">{{ __('navigation.programs') }}</a></li>
                    <li><a  class="dropdown-item" href="{{ route('schedules.index', ['search_activity'=>2]) }}">{{ __('navigation.schedules') }}</a></li>
            @foreach (['performance', 'pg_portfolio'] as $v)
                    <li><a  class="dropdown-item disabled" href="">{{ __('navigation.'.$v) }}</a></li>
            @endforeach                    
                    <li><a  class="dropdown-item" href="{{ route('dtopics.index') }}">{{ __('navigation.theses') }}</a></li>
                    <li><a  class="dropdown-item" href="{{ route('advicers.index') }}">{{ __('navigation.advicers') }}</a></li>
                </ul>
            </li>
            
            <li> {{-- Прикрепление --}}
                <a class="dropdown-item dropdown-right" href="#">{{ __('navigation.attachment') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
            @foreach (['programs', 'schedules'] as $v)
                    <li><a  class="dropdown-item disabled" href="">{{ __('navigation.'.$v) }}</a></li>
            @endforeach                    
                </ul>
            </li>
{{--            <li>
            <a  class="dropdown-item" href="{{ route('lessons.index') }}">{{ __('navigation.lessons') }}</a>
            </li> --}}
        </ul>
    </li>
