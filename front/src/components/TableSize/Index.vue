<template>
  <v-row>
    <v-col cols="12">
      <h2>
        <v-icon>
          mdi-table
        </v-icon>
        Размерная сетка
        <v-btn fab small to="/lk/table_size/create">
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
            :to="'/lk/table_size/' + item.id"
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

export default {
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    removedItem: null,
    headers: [
      { text: 'Размер', value: 'size' },
      { text: 'Возраст', value: 'age1' },
      { text: 'РФ', value: 'rf1' },
      { text: 'Рост', value: 'height1' },
      { text: 'Грудь', value: 'chest1' },
      { text: 'Талия', value: 'waist1' },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions([
      'getAllTableSizes',
      'resetConfirmDialogResult',
      'deleteTableSize'
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
        const id = this.removedItem.id
        this.resetConfirmDialogResult()
        this.deleteTableSize(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.size.allTableSizes,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllTableSizes()
  }
}
</script>
