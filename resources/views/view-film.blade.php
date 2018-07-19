@extends('layouts.layout')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <v-layout row wrap>
        <v-flex md4 sm12 xs12>
            <v-card flat>
                <img class="fill" src="{{ $film->photo }}" alt="{{ $film->name }}">
            </v-card>
        </v-flex>
        <v-flex md8 sm12 xs12 class="pa-4">
            <h3 class="display-2">{{ $film->name }}</h3>
            <div class="caption mt-2 mb-2">Genre: {{ $film->genre }} | Date released: {{ \Carbon\Carbon::parse($film->release_date)->toDayDateTimeString() }} | Rating: {{ $film->rating }} of 5 | Country: {{ $film->country }} of 5</div>
            <div class="body-2">
                {!! nl2br($film->description) !!}
            </div>
            <div class="title mt-3">Ticket Price: {{ $film->ticket_price }}</div>
        </v-flex>
    </v-layout>

    <v-layout row>

    </v-layout>

@endsection