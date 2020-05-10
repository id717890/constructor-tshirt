<template>
  <v-row>
    <v-col cols="12" class="d-flex align-center">
      <h2>
        Фотогалерея
        <v-btn fab small to="/lk/photo/create" class="mx-3">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
        <v-btn fab small to="/lk/albums" class="mx-3">
          <v-icon>mdi-image-album</v-icon>
        </v-btn>
      </h2>
      <v-spacer></v-spacer>
      <v-select
        v-if="albums"
        :items="albums"
        label="Выберите альбом"
        return-object
        item-text="name"
        v-model="currentAlbum"
      ></v-select>
    </v-col>
    <v-col cols="12" class="d-flex flex-row flex-wrap">
      <div v-if="!photos || photos.length === 0">Нет данных</div>
      <v-card
        v-for="item in photos"
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
    currentAlbum: null,
    removedItem: null
  }),
  methods: {
    ...mapActions([
      'getAllPhotos',
      'getAllAlbums',
      'resetConfirmDialogResult',
      'deletePhoto'
    ]),
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
    ...mapGetters(['getPhotosByAlbumId']),
    ...mapState({
      albums: state => state.album.allAlbums,
      tableItems: state => state.photo.allPhotos,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    }),
    photos() {
      if (this.currentAlbum) return this.currentAlbum.images
      return this.tableItems
    }
  },
  async mounted() {
    await this.getAllAlbums()
    await this.getAllPhotos()
  }
}
</script>
