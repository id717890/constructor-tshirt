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
    </v-col>
  </v-row>
</template>

<script>
import HomeSlider from './HomeSlider'
import HomeDiscount from './HomeDiscount'
export default {
  components: {
    HomeSlider,
    HomeDiscount
  }
}
</script>
