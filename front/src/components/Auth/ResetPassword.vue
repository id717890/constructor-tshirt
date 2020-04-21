<template>
  <v-app id="app" dark style="background: white">
    <v-container fill-height>
      <v-row>
        <v-col
          v-if="loading"
          cols="12"
          lg="6"
          offset-lg="3"
          md="8"
          offset-md="2"
          sm="12"
          class="text-center"
        >
          <v-progress-circular
            size="100"
            width="15"
            indeterminate
            color="primary"
          ></v-progress-circular>
          <h4 class="mt-6">Идет сброс пароля</h4>
        </v-col>
        <v-col
          v-if="!loading"
          cols="12"
          lg="6"
          offset-lg="3"
          md="8"
          offset-md="2"
          sm="12"
          class="text-center"
        >
          <v-alert color="success" dark>Пароль сброшен</v-alert>
          <v-btn to="/" large color="primary">
            <v-icon>mdi-home</v-icon>
            На главную
          </v-btn>
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
      loading: true
    }
  },
  computed: {},
  mounted() {
    this.resetPassword().then(x => {
      console.log(x)
      this.loading = false
    })
  },
  methods: {
    ...mapActions(['resetPassword'])
  }
}
</script>

<style></style>
