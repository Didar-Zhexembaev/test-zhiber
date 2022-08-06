<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ReportRequest;
use App\Models\City;
use App\Models\Transport;
use App\Models\Departuretype;
use App\Models\Report;

class ReportController extends BaseController
{
    public function report(ReportRequest $request)
    {
        $fields = $request->validated();
        try {
            Report::create([
                'user_id'        => $request->user()->id,
                'from'           => $fields['from'],
                'to'             => $fields['to'],
                'transport_type' => $fields['transportType'],
                'departure_type' => $fields['departureType'],
                'weight'         => $fields['weight'] ?? 0,
                'date_time'      => date('Y-m-d H:i:s', $fields['dateTime']),
            ]);

            return $this->sendResponse('success', 'Заявка принята!');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError('Заявка не принята!', [
                'code' => $e->getCode()
            ]);
        }
    }

    public function form(Request $request)
    {
        return $this->sendResponse($this->getFormData(), 'success');
    }

    private function getFormData()
    {
        $formData = [];
        $formData['cities'] = City::select('id', 'city')->get()->toArray();
        $formData['transports'] = Transport::select('id', 'transport')->get()->toArray();
        $formData['departureTypes'] = DepartureType::select('id', 'type')->get()->toArray();
        
        return $formData;
    }

    public function reportAll()
    {
        return DB::table('reports as r')
            ->join('users as u', 'r.user_id', '=', 'u.id')
            ->join('cities as cf', 'r.from', '=', 'cf.id')
            ->join('cities as ct', 'r.to', '=', 'ct.id')
            ->join('transports as t', 'r.transport_type', '=', 't.id')
            ->join('departure_types as dt', 'r.departure_type', '=', 'dt.id')
            ->select(
                'u.email',
                'cf.city as from',
                'ct.city as to',
                't.transport as transportType',
                'dt.type as departureType',
                'r.weight',
                'r.date_time',
            )
            ->get();
    }
}
