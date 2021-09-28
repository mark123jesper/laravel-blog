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
                    <vue-easymde v-model="form.body" />

                    <v-card-actions>
                        <v-btn icon type="submit">
                            <v-icon color="teal">
                                save
                            </v-icon>
                        </v-btn>

                        <v-btn icon v-on:click="cancel">
                            <v-icon color="orange">
                                cancel
                            </v-icon>
                        </v-btn>
                    </v-card-actions>
                </v-container>
            </v-form>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "EditQuestion",
    props: ['data'],
    data() {
        return {
            form: {
                title: null,
                body: null
            }
        };
    },
    mounted(){
        this.form = this.data
    },
    methods: {
        submit(e) {
            e.preventDefault();
            axios.patch(`/api/question/${this.data.slug}`, this.form)
            .then(response => this.cancel())
            .catch(error => console.error(error))
        },
        cancel() {
            EventBus.$emit('cancelEditing')
        }
    },
};
</script>

<style></style>
