<template>
  <v-row>
    <v-col
      lg="4"
      offset-lg="4"
      md="8"
      offset-md="2"
      cols="12"
      v-if="item"
      style="min-height: 100vh"
    >
      <v-row>
        <v-col cols="12">
          <v-img
            aspect-ratio="1.6"
            position="top center"
            :src="img(item.image)"
          ></v-img>
        </v-col>
        <v-col cols="12">
          <div class="t6">{{ item.title }}</div>
          <div v-html="item.text"></div>
          <v-btn color="primary" to="/news" outlined>
            <v-icon>mdi-arrow-left</v-icon>
            Назад
          </v-btn>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import imageMix from '../../mixins/image'
export default {
  mixins: [imageMix],
  props: ['id'],
  computed: {
    ...mapGetters(['getNewsById']),
    item() {
      return this.getNewsById(this.id)
    }
  }
}
</script>

<style></style>
