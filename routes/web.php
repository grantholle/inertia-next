<?php

use App\Models\User;
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
        'list' => Inertia::lazy(fn () => \Illuminate\Support\Collection::times(fake()->numberBetween(5, 20))
                ->map(fn () => Str::uuid()->toString())
                ->toArray()
            ),
        'value' => Str::uuid()->toString(),
    ]);
})->name('lazy');
