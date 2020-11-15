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
    type: String (text|number|gauge|graph|food|clock),
    auto_position: Boolean (use 0 if you give a x/y position, will force later),
    text: String,
    data: Object
}
```
Widget specific data:

Gauge
```
data: {
    max: Number,
    min: Number,
    value: Number,
    start_angle: Number,
    end_angle: Number,
    scale_interval: Number,
    step: Number,
},
```

Graph
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

## TODO

+ refactor migration scripts
+ make widget movable/resizable when created (I don't know why it's not)
+ enhance text/number widget with text to display what they are
+ find different color palettes and randomize the colors of widgets (working on it, not able to do real random in scss)
+ create other widgets

## Screenshot
![alt text](https://raw.githubusercontent.com/pierrelocus/supaboard/main/supboard.png "Screenshot")

## Data

The result on my screenshot comes from these data:

```sql
LOCK TABLES `widget_actions` WRITE;
/*!40000 ALTER TABLE `widget_actions` DISABLE KEYS */;
INSERT INTO `widget_actions` VALUES (12,'food-1',NULL,'2020-11-14 10:00:37','2020-11-15 15:01:27',0,3,2,5,0,NULL,'food'),(13,'clock-1',NULL,'2020-11-14 13:39:10','2020-11-14 18:15:54',0,0,3,3,0,NULL,'clock'),(19,'graph-1','{\"labels\": [1, 2], \"datasets\": [{\"label\": \"data1\", \"borderColor\": \"blue\", \"data\": [1, 4, 6, 7, 3]}, {\"label\": \"data2\", \"borderColor\": \"green\", \"data\": [3, 5, 3, 5, 6]}]}',NULL,'2020-11-15 15:01:30',2,3,2,5,0,'graph','graph'),(20,'text-1',NULL,'2020-11-15 14:49:04','2020-11-15 15:01:25',3,0,3,2,0,'Hello !','text'),(23,'number-1',NULL,'2020-11-15 15:02:50','2020-11-15 15:02:54',4,2,3,2,0,'12','number');
/*!40000 ALTER TABLE `widget_actions` ENABLE KEYS */;
UNLOCK TABLES;
```
