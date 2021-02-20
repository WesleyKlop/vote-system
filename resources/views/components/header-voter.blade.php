<header class="header">
    <a href="{{ route('voter.index') }}" class="header-title">
        @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="@lang('Vote System')" class="h-12"/>
        @else
            @lang('Vote System')
        @endif
    </a>
    <nav class="header-nav">
        @auth('voter')
            <a href="{{ route('voter.logout') }}" class="hover:text-failure">@lang('Exit')</a>
        @endauth
    </nav>
</header>
