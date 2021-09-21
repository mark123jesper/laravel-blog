<template>
    <v-container>
        <v-card>
            <v-card-title>
                <div>
                    <div class="headline">
                        {{ data.title }}
                    </div>
                </div>
                <v-spacer></v-spacer>
                <v-btn color="light-grey"
                    >{{ replyCount }}
                    {{ replyCount > 1 ? "Replies" : "Reply" }}</v-btn
                >
            </v-card-title>
            <v-card-subtitle class="grey--text"
                >{{ data.user }} posted {{ data.created_at }}</v-card-subtitle
            >

            <v-card-text v-html="body" style="font-size:18px"> </v-card-text>
            <v-spacer></v-spacer>
            <v-card-actions v-if="own">
                <v-btn icon small>
                    <v-icon color="orange" v-on:click="edit">edit</v-icon>
                </v-btn>
                <v-btn icon small v-on:click="destroy">
                    <v-icon color="red">delete</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
export default {
    methods: {
        destroy() {
            // axios.get(`/api/question/${this.$route.params.slug}`)
            axios
                .delete(`/api/question/${this.data.slug}`)
                .then(response => this.$router.push("/forum"))
                .catch(error => console.error(error));
        },
        edit() {
            EventBus.$emit("startEditing");
        }
    },
    created() {
        EventBus.$on("newReply", () => {
            this.replyCount++;
        });

        EventBus.$on("deleteReply", () => {
            this.replyCount--;
        });

        Echo.private("App.Models.User." + User.getId()).notification(
            notification => {
                this.replyCount++;
            }
        );

        Echo.channel("DeleteReplyChannel").listen("DeleteReplyEvent", () => {
            this.replyCount--;
        });
    },
    data() {
        return {
            own: User.own(this.data.user_id),
            replyCount: this.data.replies_count
        };
    },
    computed: {
        body() {
            return md.parse(this.data.body);
        }
    },
    props: ["data"]
};
</script>

<style></style>
