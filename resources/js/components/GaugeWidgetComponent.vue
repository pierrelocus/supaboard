<template>
    <div class="grid-stack-item"
        :id="widget_id"
        :data-gs-x="x" 
        :data-gs-y="y" 
        :data-gs-width="width" 
        :data-gs-height="height" 
        :data-gs-auto-position="auto_position">
        <div class="grid-stack-item-content gauge">
            <VueSvgGauge
                class="gauge_item mx-auto"
                :start-angle="data.start_angle"
                :end-angle="data.end_angle"
                :value="data.value"
                :separator-step="data.step"
                :min="data.min"
                :max="data.max"
                :gauge-color="[{ offset: 0, color: '#347AB0'}, { offset: 100, color: '#8CDFAD'}]"
                :scale-interval="data.scale_interval"
                />
            <div class="text-center m-0 p-0">{{ text }}</div>
            <span class="widget_id_bottom">ID : {{ widget_id }}</span>
        </div>
    </div>
</template>
<script>
    import { VueSvgGauge } from 'vue-svg-gauge'
    
    export default {
        props: {
            id: Number,
            widget_id: String,
            x: Number,
            y: Number,
            width: Number,
            height: Number,
            auto_position: Number,
            text: String,
            data: {
                max: Number,
                min: Number,
                value: Number,
                start_angle: Number,
                end_angle: Number,
                scale_interval: Number,
                step: Number,
            },
        },
    }
</script>
