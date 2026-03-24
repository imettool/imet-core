@extends('modular-forms::layouts.forms')

@section('content')
    <div class="container title-page">
        <strong>Scaling up analysis report ({{ $protected_areas }})</strong>

    </div>
    <div id="preview-elements">
        <div class="container">
            <preview-template :scaling_up_id="{{ $scaling_up_id }}"></preview-template>
        </div>
    </div>
@endsection


@section('side-buttons')

    @component('modular-forms::module.side-buttons',[
        'withZoom' => true
    ])

        <div id="imet_report" class="imet_report sideButtons">
            <div @click="downloadFiles">
                {!! \ModularForms\Helpers\Template::icon('download') !!} {{ ucfirst(trans('imet-core::analysis_report.download_files')) }}
            </div>
        </div>
        <div id="imet_report" class="imet_report sideButtons">
            <div @click="printReport">
                {!! \ModularForms\Helpers\Template::icon('print') !!} {{ ucfirst(trans('imet-core::common.print')) }}
            </div>
        </div>

    @endcomponent

@endsection


@push('scripts')
    <style>
        .fill {
            min-height: 100%;
            height: 100%;
        }

        @media print {
            .imet_report {
                visibility: hidden;
            }

            #imet_header {
                display: none;
            }

            .title-page {
                display: none;
            }

            .content div.img-fluid {
                page-break-after: always;
                margin-top: 5px;
            }
        }
    </style>
    <script>
        const labels = @json($labels);
        window.ScalingUp = {};
        window.ScalingUp.labels = function(label) {
            return labels[label];
        }
    </script>
    <script type="module">
        (new window.ImetCore.Apps.Preview({
            url: '{{ route('imet-core::scaling_up_download', ['scaling_id' => $scaling_up_id]) }}',

        })).mount('#preview-elements');
    </script>
@endpush
