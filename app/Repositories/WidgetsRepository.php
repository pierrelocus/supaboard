<?php

namespace App\Repositories;

use App\Models\WidgetAction;
use App\Events\WidgetChange;

class WidgetsRepository
{
    /**
     * @var WidgetAction $widget
     */
    protected $widget;

    /**
     * WidgetsRepository constructor
     * 
     * @param WidgetAction $widget
     */
    public function __construct(WidgetAction $widget)
    {
        $this->widget = $widget;
    }

    /** 
     * Fires event for Vuejs to get data change
     */
    private function _fireEvent()
    {
        event(new WidgetChange($this->getAllWidgets()));
    }

    /**
     * Get all widgets
     * 
     * @return WidgetAction $data
     */
    public function getAllWidgets()
    {
        $widgets = $this->widget->get();
        $data = [];
        foreach ($widgets as $k => $widget) {
            $data[$k] = $widget;
            $data[$k]['data'] = json_decode($data[$k]['data'], true);
        }
        return $data;
    }

    /**
     * Find one by widget_id or create new record
     * 
     * @param String $widgetId
     * @return WidgetAction
     */
    public function findByWidgetId($widgetId)
    {
        return $this->widget->where('widget_id', '=', $widgetId)->first();
    }

    /**
     * Create one with given data
     * 
     * @param array $data
     * @param String $widgetId
     * @return WidgetAction $widget
     */
    public function save($data, $widgetId)
    {
        $widget = new $this->widget;

        foreach ($data as $k => $v) {
            $widget->$k = $v;
        }

        $widget->widget_id = $widgetId;

        $widget->save();

        $this->_fireEvent();
        
        return $widget->fresh();
    }

    /**
     * Destroy one by widget_id
     * 
     * @param String $widgetId
     * @return WidgetAction $widget
     */
    public function deleteByWidgetId($widgetId)
    {
        $widget = $this->findByWidgetId($widgetId);
        $widget->delete();

        $this->_fireEvent();

        return $widget;
    }

    /**
     * Update given widget_id with data
     * 
     * @param array $data
     * @param String $widgetId
     * @return WidgetAction $widget
     */
    public function updateByWidgetId($data, $widgetId)
    {
        $widget = $this->findByWidgetId($widgetId);

        foreach ($data as $k => $v) {
            $widget->$k = $v;
        }

        $widget->save();

        $this->_fireEvent();

        return $widget->fresh();
    }
}
