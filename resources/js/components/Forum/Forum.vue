<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex md3>
               <app-sidebar></app-sidebar>
            </v-flex>
            <v-flex md9>
               <question
               v-for="question in questions"
               :key="question.id"
               :data="question"
               ></question>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import Question from './Question';
import AppSidebar from './AppSidebar';
export default {
    components: { Question, AppSidebar },
    data() {
        return {
            questions: {

            }
        }
    },
    created() {
        axios.get("api/question")
        .then(response => this.questions = response.data.data)
        .catch(error => console.error(error))
    }
}
</script>

<style>
</style>
