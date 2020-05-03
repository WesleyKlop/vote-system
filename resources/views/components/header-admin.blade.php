<header class="header">
    <a href="{{ route('admin.index') }}" class="header-title">Vote System</a>
    <nav class="header-nav">
        <a href="{{ route('admin.voters.index') }}">Voters</a>
        <a href="{{ route('admin.index') }}">Propositions</a>
        <a href="{{ route('admin.login.logout') }}" class="hover:text-failure">Logout</a>
    </nav>
</header>
