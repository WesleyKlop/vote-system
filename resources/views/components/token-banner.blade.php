<div class="banner px-2">
    Your token: <span class="font-mono">{{ trim(chunk_split(Auth::user()->token, 4, ' ')) }}</span>
</div>
