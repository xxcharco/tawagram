<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => function () use ($request) {
                // Ziggyクラスを使用せずにルート情報を共有
                return [
                    'url' => $request->url(),
                    'port' => $request->getPort(),
                    'defaults' => [],
                    'routes' => [],
                ];
            },
        ]);
    }
}