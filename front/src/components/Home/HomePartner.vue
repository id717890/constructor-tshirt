<template>
  <v-row>
    <v-col cols="12">
      <v-card class="pa-1">
        <swiper
          ref="partnerSwiper"
          class="partnerSwiper"
          :options="swiperOptions"
        >
          <swiper-slide
            v-for="partner in partners"
            :key="partner.id"
            class="swiper-element swiper-element__partner"
          >
            <v-img
              contain
              height="100%"
              aspect-ratio="1.6"
              :src="img(partner.image)"
              max-width="260"
            >
              <div class="partner-content">
                <v-btn
                  fab
                  text
                  title="Редакитровать"
                  color="primary"
                  :to="'/lk/home/partner/edit/' + partner.id"
                >
                  <v-icon>mdi-pen</v-icon>
                </v-btn>
                <v-btn
                  color="error"
                  fab
                  text
                  @click.prevent="deleteItem(partner)"
                >
                  <v-icon>mdi-delete</v-icon>
                </v-btn>
              </div>
            </v-img>
          </swiper-slide>
          <!-- Стрелки прокрутки моделей -->
          <div class="swiper-button-prev" slot="button-prev"></div>
          <div class="swiper-button-next" slot="button-next"></div>
        </swiper>
        <v-btn color="primary" class="ma-4" to="/lk/home/partner/create">
          <v-icon>mdi-plus</v-icon>
          Добавить партнера
        </v-btn>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import config from '../../init/config'
import imageMixin from '../../mixins/image'
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  mixins: [imageMixin],
  data: () => ({
    slidesHeight: 290,
    removedItem: null,
    swiperOptions: { ...config.swiperOptions }
  }),
  methods: {
    ...mapActions([
      'getAllPartners',
      'resetConfirmDialogResult',
      'deletePartner'
    ]),
    deleteItem(item) {
      this.removedItem = item
      this.$modal.show(
        ConfirmDialogModal,
        { question: 'Удалить запись?' },
        config.modalSettings,
        {
          closed: this.confirmDelete
        }
      )
    },
    confirmDelete() {
      if (this.confirmDialogResult === true) {
        this.resetConfirmDialogResult()
        this.deletePartner(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      partners: state => state.home.allPartners,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllPartners()
  }
}
</script>
