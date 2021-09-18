<template>
<router-link :to="data.path" style="text-decoration: none; color: inherit;">
  <v-card
    class="mx-auto mb-5"
  >
      <v-card-title>
          {{data.title}}
      </v-card-title>
    </v-img>

    <v-card-subtitle class="pb-0">
        {{data.user}} posted
        {{data.created_at}}
    </v-card-subtitle>

    <v-card-text class="text--primary">
      <div>{{data.body}}</div>
    </v-card-text>
  </v-card>
  </router-link>
</template>

<script>
export default {
    name: 'Question',
    props: ['data'],
};
</script>

<style>
</style>
