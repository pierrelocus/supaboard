# Supaboard

Supaboard is a dashboard made with Laravel and Vue (please note I began Vue some days ago).
Help will be apreciated :)

The goal was basically to learn Vue and Pusher (and found GridStack), but actually it looks pretty cool and I will continue working on it.

Do not hesitate contacting me at pierrelocus@gmail.com if you have advices or want to talk about the project !

I know there are packages to remove, refacto to do etc. My main objective is to have the current widgets working perfectly and document their use.

See you soon !

(Begin 2020/11/12)

## Installation

```bash
# Clone this repo and cd into
composer install
npm i && npm run dev

# Edit your .env with Pusher and DB credentials
# For now put your Pusher API key at the end of resources/js/bootstrap.js (will be replaced later with process env)

# In a terminal
php artisan serve

# In another terminial (or check to run it with [supervisord](https://beyondco.de/docs/laravel-websockets/basic-usage/starting))
php artisan websockets:serve
```

## Usage

The goal is to only use api calls to manage the widgets.
Info about widgets can be found in /admin (table dumping the db)
Use POST requests to /api/widgets/{widget_id} with data as explained behind.
(If widget_id doesn't exist, it will create a new widget)
Use DELETE requests to /api/widgets/{widget_id} to delete it.

```
{
    x: Number,
    y: Number,
    width: Number,
    height: Number,
    type: String (text|number|gauge|graph|food|clock|calendar),
    auto_position: Boolean (use 0 if you give a x/y position, will force later),
    text: String,
    data: Object
}
```
Widget specific data:

### Gauge
```
data: 
{
    max: Number,
    min: Number,
    value: Number,
    start_angle: Number,
    end_angle: Number,
    scale_interval: Number,
    step: Number,
},
```

### Graph
```
data: 
{
    labels: Array, (labels for X)
    datasets: Array of Objects
}
datasets objects :
{
    "label": String,
    "borderColor": String,
    "data": Array of int
}
```
### Calendar
```
data:
{
    "events": [
        {
            "title": String,
            "start": String (e.g. "2020-01-01 14:00:00"),
            "end": String (e.g. "2020-01-01 14:30:00")
        }
    ]
}
```

## TODO

+ refactor migration scripts
+ make widget movable/resizable when created (I don't know why it's not)
+ enhance text/number widget with text to display what they are
+ find different color palettes and randomize the colors of widgets (working on it, not able to do real random in scss)
+ create other widgets

## Screenshot
![alt text](https://raw.githubusercontent.com/pierrelocus/supaboard/main/supaboard.png "Screenshot")

## Data

You can get the result on the screenshot by running the fill.py file in the root folder (adapt the port if you change the default 8000)
