<template>
    <v-container>
        <v-alert v-if="errors" color="red" type="error">
            Category Name is required
        </v-alert>
        <v-card>
            <v-container>
                <v-form v-on:submit="submit">
                    <v-row>
                        <v-col cols="12" md="12">
                            <v-text-field
                                v-model="form.name"
                                type="text"
                                required
                            >
                                <template #label>
                                    <span class="red--text"
                                        ><strong>* </strong></span
                                    >Category
                                </template>
                            </v-text-field>
                        </v-col>
                    </v-row>
                    <v-btn
                        v-if="editSlug"
                        color="orange"
                        type="submit"
                        :disabled="disabled"
                    >
                        Update
                    </v-btn>
                    <v-btn
                        v-else
                        color="green"
                        type="submit"
                        :disabled="disabled"
                    >
                        Create
                    </v-btn>
                </v-form>
            </v-container>

            <v-container>
                <v-card>
                    <v-toolbar color="cyan" dark dense>
                        <v-toolbar-title>Categories</v-toolbar-title>
                    </v-toolbar>
                    <v-list>
                        <div
                            v-for="(category, index) in categories"
                            :key="category.id"
                        >
                            <v-list-item>
                                <v-list-item-action>
                                    <v-btn icon small v-on:click="edit(index)">
                                        <v-icon color="orange">
                                            edit
                                        </v-icon>
                                    </v-btn>
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        {{ category.name }}
                                    </v-list-item-title>
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-btn
                                        icon
                                        small
                                        v-on:click="
                                            destroy(category.slug, index)
                                        "
                                    >
                                        <v-icon color="red">
                                            delete
                                        </v-icon>
                                    </v-btn>
                                </v-list-item-action>
                            </v-list-item>
                            <v-divider></v-divider>
                        </div>
                    </v-list>
                </v-card>
            </v-container>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "CreateCategory",
    created() {
        //
        if (!User.loggedIn() || !User.admin()) {
            this.$router.push({ name: "forum" });
        }
        axios
            .get("api/category")
            .then(response => (this.categories = response.data.data));
    },
    data() {
        return {
            form: {
                name: null
            },
            categories: {},
            editSlug: null,
            errors: null
        };
    },
    methods: {
        submit(e) {
            e.preventDefault();
            if (confirm("Create this Category?")) {
                if (this.editSlug) {
                    this.update();
                } else {
                    this.create();
                }
            }
            return;
        },
        destroy(slug, index) {
            if (confirm("Delete this Category?")) {
                axios
                    .delete(`api/category/${slug}`)
                    .then(response => this.categories.splice(index, 1));
            }
            return;
        },
        edit(index) {
            window.scrollTo({ top: 0, behavior: "smooth" });
            this.form.name = this.categories[index].name;
            this.editSlug = this.categories[index].slug;
            this.categories.splice(index, 1);
        },
        create() {
            axios
                .post("api/category", this.form)
                .then(response => {
                    this.categories.unshift(response.data);
                    this.form.name = null;
                })
                .catch(
                    error => (this.errors = error.response.data.errors.name)
                );
        },
        update() {
            axios
                .patch(`api/category/${this.editSlug}`, this.form)
                .then(response => {
                    this.categories.unshift(response.data);
                    this.form.name = null;
                })
                .catch(error => console.error(error));
        }
    },
    computed: {
        disabled() {
            return !this.form.name;
        }
    }
};
</script>

<style></style>
