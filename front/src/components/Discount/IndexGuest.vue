<template>
  <v-row>
    <v-col lg="6" offset-lg="3" md="8" offset-md="2" cols="12">
      <v-row v-for="row in discounts" :key="row.id">
        <v-col cols="6">
          <v-img aspect-ratio="1.6" :src="img(row.image)"></v-img>
        </v-col>
        <v-col cols="6">
          <div class="t6">{{ row.title }}</div>
          <div v-html="row.text"></div>
          <div>
            <v-btn color="#279e03" large outlined>Использовать</v-btn>
          </div>
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
  computed: {
    ...mapState({
      discounts: state => state.discount.allDiscounts
    })
  }
}
</script>

<style></style>
