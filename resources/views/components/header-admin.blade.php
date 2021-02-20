<header class="header">
    <a href="{{ route('admin.index') }}" class="header-title">
        @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="@lang('Vote System')" class="h-12"/>
        @else
            @lang('Vote System')
        @endif
    </a>
    <nav class="header-nav">
        <a href="{{ route('admin.voters.index') }}">@lang('Voters')</a>
        <a href="{{ route('admin.index') }}">@lang('Propositions')</a>
        <a href="{{ route('admin.config.index') }}">@lang('Config')</a>
        <a href="{{ route('admin.login.logout') }}" class="hover:text-failure">@lang('Sign out')</a>
    </nav>
</header>
