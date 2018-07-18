<v-toolbar
        color="primary"
        dark
        extended
>
    <v-toolbar-side-icon></v-toolbar-side-icon>

    <v-toolbar-title slot="extension" class="white--text">@yield('title')</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn icon>
        <v-icon>search</v-icon>
    </v-btn>

    <v-btn icon>
        <v-icon>apps</v-icon>
    </v-btn>

    <v-btn icon>
        <v-icon>refresh</v-icon>
    </v-btn>

    <v-btn icon>
        <v-icon>more_vert</v-icon>
    </v-btn>
</v-toolbar>