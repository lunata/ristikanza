@php
    $width = floor(100/sizeof($submenu));
    $first_width = 100 - $width*(sizeof($submenu)-1);
@endphp
    <div class='hor-links'>  
        @foreach ($submenu as $route=>$link)
        <a href="{{ $route }}" style="width: {{ $loop->iteration == 1 ? $first_width : $width }}%" class="{{ $link[1] }}">{!! $link[0] !!}</a>
        @endforeach
    </div>                              
