@if ($last_page > 1)
    @php
        $fromPage = max(1, $current_page - 3);
        $toPage = min($last_page, $current_page + 3);
        $query = request()->except('page');

        $pageUrl = function ($page) use ($query, $route) {
            return route(
                $route,
                array_merge($query, ['page' => $page])
            );
        };

    @endphp

<nav class="pagination-nav"
     aria-label="{{ __('pagination.pagination_navigation') }}">
    <ul class="pagination">
        {{-- Предыдущая --}}
            @if ($current_page > 1)
                <li>
                    <a href="{{ $pageUrl($current_page - 1) }}"
                       rel="prev"
                       aria-label="{{ __('navigation.previous_page') }}">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span aria-hidden="true">&laquo;</span>
                </li>
            @endif

            {{-- Первая страница и многоточие --}}
            @if ($fromPage > 1)
                <li>
                    <a href="{{ $pageUrl(1) }}">1</a>
                </li>

                @if ($fromPage > 2)
                    <li class="disabled">
                        <span>&hellip;</span>
                    </li>
                @endif
            @endif

            {{-- Соседние страницы --}}
            @for ($page = $fromPage; $page <= $toPage; $page++)
                @if ($page == $current_page)
                    <li class="active" aria-current="page">
                        <span>{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $pageUrl($page) }}">
                            {{ $page }}
                        </a>
                    </li>
                @endif
            @endfor

            {{-- Последняя страница и многоточие --}}
            @if ($toPage < $last_page)
                @if ($toPage < $last_page - 1)
                    <li class="disabled">
                        <span>&hellip;</span>
                    </li>
                @endif

                <li>
                    <a href="{{ $pageUrl($last_page) }}">
                        {{ $last_page }}
                    </a>
                </li>
            @endif

            {{-- Следующая --}}
            @if ($current_page < $last_page)
                <li>
                    <a href="{{ $pageUrl($current_page + 1) }}"
                       rel="next"
                       aria-label="{{ __('navigation.next_page') }}">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
        @endif
