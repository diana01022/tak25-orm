<?php

use App\Models\Author;
use Illuminate\Support\Facades\Route;
use App\Mail\Timetable;
use Illuminate\Support\Facades\Http;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tere', function () {
    $authors = Author::all();

    $authors->load('books.reviews', 'reviews');

    // $books = [];

    // foreach ($authors as $author) {
    //     $books = array_merge($books, $author->books->toArray());
    // }

    return view('tere', [
        'authors' => $authors,
    ]);
});

Route::get('/mailable', function () {
    $startDate = now()->startOfWeek();
    $endDate = now()->endOfWeek();

    $response = Http::get('https://tahveltp.edu.ee/hois_back/timetableevents/timetableSearch', [
        'from' => $startDate->toIsoString(),
        'lang' => 'ET',
        'page' => 0,
        'schoolId' => 38,
        'size' => 50,
        'studentGroups' => 'ea0550fb-8387-4aa2-880a-9abbd37a69ce',
        'thru' => $endDate->toIsoString(),
    ]);

    $data = $response->json();

    $timetableEvents = collect($data['content'])
        ->sortBy(['date', 'timeStart'])
        ->groupBy(function ($event) {
            return \Carbon\Carbon::parse($event['date'])->locale('et_EE')->dayName;
        });

    return new Timetable($timetableEvents, $startDate, $endDate);
});