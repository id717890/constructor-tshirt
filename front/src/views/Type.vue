<template>
  <v-row>
    <v-col cols="12"> </v-col>
  </v-row>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  methods: {
    ...mapActions(['getAllTypes'])
  },
  async mounted() {
    await this.getAllTypes()
  }
}
</script>
