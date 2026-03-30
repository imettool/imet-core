<div class="radio">

    @foreach($list as $key=>$label)
        <div>
            <input type="radio" name="radio-{{ $key }}"
                   value="$key"
                  @if($key == $value) checked="checked" @endif
            />
            {{ $label }}
        </div>
    @endforeach

</div>
