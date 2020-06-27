<h3 class="sub-title">{{ $page->getListQuestion()->option }}</h3>
<div>
    @error('answer')
    <span class="text-failure">You are required to select an answer</span>
    @enderror
    @foreach($page->getListOptions() as $option)
        <input
            type="radio"
            name="answer[{{ $page->getListQuestion()->id }}]"
            value="{{ $option->id }}"
            id="{{ $option->id }}"
            class="hidden"
            required
        />
        <label class="radio-input-label" for="{{ $option->id }}">
            <span class="radio-input-text">{{ $option->option }}</span>
        </label>
    @endforeach
</div>
