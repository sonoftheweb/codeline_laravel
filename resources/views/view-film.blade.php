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
            <div class="caption mt-2 mb-2">{{ $film->genre }} | {{ \Carbon\Carbon::parse($film->release_date)->toDayDateTimeString() }} | {{ $film->rating }} of 5</div>
            <div class="body-2">
                {{ $film->description }}
            </div>
        </v-flex>
    </v-layout>

@endsection