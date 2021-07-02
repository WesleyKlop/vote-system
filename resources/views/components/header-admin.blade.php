<header class="header">
    <a href="{{ route('admin.index') }}" class="header-title">
        @if($logoUrl)
            <img src="{{ $logoUrl }}" alt="@lang('Vote System')" class="h-12" />
        @else
            @lang('Vote System')
        @endif
    </a>
    <nav class="header-nav">
        <a href="{{ route('admin.index') }}" class='flex'>
            @lang('Live')
            <div class="relative flex -ml-1 h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-accent"></span>
            </div>
        </a>
        <a href="{{ route('admin.voters.index') }}">@lang('Voters')</a>
        <a href="{{ route('admin.propositions.index') }}">@lang('Propositions')</a>
        <a href="{{ route('admin.config.index') }}">@lang('Config')</a>
        <a href="{{ route('admin.login.logout') }}" class="hover:text-failure">@lang('Sign out')</a>
    </nav>
</header>
