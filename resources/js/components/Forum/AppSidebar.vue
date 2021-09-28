<template>
    <v-card>
        <router-link to="category" style="text-decoration: none; color: inherit;">
            <v-toolbar color="cyan" dark dense>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>
        </router-link>
        <v-list>
            <v-list-item v-for="category in categories" :key="category.id">
                <v-list-item-content>
                    <v-list-item-title>
                        {{ category.name }}
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            categories: {}
        };
    },
    created() {
        axios
            .get("api/category")
            .then(response => (this.categories = response.data.data));
    }
};
</script>

<style></style>
