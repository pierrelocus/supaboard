<template>
    <div class="grid-stack-item"
        :id="widget_id"
        :data-gs-x="x" 
        :data-gs-y="y" 
        :data-gs-width="width" 
        :data-gs-height="height" 
        :data-gs-auto-position="auto_position">
        <div class="grid-stack-item-content number">
            <h1 class="text-center">{{ text }}</h1>
            <span class="widget_id_bottom">ID : {{ widget_id }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'id', 'widget_id', 'x', 'y', 'width', 'height', 'auto_position', 'text'
        ],
        mounted() {
        },
        updated() {
        }
    }
</script>
