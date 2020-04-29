<template>
  <v-row>
    <v-col lg="6" offset-lg="3" md="8" offset-md="2" cols="12" v-if="item">
      <v-row>
        <v-col cols="12">
          <v-img aspect-ratio="1.6" :src="img(item.image)"></v-img>
        </v-col>
        <v-col cols="12">
          <div class="t6">{{ item.title }}</div>
          <div v-html="item.text"></div>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import { mapState } from 'vuex'
import imageMix from '../../mixins/image'
export default {
  mixins: [imageMix],
  props: ['id'],
  computed: {
    ...mapGetters(['getDiscountById']),
    item() {
      return this.getDiscountById(this.id)
    }
  }
}
</script>

<style></style>
