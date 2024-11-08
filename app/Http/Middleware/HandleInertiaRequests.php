<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Middleware;
use Inertia\Support\Header;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'links' => fn () => [
                [
                    'href' => route('home'),
                    'current' => $request->routeIs('home'),
                    'text' => 'Regular props',
                ],
                [
                    'href' => route('lazy'),
                    'current' => $request->routeIs('lazy'),
                    'text' => 'Lazy props',
                ],
                [
                    'href' => route('deferred'),
                    'current' => $request->routeIs('deferred'),
                    'text' => 'Deferred props',
                ],
                [
                    'href' => route('polling'),
                    'current' => $request->routeIs('polling'),
                    'text' => 'Polling props',
                ],
                [
                    'href' => route('prefetch'),
                    'current' => $request->routeIs('prefetch'),
                    'text' => 'Prefetch',
                    'prefetch' => true,
                ],
                [
                    'href' => route('when-visible'),
                    'current' => $request->routeIs('when-visible'),
                    'text' => 'When visible',
                ],
                [
                    'href' => route('merge'),
                    'current' => $request->routeIs('merge'),
                    'text' => 'Merge props',
                ],
                [
                    'href' => route('infinite-scroll'),
                    'current' => $request->routeIs('infinite-scroll'),
                    'text' => 'Infinite scroll',
                ],
            ],
        ]);
    }
}
