
<div v-if="data.props.values.scores" class="mt-4">

    <imet_bar_chart :title="'test'" :values="Object.values(data.props.values.scores)" :rotate="45"
                    :fields="Object.keys(data.props.values.scores)" :label="{label: {
                    show: true,
                    position: 'top'
                }}" :colors="Object.values(data.props.values.colors)"></imet_bar_chart>
</div>
<div v-for="items in data.props.values.items" :key="items.name" class="mt-4">
    <bar_reverse :min="0" :max="100" :fields="['score']" :title="items['name']"
                 :height="'250px'"
                 :show_legends="true"
                 :rotate="0"
                 :colors="[items['colors']]"
                 :values="[items['score']]"></bar_reverse>

    <table class="table-fixed w-full mt-2">
        <thead>
        <tr>
            <th style="width: 33%;">Aspect</th>
            <th style="width: 33%;">Comments</th>
            <th style="width: 33%;">Score</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(list, index) in items['items']" :key="index">
            <td class="w-1/3">@{{ list['aspect'] }}</td>
            <td class="w-1/2">@{{ list['comments'] }}</td>
            <td class="w-1/6 text-center">@{{ list['score'] }}</td>
        </tr>
        </tbody>
    </table>
</div>

