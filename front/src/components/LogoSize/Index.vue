<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Размеры логотипов
        <v-btn fab small to="/lk/logo_size/create">
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
        <template v-slot:item.act="{ item }">
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/logo_size/' + item.id"
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
const settings = {
  height: 'auto',
  maxWidth: 400,
  adaptive: true,
  transition: 'nice-modal-fade',
  clickToClose: false
}
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
import config from '../../init/config'

export default {
  data: () => ({
    removedItem: null,
    headers: [
      { text: 'Наименование', value: 'name' },
      { text: 'Размер (мм)', value: 'size' },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions([
      'getAllLogoSizes',
      'resetConfirmDialogResult',
      'deleteLogoSize'
    ]),
    img(url) {
      return config.apiAddress + 'api/image/' + url
    },
    deleteItem(item) {
      this.removedItem = item
      this.$modal.show(
        ConfirmDialogModal,
        { question: 'Удалить запись?' },
        settings,
        {
          closed: this.confirmDelete
        }
      )
    },
    confirmDelete() {
      if (this.confirmDialogResult === true) {
        this.resetConfirmDialogResult()
        this.deleteLogoSize(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.logoSize.allLogoSizes,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async mounted() {
    await this.getAllLogoSizes()
  }
}
</script>
