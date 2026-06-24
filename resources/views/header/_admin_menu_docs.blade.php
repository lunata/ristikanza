    <li class="nav-item dropdown"> {{-- ДОКУМЕНТЫ --}}
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('navigation.documents') }}
        </a>

        <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
            <li> {{-- Шаблоны --}}
                <a class="dropdown-item dropdown-right" href="{{ route('patterns.index') }}">{{ __('navigation.patterns') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
            @foreach (trans('doc.pgroup_values') as $k => $v)
                    <li><a  class="dropdown-item" href="{{ route('patterns.index', ['search_pgroup'=>$k]) }}">{{ $v }}</a></li>
            @endforeach        
                </ul>
            </li>
            
            <li> {{-- Приказы --}}
                <a class="dropdown-item dropdown-right" href="{{ route('orders.index') }}">{{ __('navigation.orders') }}
                    @if (\App\Models\Order::notEffected()) 
                        {!! icon('lightning') !!}
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-submenu">
                    <li><a  class="dropdown-item" href="{{ route('orders.index') }}">{{ __('doc.order_projects') }}</a></li>
                    <li><a  class="dropdown-item" href="{{ route('orders.index', ['list'=>'registrs']) }}">{{ __('doc.order_registered') }}
                        @if (\App\Models\Order::notEffected()) 
                            {!! icon('lightning') !!}
                        @endif
                        </a>
                    </li>
                </ul>
            </li>
            
            @foreach (['protocols', 'certificates'] as $v)
                       <li><a  class="dropdown-item disabled" href="{{ route($v.'.index') }}">{{ __('navigation.'.$v) }}</a></li>
            @endforeach
            <li> {{-- Журналы --}}
                <a class="dropdown-item dropdown-right" href="{{ route('logs.index') }}">{{ __('navigation.logs') }}</a>
                <ul class="dropdown-menu dropdown-submenu">
                    <li><a  class="dropdown-item" href="{{ route('logs.admission') }}">{{ __('navigation.log_admission') }}</a></li>
                    <li><a  class="dropdown-item" href="{{ route('logs.orders') }}">{{ trans('navigation.log_orders') }}</a></li>
                    <li><a  class="dropdown-item disabled" href="#">{{ trans('navigation.log_inquiries') }}</a></li>
                </ul>
            </li>
            
            <li><a  class="dropdown-item" href="{{ route('files.index') }}">{{ __('navigation.files') }}</a></li>
        </ul>
    </li>
