<template>
    <v-container>
        <vue-simplemde v-model="reply.body" />
        <v-card-actions>
            <v-btn icon small v-on:click="update">
                <v-icon color="orange">
                    save
                </v-icon>
            </v-btn>
            <v-btn icon small v-on:click="cancel">
                <v-icon color="red">
                    cancel
                </v-icon>
            </v-btn>
        </v-card-actions>
    </v-container>
</template>

<script>
export default {
    name: "EditReply",
    props: ["reply"],
    methods: {
        cancel(reply) {
            EventBus.$emit("cancelEditing", reply);
        },
        // success() {
        //     EventBus.$emit("sucessEditing")
        // },
        update() {
            axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`, {body: this.reply.body})
            .then(response => this.cancel(this.reply.body));
        },
    }
};
</script>

<style>
@import "simplemde/dist/simplemde.min.css";
</style>
