<template>
    <v-container>
        <single-reply
            v-for="(reply, index) in content"
            :data="reply"
            :key="reply.id"
            :question="question"
            :index="index"
        >
        </single-reply>
    </v-container>
</template>

<script>
import SingleReply from "./SingleReply";
export default {
    components: { SingleReply },
    props: ["question"],
    data() {
        return {
            content: this.question.replies
        };
    },
    name: "Reply",
    created() {
        this.listen();
    },
    methods: {
        listen() {
            EventBus.$on("newReply", reply => {
                this.content.push(reply);
            });

            EventBus.$on("deleteReply", index => {
                axios
                    .delete(
                        `/api/question/${this.question.slug}/reply/${this.content[index].id}`
                    )
                    .then(response => {
                        this.content.splice(index, 1);
                    })
                    .catch(error => console.error(error));
            });

            Echo.private("App.Models.User." + User.getId()).notification(
                notification => {
                    this.content.push( notification.reply);
                }
            );

            Echo.channel("DeleteReplyChannel")
            .listen('DeleteReplyEvent', (e) => {
                for(let index=0; index<this.content.length; index++){
                    if(this.content[index].id == e.id){
                        this.content.splice(index,1)
                    }
                }
            });
        }
    }
};
</script>

<style></style>
