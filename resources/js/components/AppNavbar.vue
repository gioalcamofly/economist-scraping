<template>
        <v-app-bar
            app
            dark
            clipped-left
            id="app-bar"
        >
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        
        <v-toolbar-title>Economist scraping</v-toolbar-title>

        <v-spacer></v-spacer>
        <v-col sm="1" class="text-right">
            <right-navbar
                :url-login="login"
                :url-logout="logout"
                :url-register="register"
                :user="user"
            />
        </v-col>
        </v-app-bar>
</template>

<script>

    export default {
        props: {
            login: {
                type: String,
                required: true,
            },
            logout: {
                type: String,
                required: true,
            },
            register: {
                type: String,
                required: false,
            },
            user: {
                type: String,
                required: true,
            }
        }
    }
</script>
