<template>
  <v-row>
    <v-col
      lg="6"
      offset-lg="3"
      md="8"
      offset-md="2"
      cols="12"
      class="pa-12"
      style="min-height: 90vh"
    >
      <v-row>
        <v-card>
          <v-card-title>
            <v-col
              md="4"
              cols="12"
              v-for="(image, index) in images"
              :key="index"
            >
              <v-card flat tile class="d-flex">
                <v-img
                  class="img-galery"
                  width="200"
                  height="200"
                  cover
                  aspect-ratio="1"
                  :src="img(image.name)"
                >
                  <template v-slot:placeholder>
                    <v-row
                      class="fill-height ma-0"
                      align="center"
                      justify="center"
                    >
                      <v-progress-circular
                        indeterminate
                        color="grey lighten-5"
                      ></v-progress-circular>
                    </v-row>
                  </template>
                </v-img>
              </v-card>
            </v-col>
          </v-card-title>
        </v-card>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import imageMix from '../mixins/image'
export default {
  mixins: [imageMix],
  data: () => ({
    images: [
      { name: 'Chrysanthemum.jpg' },
      { name: 'Jellyfish.jpg' },
      { name: 'Hydrangeas.jpg' },
      { name: 'Desert.jpg' },
      { name: 'Koala.jpg' },
      { name: 'Lighthouse.jpg' },
      { name: 'Penguins.jpg' },
      { name: 'Tulips.jpg' }
    ]
  })
}
</script>

<style></style>
