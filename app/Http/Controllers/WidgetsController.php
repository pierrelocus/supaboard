<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\WidgetAction;
use App\Events\WidgetChange;

class WidgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $widgets = WidgetAction::all() ?? [];
        foreach ($widgets as $k => $widget) {
            $data[$k] = $widget;
            $data[$k]['data'] = json_decode($data[$k]['data'], true);
        }
        return response(json_encode($data), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $widget = WidgetAction::where('widget_id', '=', $id)->first();
        if (!$widget) {
            $widget = new WidgetAction();
        }
        $data = $request->all();
        if (isset($data['from_vue'])) {
            $widget->x = $data['gsX'];
            $widget->y = $data['gsY'];
            $widget->width = $data['gsWidth'];
            $widget->height = $data['gsHeight'];
            $widget->auto_position = $data['auto_position'];
        }
        else {
            try {
                foreach ($data as $k => $v) {
                    $widget->$k = $v;
                }
            } catch (\Exception $e) {
                error_log($e->getMessage());
                return response($e->getMessage(), Response::HTTP_NOT_FOUND);
            }
        }
        $widget->widget_id = $id;
        $widget->save();
        event(new WidgetChange());
        return response(null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
