<template>
    <v-container>
        <v-btn icon small v-on:click="likeIt">
            <v-icon :color="color">favorite</v-icon>
        </v-btn>
        <span class="subtitle-2">
            {{ count }} {{ count > 1 ? "Likes" : "Like" }}
        </span>
    </v-container>
</template>

<script>
export default {
    name: "Like",
    props: ["content"],
    data() {
        return {
            liked: this.content.liked,
            count: this.content.like_count
        };
    },
    computed: {
        color() {
            return this.liked ? "red" : "red lighten-4";
        }
    },
    methods: {
        likeIt() {
            if (User.loggedIn()) {
                this.liked ? this.decr() : this.incr();
                this.liked = !this.liked;
            }
        },
        incr() {
            axios
                .post(`/api/like/${this.content.id}`)
                .then(response => this.count++)
                .catch(error => console.error(error));
        },
        decr() {
            axios
                .delete(`/api/like/${this.content.id}`)
                .then(response => this.count--)
                .catch(error => console.error(error));
        }
    },
    created() {
        Echo.channel(`LikeChannel`).listen(
            "LikeEvent",
            e => {
                if(this.content.id == e.id) {
                    e.type == 1 ? this.count++ : this.count--
                }
            }
        );
    }
};
</script>

<style></style>
