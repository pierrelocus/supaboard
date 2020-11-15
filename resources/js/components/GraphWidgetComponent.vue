<template>
    <div class="grid-stack-item"
        :id="widget_id"
        :data-gs-x="x" 
        :data-gs-y="y" 
        :data-gs-width="width" 
        :data-gs-height="height" 
        :data-gs-auto-position="auto_position">
        <div class="grid-stack-item-content graph">
            <line-chart class="chart_item" :chart-data="data"></line-chart>
            <span class="widget_id_bottom">ID : {{ widget_id }}</span>
        </div>
    </div>
</template>

<script>
    import LineChart from './LineChart.js'

    export default {
        props:{ 
            id: Number,
            widget_id: String,
            x: Number,
            y: Number,
            width: Number,
            height: Number,
            auto_position: (Boolean|Number),
            text: String,
            data: {
                labels: Array,
                datasets: Array
            },
        },
        components: {
            LineChart
        },
    }
</script>
