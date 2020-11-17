<template>
    <div class="grid-stack-item"
        :id="widget_id"
        :data-gs-x="x" 
        :data-gs-y="y" 
        :data-gs-width="width" 
        :data-gs-height="height" 
        :data-gs-auto-position="auto_position">
        <div class="grid-stack-item-content clock">
            <div id="clock">
                <p class="date">{{ date }}</p>
                <p class="time">{{ time }}</p>
            </div>
            <span class="widget_id_bottom">ID : {{ widget_id }}</span>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            id: Number, 
            widget_id: String, 
            x: Number, 
            y: Number, 
            width: Number, 
            height: Number, 
            auto_position: Number, 
            text: String
        },
        data() {
            return {
                time: '',
                date: ''
            }
        },
        mounted() {
            let timerID = setInterval(this.updateTime, 1000);
            this.updateTime();
        },
        methods: {
            updateTime() {
                let week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
                let cd = new Date();
                this.time = this.zeroPadding(cd.getHours(), 2) + ':' + this.zeroPadding(cd.getMinutes(), 2) + ':' + this.zeroPadding(cd.getSeconds(), 2);
                this.date = this.zeroPadding(cd.getFullYear(), 4) + '-' + this.zeroPadding(cd.getMonth()+1, 2) + '-' + this.zeroPadding(cd.getDate(), 2) + ' ' + week[cd.getDay()];
            },
            zeroPadding(num, digit) {
                var zero = '';
                for(var i = 0; i < digit; i++) {
                    zero += '0';
                }
                return (zero + num).slice(-digit);
            }
        }
    }
</script>
