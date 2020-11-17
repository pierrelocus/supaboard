<template>
    <div class="grid-stack-item"
        :id="widget_id"
        :data-gs-x="x" 
        :data-gs-y="y" 
        :data-gs-width="width" 
        :data-gs-height="height" 
        :data-gs-auto-position="auto_position">
        <input hidden :data="data"/>
        <div class="grid-stack-item-content calendar">
            <FullCalendar :options="calendarOptions" />
            <span class="widget_id_bottom">ID : {{ widget_id }}</span>
        </div>
    </div>
</template>
<script>
    import FullCalendar from '@fullcalendar/vue'
    import timeGridPlugin from '@fullcalendar/timegrid'
    import interactionPlugin from '@fullcalendar/interaction'

    function Event({title, start, end}) {
        this.title = title;
        this.start = start;
        this.end = end;
    }
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
            data: Object,
        },
        components: {
            FullCalendar,
        },
        data() {
            return {
                calendarOptions: {
                    plugins: [ timeGridPlugin, interactionPlugin ],
                    initialView: 'timeGridDay',
                    editable: true,
                    hiddenDays: [0, 6],
                    slotDuration: '00:30:00',
                    scrollTime: new Date().getHours()+':00:00',
                    events: [],
                    allDaySlot: false,
                }
            }
        },
        mounted() {
            this.checkEvents();
        },
        updated() {
            this.checkEvents();
        },
        methods: {
            checkEvents() {
                if (this.$props.data.events) {
                    this.calendarOptions.events = [];
                    this.$props.data.events.forEach(event => {
                        this.calendarOptions.events.push(new Event(event));
                    });
                }
            }
        },
    }
</script>
