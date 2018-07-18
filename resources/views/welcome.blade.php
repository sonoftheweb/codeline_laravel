@extends('layouts.layout')

@section('title')
    All Films
@endsection

@section('content')

    <v-layout row>
        <v-flex>
            <v-card flat>
                <v-list two-line>
                    @foreach($films as $film)
                        <template>
                            <v-list-tile avatar ripple>
                                <v-list-tile-content>
                                    <v-list-tile-title>{{ $film->name }}</v-list-tile-title>
                                    <v-list-tile-sub-title class="text--primary">{{ $film->genre }}</v-list-tile-sub-title>
                                    <v-list-tile-sub-title>{{ \Carbon\Carbon::parse($film->release_date)->toDayDateTimeString() }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-divider></v-divider>
                        </template>
                    @endforeach
                </v-list>
            </v-card>
        </v-flex>
    </v-layout>

@endsection