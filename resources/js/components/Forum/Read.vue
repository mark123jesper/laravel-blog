<template>
    <div v-if="question">
        <edit-question v-if="editing" :data="question"> </edit-question>
        <show-question :data="question" v-else></show-question>

        <v-container>
            <reply v-if="question" :question="question"></reply>
            <new-reply
                :questionSlug="question.slug"
                v-if="loggedIn"
            ></new-reply>
            <v-card v-else class="text-center">
                <router-link to="/login">
                    <h4>Log in to reply and like</h4>
                </router-link>
            </v-card>
        </v-container>
    </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion";
import EditQuestion from "./EditQuestion";
import Reply from "../Reply/Reply";
import NewReply from "../Reply/NewReply";
export default {
    created() {
        this.listen();
        this.getQuestion();
    },
    methods: {
        listen() {
            EventBus.$on("startEditing", () => {
                this.editing = true;
            });

            EventBus.$on("cancelEditing", () => {
                this.editing = false;
            });
        },
        getQuestion() {
            axios
                .get(`/api/question/${this.$route.params.slug}`)
                .then(res => (this.question = res.data.data));
        }
    },
    components: { ShowQuestion, EditQuestion, Reply, NewReply },
    name: "Read",
    data() {
        return {
            question: null,
            editing: false
        };
    },
    computed: {
        loggedIn() {
            return User.loggedIn();
        }
    }
};
</script>

<style></style>
