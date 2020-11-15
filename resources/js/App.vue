<template>
    <div id="app">
        <div class="container-fluid">
            <div class="d-flex header m-0 p-2">
                <h2>Supaboard</h2>
            </div>
            <section class="grid-stack bg-lightdark">
                <component
                    v-for="widget in widgets"
                    v-bind="widget"
                    :is="widget.type"
                    :key="widget.id"></component>
            </section>
        </div>
    </div>
</template>
<script>
    import { GridStack } from 'gridstack';
    import 'gridstack/dist/gridstack.css';


    function Widget({id, widget_id, x, y, width, height, auto_position, text, type, data}) {
        this.id = id;
        this.widget_id = widget_id;
        this.x = x; 
        this.y = y; 
        this.width = width; 
        this.height = height; 
        this.auto_position = auto_position; 
        this.text = text;
        this.type = type.charAt(0).toUpperCase() + type.slice(1) + 'WidgetComponent';
        if (data && typeof data === 'string' && data !== '{}') {
            data = JSON.parse(data);
        }
        this.data = data;
    }

    export default {
        data() {
            return {
                grid: null,
                widgets: [],
                widgetIds: [],
            };
        },
        mounted: function() {
            this.grid = GridStack.init({ float: true, cellHeight: '70px', minRow: 1 });
            this.loadWidgets();
            this.bindGridEvents();
            this.bindListener();
        },
        methods: {
            async loadWidgets() {
                await window.axios.get('/api/widgets').then(response => {
                    if (response.data) {
                        response.data.forEach(widget => {
                            this.widgets.push(new Widget(widget));
                        });
                    }
                });
                this.makeWidgets();
            },
            async makeWidgets() {
                await this.$nextTick();
                this.widgets.forEach(widget => {
                    this.grid.makeWidget('#' + widget.widget_id);
                    this.widgetIds.push(widget.widget_id);
                });
            },
            bindGridEvents() {
                this.grid.on('change', function(i, elems){
                    elems.forEach(function(elem){
                        let post = ['gsX', 'gsY', 'gsWidth', 'gsHeight'];
                        let data = {};
                        for (let p in post) {
                            data[post[p]] = elem.el.dataset[post[p]];
                        }
                        data['auto_position'] = 0;
                        data['from_vue'] = true;
                        window.axios.post(`/api/widgets/${elem.el.id}`, data);
                    });
                });
            },
            bindListener() {
                Echo.channel('widgets')
                .listen('.widget-change', (e) => {
                    this.widgets = [];
                    e.widgets.forEach(widget => {
                        this.widgets.push(new Widget(widget));
                        if (!this.widgetIds.includes(widget.widget_id)) {
                            this.grid.makeWidget('#' + widget.widget_id);
                            this.widgetIds.push(widget.widget_id);
                        }
                    });
                });
            },
        },
    }
</script>
