<template>
  <v-card class="v-application h100">
    <div class="w100 d-flex flex-column  h100">
      <!-- <v-card-title class="px-8">
        <v-spacer></v-spacer>
        <v-btn outlined fab color="primary" @click="$emit('close')">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title> -->
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
      <!-- <v-card-actions class="px-8">
        <v-spacer></v-spacer>
        <v-btn outlined fab color="primary" @click="$emit('close')">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-actions> -->
    </div>
  </v-card>
</template>

<script>
import context from '../../api/api'
export default {
  data: () => ({
    center: { lat: 55.800112, lng: 37.714591 },
    markers: [],
    places: [],
    currentPlace: null,
    loading: false,
    form: {
      valid: true,
      name: '',
      phone: ''
    },
    textField: [v => !!v || 'Обязательное поле']
  }),
  mounted() {
    console.log('mounted')
    this.geolocate()
  },
  methods: {
    print() {
      window.open('/print_address', '_blank')
    },
    // receives a place object via the autocomplete component
    setPlace(place) {
      this.currentPlace = place
    },
    addMarker() {
      if (this.currentPlace) {
        const marker = {
          lat: this.currentPlace.geometry.location.lat(),
          lng: this.currentPlace.geometry.location.lng()
        }
        this.markers.push({ position: marker })
        this.places.push(this.currentPlace)
        this.center = marker
        this.currentPlace = null
      }
    },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        }
      })
    },
    sendForm() {
      if (this.$refs.form.validate()) {
        this.loading = true
        context
          .post('api/callback/callme', this.form)
          .then(x => {
            this.loading = false
            this.$refs.form.reset()
            this.$emit('close')
          })
          .catch(x => {
            console.log(x)
            this.loading = false
          })
      }
    }
  }
}
</script>
