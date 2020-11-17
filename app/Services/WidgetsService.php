<?php

namespace App\Services;

use App\Repositories\WidgetsRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class WidgetsService
{
    /**
     * @var WidgetsRepository $widgetsRepository
     */
    protected $widgetsRepository;

    /**
     * WidgetsService constructor
     */
    public function __construct(WidgetsRepository $widgetsRepository)
    {
        $this->widgetsRepository = $widgetsRepository;
    }

    /**
     * Get all widgets
     * 
     * @return String
     */
    public function getAll()
    {
        return $this->widgetsRepository->getAllWidgets();
    }

    /**
     * Find one by widget_id or creates one
     * 
     * @param String $widgetId
     * @return String
     */
    public function findByWidgetId($widgetId)
    {
        return $this->widgetsRepository->findByWidgetId($widgetId);
    }

    /**
     * Delete one by widget_id
     * 
     * @param String $widgetId
     * @return String $widget
     */
    public function deleteByWidgetId($widgetId)
    {
        DB::beginTransaction();

        try {
            $widget = $this->widgetsRepository->deleteByWidgetId($widgetId);
        } catch (Exception $e) {
            DB::rollback();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post with given widget id');
        }
        DB::commit();
        
        return $widget;
    }

    /**
     * Update or create a widget with given data
     * 
     * @param array $data
     * @param String $widgetId
     * @return String $result
     */
    public function updateOrCreateWidget($data, $widgetId)
    {
        $widgetId = strval($widgetId);
        $exists = $this->widgetsRepository->findByWidgetId($widgetId);
        if (!$exists) {
            $validator = Validator::make($data, [
                'type' => 'string',
                'x' => 'nullable|integer',
                'y' => 'nullable|integer',
                'width' => 'integer',
                'height' => 'integer',
                'data' => 'nullable|string',
                'auto_position' => 'nullable|integer',
                'text' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }
            $result = $this->widgetsRepository->save($data);
        } else {
            $validator = Validator::make($data, [
                'type' => 'nullable|string',
                'x' => 'nullable|integer',
                'y' => 'nullable|integer',
                'width' => 'nullable|integer',
                'height' => 'nullable|integer',
                'data' => 'nullable|string',
                'auto_position' => 'nullable|integer',
                'text' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }
            $result = $this->widgetsRepository->updateByWidgetId($data, $widgetId);
        }
        return $result;
    }
}
