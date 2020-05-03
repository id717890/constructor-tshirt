<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Видео
        <v-btn fab small to="/lk/video/create">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </h2>
    </v-col>
    <v-col
      md="4"
      cols="12"
      class="d-flex flex-row flex-wrap"
      v-for="item in tableItems"
      :key="item.id"
    >
      <v-card class="card-hover w100 mb-6 d-flex flex-column">
        <div class="video-wrapper" v-html="item.text"></div>
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
            :to="'/lk/video/' + item.id"
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
import config from '../../init/config'
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  data: () => ({
    removedItem: null
  }),
  methods: {
    ...mapActions(['getAllVideos', 'resetConfirmDialogResult', 'deleteVideo']),
    deleteItem(item) {
      this.removedItem = item
      this.$modal.show(
        ConfirmDialogModal,
        { question: 'Удалить запись?' },
        {
          ...config.modalSettings,
          maxWidth: 400
        },
        {
          closed: this.confirmDelete
        }
      )
    },
    confirmDelete() {
      if (this.confirmDialogResult === true) {
        this.resetConfirmDialogResult()
        this.deleteVideo(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.video.allVideos,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllVideos()
  }
}
</script>
