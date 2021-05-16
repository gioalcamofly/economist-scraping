<template>
    <v-row>
        <v-row align="center" v-if="parsedUser">
            <v-btn
                v-if="isLogin"
                small
                text
                @click="logout($event)"
                style="text-decoration: none"
            >
                Logout
            </v-btn>
        </v-row>
        <v-row v-else>
            <v-btn
                v-if="isLogin"
                small
                text
                :href="urlLogin"
                style="text-decoration: none"
            >
                Login
            </v-btn>
            <v-btn
                v-else
                small
                text
                :href="urlRegister"
                style="text-decoration: none"
            >
                Register
            </v-btn>
        </v-row>
    </v-row>
</template>
<script>

    export default {
        props: {
            urlLogin: {
                type: String,
                required: true
            },
            urlLogout: {
                type: String,
                required: true,
            },
            urlRegister: {
                type: String,
                required: false,
            },
            user: {
                type: String,
                required: true,
            }
        },

        computed: {
            parsedUser : function() {
                let user = this.user.trim();
                return user ? JSON.parse(user) : null;
            },

            isLogin: function() {
                return window.location.pathname != '/login';
            }
        },

        methods: {

            logout(event) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            },
        }
    }
</script>
