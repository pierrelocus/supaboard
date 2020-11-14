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

## TODO

+ refactor migration scripts
+ manage graph data
+ create other widgets
+ enhance text/number widget with text to display what they are
+ find different color palettes and randomize the colors of widgets

## Screenshot

![alt text](https://github.com/pierrelocus/supaboard/supaboard.png "Screenshot")
