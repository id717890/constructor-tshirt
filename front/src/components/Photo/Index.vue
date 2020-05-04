<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Фотогалерея
        <v-btn fab small to="/lk/photo/create" class="mx-3">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </h2>
    </v-col>
    <v-col cols="12" class="d-flex flex-row flex-wrap">
      <v-card
        v-for="item in tableItems"
        :key="item.id"
        max-width="260"
        class="mr-6 mb-6 d-flex flex-column"
      >
        <v-img
          max-height="260px"
          :src="img(item.image)"
          class="align-end white--text image-text"
        >
        </v-img>
        <v-card-text class="d-flex flex-grow-1">
          {{ item.title }}
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/photo/' + item.id"
          >
            <v-icon>mdi-pen</v-icon>
          </v-btn>
          <v-btn
            fab
            text
            small
            title="Удалить"
            color="error"
            @click="deleteItem(item)"
          >
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
import config from '../../init/config'
import imageMixin from '../../mixins/image'

export default {
  mixins: [imageMixin],
  data: () => ({
    removedItem: null
  }),
  methods: {
    ...mapActions(['getAllPhotos', 'resetConfirmDialogResult', 'deletePhoto']),
    deleteItem(item) {
      this.removedItem = item
      this.$modal.show(
        ConfirmDialogModal,
        { question: 'Удалить запись?' },
        {
          ...config.modalSettings
        },
        {
          closed: this.confirmDelete
        }
      )
    },
    confirmDelete() {
      if (this.confirmDialogResult === true) {
        this.resetConfirmDialogResult()
        this.deletePhoto(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.photo.allPhotos,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async mounted() {
    await this.getAllPhotos()
  }
}
</script>
