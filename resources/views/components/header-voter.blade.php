<header class="header px-2">
    @auth('voter')
        <div class="header-token">
            {{ Auth::user()->token }}
        </div>
    @else
        <a href="{{ route('voter.index') }}" class="font-bold text-lg uppercase">Vote System</a>
    @endauth
    <nav>
        @auth('voter')
            <a href="{{ route('voter.logout') }}" class="mx-2 uppercase">Exit</a>
        @endauth
    </nav>
</header>
