<template>
    <div class="grid-stack-item"
        :id="widget_id"
        :data-gs-x="x" 
        :data-gs-y="y" 
        :data-gs-width="width" 
        :data-gs-height="height" 
        :data-gs-auto-position="auto_position">
        <div class="grid-stack-item-content graph">
            <line-chart class="chart_item" :chart-data="datacollection"></line-chart>
            <span class="widget_id_bottom">ID : {{ widget_id }}</span>
        </div>
    </div>
</template>

<script>
    import LineChart from './LineChart.js'

    export default {
        props: [
            'id', 'widget_id', 'x', 'y', 'width', 'height', 'auto_position', 'text', 'data'
        ],
        components: {
            LineChart
        },
        data () {
            return {
                datacollection: {}
            }
        },
        mounted () {
            this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = {
                labels: [this.getRandomInt(), this.getRandomInt()],
                datasets: [
                    {
                        label: 'Data 1',
                        borderColor: 'blue',
                        data: [this.getRandomInt(), 
                        this.getRandomInt(), 
                        this.getRandomInt(), 
                        this.getRandomInt(), 
                        this.getRandomInt()],
                    }, {
                        label: 'Data 2',
                        borderColor: 'green',
                        data: [this.getRandomInt(), 
                        this.getRandomInt(), 
                        this.getRandomInt(), 
                        this.getRandomInt(),
                        this.getRandomInt()]
                    }
                ]
                }
            },
            getRandomInt () {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            }
        }
    }
</script>
