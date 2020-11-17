<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\WidgetsService;

class WidgetsController extends Controller
{
    /**
     * @var WidgetsService $widgetsService
     */
    protected $widgetsService;

    /**
     * WidgetsController constructor
     */
    public function __construct(WidgetsService $widgetsService)
    {
        $this->widgetsService = $widgetsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->widgetsService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $widgetId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $widgetId)
    {
        $data = $request->only([
            'type',
            'x',
            'y',
            'width',
            'height',
            'data',
            'auto_position',
            'text'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->widgetsService->updateOrCreateWidget($data, $widgetId);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->widgetsService->deleteByWidgetId($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }
}
