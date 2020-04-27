<template>
  <v-row no-gutters>
    <v-col cols="12" class="pa-0">
      <v-row>
        <v-col md="8" offset-md="2" cols="12" class="pa-0 pt-1">
          <v-carousel height="290" hide-delimiters>
            <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item>
            <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item>
            <v-carousel-item src="~@/assets/img/slider-img.jpg">
            </v-carousel-item>
          </v-carousel>
        </v-col>
      </v-row>
      <v-row>
        <v-col md="8" offset-md="2" cols="12" class="pa-0 pt-1">
          <v-row>
            <v-col md="6" cols="12" class="b1">
              <v-row>
                <v-col cols="6" class="py-0 pr-1">
                  <v-img
                    aspect-ratio="1.6"
                    src="~@/assets/img/konkurs-img.jpg"
                    height="100%"
                  ></v-img>
                </v-col>
                <v-col cols="6" class=" d-flex flex-column py-0">
                  <v-row>
                    <v-col cols="12" class="py-0 pl-0">
                      <!-- <img
                        src="~@/assets/img/konkurs-img2.jpg"
                        alt=""
                        style="height: 100%"
                      /> -->
                      <v-img
                        aspect-ratio="1.6"
                        height="auto"
                        src="~@/assets/img/konkurs-img2.jpg"
                      ></v-img>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="12" class="py-0 pl-0 ">
                      <!-- <img
                        src="~@/assets/img/konkurs-img2.jpg"
                        alt=""
                        style="height: 100%"
                      /> -->

                      <v-img
                        aspect-ratio="1.6"
                        height="auto"
                        src="~@/assets/img/konkurs-img2.jpg"
                      ></v-img>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-col>
            <v-col md="6" cols="12">2 </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
export default {}
</script>

<style></style>
