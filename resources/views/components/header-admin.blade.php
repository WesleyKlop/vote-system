<header class="header">
    <a href="{{ route('admin.index') }}" class="header-title">
        @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="Vote System" class="h-12"/>
        @else
            Vote System
        @endif
    </a>
    <nav class="header-nav">
        <a href="{{ route('admin.voters.index') }}">Voters</a>
        <a href="{{ route('admin.index') }}">Propositions</a>
        <a href="{{ route('admin.config.index') }}">Config</a>
        <a href="{{ route('admin.login.logout') }}" class="hover:text-failure">Logout</a>
    </nav>
</header>
