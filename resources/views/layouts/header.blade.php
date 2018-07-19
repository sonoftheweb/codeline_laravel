<v-toolbar color="primary" dark>
    <v-toolbar-side-icon></v-toolbar-side-icon>

    <v-toolbar-title class="white--text">@yield('title')</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn small flat href="/films/create">
        Add new film
    </v-btn>
</v-toolbar>