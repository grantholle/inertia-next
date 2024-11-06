<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;












Route::get('/', function () {
    return Inertia::render('Index', [
        'user' => User::query()
            ->inRandomOrder()
            ->first(),
    ]);
})->name('home');











Route::get('/lazy', function () {
    return Inertia::render('Lazy', [
        'list' => Inertia::lazy(fn () => Collection::times(fake()->numberBetween(5, 20))
                ->map(fn () => Str::uuid()->toString())
                ->toArray()
            ),
        'value' => Str::uuid()->toString(),
    ]);
})->name('lazy');













Route::get('/deferred', function () {
    return Inertia::render('Deferred', [
        'user' => User::query()
            ->inRandomOrder()
            ->first(),
        'expensiveData' => Inertia::defer(function () {
            sleep(3);

            return Collection::times(fake()->numberBetween(5, 20))
                ->map(fn () => Str::uuid()->toString())
                ->toArray();
        }),
    ]);
})->name('deferred');















Route::get('/polling', function () {
    return Inertia::render('Polling', [
        'time' => now()->toDateTimeString(),
        'user' => User::query()
            ->inRandomOrder()
            ->first(),
    ]);
})->name('polling');




















Route::get('/prefetch', function () {
    return Inertia::render('Prefetch', [
        'dataList' => Collection::times(fake()->numberBetween(5, 20))
            ->map(fn () => Str::uuid()->toString())
            ->toArray(),
    ]);
})->name('prefetch');




















Route::get('/when-visible', function () {
    return Inertia::render('WhenVisible', [
        'alwaysLoad' => Str::uuid()->toString(),
        'listOne' => Inertia::lazy(function () {
            return Collection::times(fake()->numberBetween(5, 20))
                ->map(fn () => Str::uuid()->toString())
                ->toArray();
        }),
        'listTwo' => Inertia::lazy(function () {
            sleep(fake()->numberBetween(1, 4));

            return Collection::times(fake()->numberBetween(5, 20))
                ->map(fn () => Str::uuid()->toString())
                ->toArray();
        }),
    ]);
})->name('when-visible');





















Route::get('/merge', function (Request $request) {
    $page = (int) $request->input('page', 1);

    return Inertia::render('Merge', [
        'page' => $page,
        'users' => Inertia::defer(fn () => User::query()
            ->orderBy('id')
            ->limit(1)
            ->offset($page - 1)
            ->get()
            ->map(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ])
        )->merge(),
    ]);
})->name('merge');











Route::get('/infinite-scroll', function (Request $request) {
    $page = (int) $request->input('page', 1);
    $perPage = 15;

    return Inertia::render('InfiniteScroll', [
        'page' => $page,
        'users' => Inertia::merge(fn () => User::query()
            ->limit($perPage)
            ->offset(($page - 1) * $perPage)
            ->orderBy('id')
            ->get()
            ->map(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ])
        ),
    ]);
})->name('infinite-scroll');
