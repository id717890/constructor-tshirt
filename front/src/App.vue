<template>
  <section>
    <router-view />
  </section>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  mounted() {
    this.$vuetify.lang.current = 'ru'
  },
  async created() {
    await this.getAllDiscounts()
  },
  methods: {
    ...mapActions(['getAllDiscounts'])
  }
}
</script>
