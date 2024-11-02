<?php

use App\Models\User;
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
