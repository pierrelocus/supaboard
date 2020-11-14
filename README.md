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
Use POST requests to /api/widgets/{widget_id} with data like
```
{
    x: int,
    y: int,
    width: int,
    height: int,
    type: string (text|number|gauge|graph|food),
    auto_position: bool (use false if you give a x/y position, will force later),
    widget_id: string,
    text: string,
    data: object
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

## TODO

+ refactor migration scripts
+ manage graph data
+ create other widgets
+ enhance text/number widget with text to display what they are
+ find different color palettes and randomize the colors of widgets

## Screenshot

![alt text](https://raw.githubusercontent.com/pierrelocus/supaboard/main/supaboard.png "Screenshot")

## Data

The result on my screenshot comes from these data:

```sql
LOCK TABLES `widget_actions` WRITE;
/*!40000 ALTER TABLE `widget_actions` DISABLE KEYS */;
INSERT INTO `widget_actions` VALUES (1,'number-one','{}',NULL,'2020-11-14 09:50:07',0,0,2,3,0,'5','number'),(2,'gauge-1','{\"max\": 100, \"value\": 20, \"min\": 0, \"step\": 10, \"start_angle\": -90, \"end_angle\": 90, \"scale_interval\": 15}',NULL,'2020-11-14 12:39:24',2,2,2,3,0,'Gauge','gauge'),(3,'text-1','',NULL,'2020-11-14 10:13:20',4,2,2,3,0,'New text widget !','text'),(5,'graph-1','{\"0\": 0, \"1\": 5, \"2\": 4, \"3\": 8, \"4\": 5}',NULL,'2020-11-14 13:01:48',2,5,2,5,0,'graph','graph'),(6,'gsi-1','{}','2020-11-14 09:03:57','2020-11-14 13:01:50',0,5,2,5,0,'qsdf','text'),(8,'testing-1','{}','2020-11-14 09:10:06','2020-11-14 10:13:11',4,0,2,2,0,'12','number'),(9,'testing-2','{}','2020-11-14 09:11:54','2020-11-14 09:50:11',0,3,2,2,0,'19','number'),(10,'test-3',NULL,'2020-11-14 09:24:24','2020-11-14 12:11:35',2,0,2,2,0,'42','number'),(12,'food-1',NULL,'2020-11-14 10:00:37','2020-11-14 13:01:38',4,5,2,5,0,NULL,'food');
/*!40000 ALTER TABLE `widget_actions` ENABLE KEYS */;
UNLOCK TABLES;
```
