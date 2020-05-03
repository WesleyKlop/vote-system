<header class="header px-2">
    @auth('voter')
        <div class="header-token">
            {{ Auth::user()->token }}
        </div>
    @else
        <a href="{{ route('voter.index') }}" class="font-bold text-lg uppercase">Vote System</a>
    @endauth
    <nav class="header-nav">
        @auth('voter')
            <a href="{{ route('voter.logout') }}" class="hover:text-failure">Exit</a>
        @endauth
    </nav>
</header>
