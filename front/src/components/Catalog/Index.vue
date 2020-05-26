<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Каталоги
        <v-btn fab small to="/lk/catalog/create">
          <v-icon>mdi-plus</v-icon>
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
        <template v-slot:item.image="{ item }">
          <v-img max-width="150" :src="img(item.image)"></v-img>
        </template>
        <template v-slot:item.act="{ item }">
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/catalog/' + item.id"
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
import config from '../../init/config'
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
import imageMixin from '@/mixins/image'
export default {
  mixins: [imageMixin],
  data: () => ({
    removedItem: null,
    headers: [
      { text: 'Наименование', value: 'name' },
      { text: 'Изображение', value: 'image', width: '120', sortable: false },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions([
      'getAllCatalogs',
      'resetConfirmDialogResult',
      'deleteCatalog'
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
        this.deleteCatalog(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.catalog.allCatalogs,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllCatalogs()
  }
}
</script>
