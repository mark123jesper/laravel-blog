<template>
    <v-card class="mb-1">
        <div>
            <v-card-title>
                {{ data.user }}
            </v-card-title>
            <v-card-subtitle> replied {{ data.created_at }} </v-card-subtitle>
        </div>

        <edit-reply v-if="editing" :reply="data"></edit-reply>
        <v-card-text v-else v-html="body"></v-card-text>

        <v-divider></v-divider>
        <div v-if="!editing">
            <v-card-actions v-if="own">
                <v-btn icon small v-on:click="edit">
                    <v-icon color="orange">
                        edit
                    </v-icon>
                </v-btn>
                <v-btn icon small v-on:click="destroy">
                    <v-icon color="red">
                        delete
                    </v-icon>
                </v-btn>
            </v-card-actions>
            <div class="ms-4">
                <like :content="data"/>
            </div>
        </div>
    </v-card>
</template>

<script>
import EditReply from "./EditReply";
import Like from "../Like/Like";
export default {
    components: { EditReply, Like },
    name: "SingleReply",
    props: ["data", "index", "question"],
    data() {
        return {
            editing: false,
            beforeEditReplyBody: ""
        };
    },
    computed: {
        own() {
            return User.own(this.data.user_id);
        },
        body() {
            return md.parse(this.data.body);
        }
    },
    methods: {
        destroy() {
            EventBus.$emit("deleteReply", this.index);
        },
        edit() {
            this.editing = true;
            this.beforeEditReplyBody = this.question.replies[this.index].body;
        },
        listen() {
            EventBus.$on("cancelEditing", reply => {
                this.editing = false;
                if (reply !== this.question.replies[this.index].body) {
                    this.question.replies[
                        this.index
                    ].body = this.beforeEditReplyBody;
                    this.beforeEditReplyBody = "";
                }
            });
        }
    },
    created() {
        this.listen();
    }
};
</script>

<style></style>
