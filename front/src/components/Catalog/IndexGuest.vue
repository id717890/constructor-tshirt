<template>
  <v-row>
    <v-col md="10" offset-md="1" cols="12">
      <v-card flat style="min-height: 60vh">
        <v-card-title>
          <h2>Каталоги</h2>
        </v-card-title>
        <v-card-text v-if="catalogs">
          <v-row class="catalog-grid">
            <v-col
              class="catalog-item"
              lg="3"
              md="4"
              sm="12"
              v-for="catalog in catalogs"
              :key="catalog.id"
            >
              <figure
                @click.prevent="downloadCatalog(catalog)"
                :style="{
                  backgroundImage: `url('${img(catalog.image)}')`,
                  height: '300px'
                }"
              >
                <figcaption>
                  <h2>{{ catalog.name }}</h2>
                  <p></p>
                </figcaption>
              </figure>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-text v-else>
          <h4>Данные отсутствуют.</h4>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import imageMixin from '@/mixins/image'
import context from '../../api/api'
import { mapState, mapActions } from 'vuex'
export default {
  mixins: [imageMixin],
  async created() {
    await this.getAllCatalogs()
  },
  methods: {
    ...mapActions(['getAllCatalogs']),
    downloadCatalog(catalog) {
      context
        .post(
          'api/export/catalog',
          { filename: catalog.file },
          {
            // 'content-type': 'application/vnd.ms-excel;charset=UTF-8',
            responseType: 'blob'
          }
        )
        .then(x => {
          // console.log(x)
          let fileUrl = window.URL.createObjectURL(new Blob([x]))
          let fileLink = document.createElement('a')
          fileLink.href = fileUrl
          fileLink.setAttribute(
            'download',
            catalog.name + (catalog.ext ? '.' + catalog.ext : '')
          )
          document.body.appendChild(fileLink)
          fileLink.click()
          fileLink.remove()
        })
    }
  },
  computed: {
    ...mapState({
      catalogs: state => state.catalog.allCatalogs
    })
  }
}
</script>
