<template>
  <v-container fluid>
    <h1>Sign up</h1>
    <v-form v-on:submit="signup">
    <v-container>
        <v-row>
            <v-col
                cols="12"
                md="6"
            >
            <v-text-field
                v-model="form.name"
                type="text"
                required
            >
            <template #label>
                <span class="red--text"><strong>* </strong></span>Full Name
            </template>
            </v-text-field>
            <span class="red--text" v-if="errors.name">{{errors.name[0]}}</span>
            </v-col>

            <v-col
          cols="12"
          md="6"
        >
          <v-text-field
            v-model="form.email"
            type="email"
            required
          >
        <template #label>
            <span class="red--text"><strong>* </strong></span>Email
        </template>
        </v-text-field>
        <span class="red--text" v-if="errors.email">{{errors.email[0]}}</span>
        </v-col>
        </v-row>

      <v-row>

          <v-col
          cols="12"
          md="6"
        >
          <v-text-field
            v-model="form.password"
            type="password"
            required
          >
            <template #label>
                <span class="red--text"><strong>* </strong></span>Password
            </template>
          </v-text-field>
          <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>
        </v-col>

         <v-col
          cols="12"
          md="6"
        >
          <v-text-field
            v-model="form.password_confirmation"
            type="password"
            required
          >
            <template #label>
                <span class="red--text"><strong>* </strong></span>Password
            </template>
          </v-text-field>
          <span class="red--text" v-if="errors.password">{{errors.password[0]}}</span>
        </v-col>
      </v-row>
      <v-btn
        color="green"
        type="submit"
      >
          Sign up
      </v-btn>
      <router-link to="/login">
        <v-btn text>Log in</v-btn>
      </router-link>
    </v-container>
  </v-form>
</v-container>
</template>

<script>
export default {
    name: 'Signup',
    data() {
        return {
            form: {
            name: null,
            email: null,
            password: null,
            password_confirmation: null
            },
            errors:{

            }
        }
    },
    methods: {
        signup(e){
            e.preventDefault();
            axios.post('api/auth/signup', this.form)
            .then(response => {
                User.loginResponse(response);
                this.$router.push({name: 'forum'});
            })
            .catch(error => this.errors = error.response.data.errors);
        }
    }
};
</script>

<style>
</style>
