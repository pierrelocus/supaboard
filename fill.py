#!/usr/bin/python3

import requests

url = 'http://localhost:8000/api/widgets/%s'

widgets = {
    'text-1': {
        'x': 0,
        'y': 0,
        'width': 3,
        'height': 2,
        'text': 'Hello world',
        'type': 'text',
        'auto_position': 0
    },
    'num-1': {
        'x': 0,
        'y': 2,
        'width': 2,
        'height': 2,
        'text': '12',
        'type': 'number',
        'auto_position': 0
    },
    'gauge-1': {
        'x': 3,
        'y': 0,
        'width': 2,
        'height': 2,
        'auto_position': 0,
        'text': 'Tasks',
        'type': 'gauge',
        'data': '{"max": 50, "min": 0, "value": 20, "start_angle": -110, "end_angle": 110, "scale_interval": 10, "step": 5}'
    },
    'cal-1': {
        'x': 8,
        'y': 0,
        'width': 4,
        'height': 9,
        'auto_position': 0,
        'type': 'calendar',
        'data': '{"events": [{"title": "Meeting 1", "start": "2020-11-16 19:00:00", "end": "2020-11-16 20:30:00"}, {"title": "Meeting 2", "start": "2020-11-16 19:30:00", "end": "2020-11-16 22:00:00"}]}'
    },
    'food-1': {
        'x': 5,
        'y': 0,
        'width': 3,
        'height': 6,
        'auto_position': 0,
        'type': 'food'
    },
    'graph-1': {
        'x': 0,
        'y': 4,
        'width': 4,
        'height': 9,
        'auto_position': 0,
        'type': 'graph',
        'data': '{"labels": [1, 2], "datasets": [{"label": "data1", "borderColor": "blue", "data": [1, 4, 6, 7, 3]}, {"label": "data2", "borderColor": "green", "data": [3, 5, 3, 5, 6]}]}'
    },
    'clock-1': {
        'x': 2,
        'y': 2,
        'width': 3,
        'height': 2,
        'auto_position': 0,
        'type': 'clock'
    }
}

for i in widgets:
    requests.post(url % (i, ), data=widgets[i])
print("filled :) ")
