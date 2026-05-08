<div class="score-bar">
    <div class="title">{!! $label !!}</div>
    <div class="score" style="margin-right: 20px;">
        @if($withJs)
            <span v-html="{!! $score !!}"></span>
        @else
            {!! $score !!}
        @endif
    </div>
    <div class="progress-bar-container">
        <div class="limit-left">{{ $limitMin }}%</div>
        <div class="progress-bar">
            @if($withJs)
                <progress-bar
                    :value="{!! $percentage !!}"
                    color={!! $color !!}
                    :negative="{{ $isNegative ? 'true' : 'false' }}"
                ></progress-bar>
            @else
                <progress-bar
                    :value="{!! $percentage !!}"
                    color={!! $color !!}
                    :negative="{{ $isNegative ? 'true' : 'false' }}"
                ></progress-bar>
            @endif
        </div>
        <div class="limit-right">{{ $limitMax }}%</div>
    </div>
</div>


