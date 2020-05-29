<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Настройка главой страницы
      </h2>
    </v-col>
    <v-col cols="12">
      <home-slider />
      <home-discount />
      <home-block4 />
      <home-partner />
    </v-col>
  </v-row>
</template>

<script>
import HomeSlider from './HomeSlider'
import HomeDiscount from './HomeDiscount'
import HomePartner from './HomePartner'
import HomeBlock4 from './HomeBlock4'
export default {
  components: {
    HomeSlider,
    HomeDiscount,
    HomePartner,
    HomeBlock4
  }
}
</script>
