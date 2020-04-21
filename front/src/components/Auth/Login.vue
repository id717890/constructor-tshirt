<template>
  <v-app id="app" dark style="background: white">
    <v-container fill-height>
      <v-row>
        <v-col cols="12" lg="6" offset-lg="3" md="8" offset-md="2" sm="12">
          <v-form lazy-validation v-model="form.valid" ref="form">
            <v-text-field
              label="E-mail"
              v-model="form.email"
              required
              :rules="emailRules"
            ></v-text-field>
            <v-text-field
              label="Пароль"
              type="password"
              v-model="form.password"
              required
              :rules="passwordRules"
            ></v-text-field>
          </v-form>
        </v-col>
        <v-col cols="12" lg="6" offset-lg="3" md="8" offset-md="2" sm="12">
          <v-btn large color="success" outlined class="px-10 mr-5" tile to="/">
            <v-icon>mdi-arrow-left</v-icon>
            Назад</v-btn
          >
          <v-btn
            large
            color="success"
            class="px-10"
            tile
            @click="signin"
            :disabled="!form.valid"
            :loading="loading"
          >
            <v-icon>mdi-login</v-icon>
            Вход</v-btn
          >
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data() {
    return {
      loading: false,
      form: {
        valid: true,
        email: 'info@joma-club.ru',
        password: 'qweqwe'
      },
      emailRules: [
        v => !!v || 'E-mail required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ],
      passwordRules: [v => !!v || 'Password required']
    }
  },
  computed: {},
  mounted() {},
  methods: {
    ...mapActions(['signUserIn']),
    signin(e) {
      this.loading = true
      e.preventDefault()
      if (this.$refs.form.validate()) {
        this.signUserIn(this.form)
          .then(() => {
            if (this.isAdmin === true) {
              this.$router.push('/dashboard')
            } else {
              this.$router.push('/lk')
            }
          })
          .catch(x => {
            this.loading = false
          })
      } else this.loading = false
    }
  }
}
</script>

<style></style>
