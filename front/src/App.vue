<template>
  <section>
    <router-view />
  </section>
</template>

<script>
export default {
  mounted() {
    this.$vuetify.lang.current = 'ru'
  }
}
</script>
