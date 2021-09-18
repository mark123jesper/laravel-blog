<template>
    <v-container>
        <v-card>
        <v-form v-on:submit="submit">
            <v-container>
                <v-row>
                    <v-col cols="12" md="12">
                        <v-text-field
                            v-model="form.title"
                            type="email"
                            required
                        >
                            <template #label>
                                <span class="red--text"
                                    ><strong>* </strong></span
                                >Title
                            </template>
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row align="center">
                    <v-col cols="12">
                        <v-select
                            :items="categories"
                            item-text="name"
                            item-value="id"
                            v-model="form.category_id"
                            label="Category"
                            autocomplete
                        ></v-select>
                    </v-col>
                </v-row>
                <vue-easymde v-model="form.body"/>
                <v-btn color="green" type="submit">
                    Ask Question
                </v-btn>
            </v-container>
        </v-form>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "AskQuestion",
    data() {
        return {
            form: {
                title: null,
                category_id: null,
                body: null,
            },
            categories: [],
            errors: {},
        };
    },
    methods: {
        submit(e) {
            e.preventDefault();
            axios.post("api/question", this.form)
            .then(response => this.$router.push(response.data.path))
            .catch(error => this.errors = error.response.data.error);
        }
    },
    created() {
        axios
            .get("api/category")
            .then(response => (this.categories = response.data.data))
            .catch(error => console.error(error));
    }
};
</script>

<style>
/* SimpleMde */
@import "~easymde/dist/easymde.min.css";
</style>
