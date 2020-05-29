<template>
  <v-card class="v-application h100">
    <div class="w100 d-flex flex-column  h100">
      <v-card-text class="flex-grow-1 d-flex my-0 pl-0 py-0">
        <v-img src="~@/assets/img/joma-map.webp" aspect-ratio="1.6" class="map">
          <div class="d-flex pa-12">
            <v-spacer></v-spacer>
            <v-btn fab color="orange" dark class="mr-3" @click="print">
              <v-icon>mdi-printer</v-icon>
            </v-btn>
            <v-btn fab color="primary" @click="$emit('close')">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </div>
        </v-img>
      </v-card-text>
    </div>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    center: { lat: 55.800112, lng: 37.714591 }
  }),
  methods: {
    print() {
      window.open('/print_address', '_blank')
    }
  }
}
</script>
