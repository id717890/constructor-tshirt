<template>
  <v-row>
    <v-col md="10" offset-md="1" sm="12" cols="12" style="min-height: 90vh">
      <v-card height="100%" flat v-if="about">
        <v-card-title>
          <h3>{{ about.title }}</h3>
        </v-card-title>
        <v-card-text class="title page" v-html="about.content"> </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  data: () => ({
    aboutId: 1
  }),
  computed: {
    ...mapGetters(['getPageById']),
    about() {
      return this.getPageById(this.aboutId)
    }
  }
}
</script>

<style></style>
