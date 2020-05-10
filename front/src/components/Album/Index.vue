<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Альбомы
        <v-btn fab small to="/lk/album/create">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
        <v-btn class="ml-4" fab small to="/lk/photos">
          <v-icon>mdi-image</v-icon>
        </v-btn>
      </h2>
    </v-col>
    <v-col cols="12">
      <v-data-table
        :headers="headers"
        :items="tableItems"
        class="elevation-1"
        hide
      >
        <template v-slot:item.count="{ item }">
          {{ item.images.length }}
        </template>
        <template v-slot:item.act="{ item }">
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/album/' + item.id"
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
        </template>

        <template v-slot:no-data>
          <h4 class="text-xs-center">Нет данных</h4>
        </template>
      </v-data-table>
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
    removedItem: null,
    headers: [
      { text: 'Наименование', value: 'name' },
      {
        text: 'Изображений',
        value: 'count',
        width: '150',
        sortable: false
      },
      { text: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions(['getAllAlbums', 'resetConfirmDialogResult', 'deleteAlbum']),
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
        this.deleteAlbum(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.album.allAlbums,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async mounted() {
    await this.getAllAlbums()
  }
}
</script>
