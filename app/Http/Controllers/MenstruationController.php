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
            $latestRecord = Menstruation::latest()->first();
            
            return Inertia::render('Menstruation/Index', [
                'latestRecord' => $latestRecord ? [
                    'id' => $latestRecord->id,
                    'start_date' => $latestRecord->start_date->format('Y年n月j日'),  // 日付フォーマットを指定
                    'end_date' => $latestRecord->end_date ? $latestRecord->end_date->format('Y年n月j日') : null,
                ] : null
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
