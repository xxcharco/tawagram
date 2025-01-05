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
            'flash' => [
                'message' => session('message')
            ],
            'ziggy' => function () use ($request) {
                return [
                    'url' => $request->url(),
                    'port' => $request->getPort(),
                    'defaults' => [],
                    'routes' => array_merge([
                        'login' => '/login',
                        'dashboard' => '/dashboard',
                        // 他のルートも必要に応じて追加
                    ], (array) $request->route()->getName()),
                ];
            },
        ]);
    }
}