<div class="score-bar">
    <div class="title">{!! $label !!}</div>
    <div class="score" style="margin-right: 20px;">
        <span v-html="{!! $score !!}"></span>
    </div>
    <div class="progress-bar-container">
        <div class="limit-left">{{ $limitMin }}%</div>
        <div class="progress-bar">
            <progress-bar
                :value="{!! $percentage !!}"
                color={!! $color !!}
                :negative="{{ $isNegative ? 'true' : 'false' }}"
            ></progress-bar>
        </div>
        <div class="limit-right">{{ $limitMax }}%</div>
    </div>
</div>


