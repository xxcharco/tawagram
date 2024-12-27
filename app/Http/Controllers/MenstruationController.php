<?php

namespace App\Http\Controllers;

use App\Models\Menstruation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenstruationController extends Controller
{
        // indexメソッド：月経記録のTOP画面
        public function index()
        {
            $records = Menstruation::orderBy('start_date', 'desc')
            ->take(3)
            ->get()
            ->map(function ($record) {
                return [
                    'id' => $record->id,
                    'start_date' => $record->start_date->format('Y年n月j日'),
                    'end_date' => $record->end_date ? $record->end_date->format('Y年n月j日') : null,
                ];
            });
    
        return Inertia::render('Menstruation/Index', [
            'records' => $records
        ]);
        }
    
        // createメソッド：新規記録画面
        public function create()
        {
            return Inertia::render('Menstruation/Create');
        }
    
        // storeメソッド：記録の保存処理
        public function store(Request $request)
        {
            $validated = $request->validate([
                'start_date' => 'required|date',
            ]);
    
            Menstruation::create($validated);
    
            return Inertia::render('Menstruation/Complete');
        }
    
        // storeEndメソッド：生理終了日の記録
        public function storeEnd(Request $request)
        {
            $validated = $request->validate([
                'end_date' => 'required|date',
            ]);
    
            $menstruation = Menstruation::latest()->first();
            $menstruation->update($validated);
    
            return Inertia::render('Menstruation/Complete');
        }
}
