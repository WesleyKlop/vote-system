<div class="table-wrapper mb-2">
    <table class="table">
        <thead>
        <th></th>
        @foreach($proposition->horizontalOptions() as $option)
            <th>{{ $option->option }}</th>
        @endforeach
        </thead>
        <tbody>
        @foreach($proposition->verticalOptions() as $rowOption)
            <tr>
                <th>{{ $rowOption->option }}</th>
                @foreach($proposition->horizontalOptions() as $colOption)
                    <td>
                        <input
                            class="vote-radio"
                            id="option-{{$rowOption->id}}_{{$colOption->id}}"
                            type="radio"
                            name="answer[{{ $rowOption->id }}]"
                            value="{{ $colOption->id }}"
                            required
                        />
                        <label class="vote-radio-label" for="option-{{$rowOption->id}}_{{$colOption->id}}">
                            <span></span>
                        </label>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
