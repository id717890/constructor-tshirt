<template>
  <section>
    <modals-container />
    <transition name="router-fade" mode="out-in">
      <router-view />
    </transition>
  </section>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  mounted() {
    this.$vuetify.lang.current = 'ru'
  },
  async created() {
    await this.getAllConfigs()
    await this.getAllHomeSlides()
    await this.getAllDiscounts()
    await this.getAllNews()
    await this.getAllPages()
  },
  methods: {
    ...mapActions([
      'getAllConfigs',
      'getAllDiscounts',
      'getAllNews',
      'getAllPages',
      'getAllHomeSlides'
    ])
  }
}
</script>
