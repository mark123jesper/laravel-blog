<template>
    <v-app-bar color="light-grey">
        <router-link to="/" style="text-decoration: none; color: inherit;">
            <v-toolbar-title>
                Chainlink
            </v-toolbar-title>
        </router-link>
        <v-spacer></v-spacer>
        <app-notification v-if="loggedIn"> </app-notification>
        <div>
            <!-- class="hidden-sm-and-down" -->
            <router-link
                v-for="item in items"
                :key="item.title"
                :to="item.to"
                v-if="item.show"
                style="text-decoration: none; color: inherit;"
            >
                <v-btn text>{{ item.title }}</v-btn>
            </router-link>
        </div>
        <v-avatar :color="`#${Math.floor(Math.random() * 0xFFFFFF)}`" size="44" v-if="getUserName()">{{ userName }}</v-avatar>
    </v-app-bar>
</template>

<script>
import AppNotification from "./AppNotification.vue";
export default {
    components: { AppNotification },
    data() {
        return {
            drawer: null,
            toggleMenu: false,
            items: [
                { title: "Forum", to: "/forum", show: true },
                { title: "Ask Question", to: "/ask", show: User.hasToken() },
                { title: "Category", to: "/category", show: User.admin() },
                { title: "Login", to: "/login", show: !User.hasToken() },
                { title: "Logout", to: "/logout", show: User.hasToken() }
            ],
            loggedIn: User.loggedIn(),
            userName: this.getUserName()
        };
    },
    created() {
        EventBus.$on("logout", () => {
            User.loggedOut();
        });
    },
    methods: {
        getUserName() {
            if(User.loggedIn()){
                return User.getName()
                .split(" ")
                .map(s => s[0].toUpperCase())
                .join("")
            }
            return false
        }
    }
};
</script>

<style></style>
