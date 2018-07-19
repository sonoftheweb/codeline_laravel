@extends('layouts.layout')

@section('title')
    {{ $title }}
@endsection

@section('content')

    <v-layout row wrap>
        <v-flex xs4 offset-xs4>
            <v-card class="mt-5 mb-5 pa-3">
                {!! Form::open(['url' => '/films/create']) !!}
                    <v-card-title>
                        <div class="display-1">Add new film</div>
                    </v-card-title>
                    <v-card-text>
                            <div>Fill in the form to add new films</div>
                            <br>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <v-text-field outline label="Name" name="name"></v-text-field>
                            <v-textarea outline label="Description" name="description"></v-textarea>
                            <v-text-field mask="date-with-time" outline label="Release Date" name="release_date"></v-text-field>
                            <v-text-field outline label="Rating" name="rating"></v-text-field>
                            <v-text-field outline label="Ticket Price" name="ticket_price"></v-text-field>
                            <v-text-field outline label="Country" name="country"></v-text-field>
                            <v-text-field outline label="Genre" name="genre"></v-text-field>
                            <v-text-field outline label="Photo" name="photo"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="success" type="submit">Save</v-btn>
                    </v-card-actions>
                {!! Form::close() !!}
            </v-card>
        </v-flex>
    </v-layout>

    <v-layout row>

    </v-layout>

@endsection