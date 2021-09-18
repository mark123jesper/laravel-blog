<template>
  <v-toolbar color="light-grey">
    <v-toolbar-title>
      Chainlinked
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <div class="hidden-sm-and-down">
      <router-link
      v-for="item in items"
      :key="item.title"
      :to="item.to"
      v-if="item.show"
      >
        <v-btn text>{{item.title}}</v-btn>
      </router-link>
    </div>
  </v-toolbar>
</template>

<script>
export default {
    data(){
        return{
            items: [
                {title: "Forum", to: "/forum", show:true},
                {title: "Ask Question", to: "/ask", show: User.hasToken()},
                {title: "Category", to: "/category", show: User.hasToken()},
                {title: "Login", to: "/login", show: !User.hasToken()},
                {title: "Logout", to: "/logout", show: User.hasToken()},
            ]
        }
    },
    created(){
        EventBus.$on('logout', () => {
            User.loggedOut();
        })
    },
}
</script>

<style>
</style>


