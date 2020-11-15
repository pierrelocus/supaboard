<template>
    <div class="grid-stack-item"
        :id="widget_id"
        :data-gs-x="x" 
        :data-gs-y="y" 
        :data-gs-width="width" 
        :data-gs-height="height" 
        :data-gs-auto-position="auto_position">
        <div class="grid-stack-item-content food">
            <div class="food-container" :style="{ 'background-image': 'url(' + url + ')' }">
            </div>
            <span class="widget_id_bottom">ID : {{ widget_id }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'id', 'widget_id', 'x', 'y', 'width', 'height', 'auto_position', 'text'
        ],
        data() {
            return {
                url: ''
            }
        },
        mounted() {
            this.setPicture();
            this.pictureBeat();
        },
        methods: {
            async pictureBeat() {
                setInterval(function(){
                    this.setPicture();
                }.bind(this), 1000 * 60 * 10);
            },
            async setPicture() {
                await window.axios.get('https://foodish-api.herokuapp.com/api').then(response => {
                    if (response.data.image) {
                        this.url = response.data.image;
                    }
                });
            }
        },
        updated() {
        }
    }
</script>
