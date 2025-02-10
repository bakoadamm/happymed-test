@extends('layouts.app')
@section('title', 'Filmek')
@section('content')
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Cím</th>
                <th>Műfaj</th>
                <th>Év</th>
                <th>Értékelés</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($movies as $movie)
            <tr class="@if($movie->rentals->isNotEmpty()) bg-red-100 @endif">
                <th>{{ $movie->id }}</th>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->genre }}</td>
                <td>{{ $movie->release_year }}</td>
                <td>{{ $movie->rating }}</td>
                <td>
                    <button class="btn" onclick="my_modal_{{ $movie->id }}.showModal()">
                        Foglalás
                    </button>
                </td>
            </tr>
            <dialog id="my_modal_{{ $movie->id }}" class="modal">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">{{ $movie->title }}</h3>
                    <p class="py-4">Biztosan lefoglalod a filmet?</p>
                    <div class="modal-action">
                        <form action="/rent" method="post">
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            <input class="input input-bordered w-full max-w-xs" type="text" name="customer_name" placeholder="Neved">
                            <button type="submit" class="btn">Foglalás</button>
                        </form>
                        <form method="dialog">
                            <button class="btn">Bezár</button>
                        </form>
                    </div>
                </div>
            </dialog>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
