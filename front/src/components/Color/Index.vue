<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Цвета футболок
        <v-btn fab small to="/lk/color/create">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </h2>
    </v-col>
    <v-col cols="12">
      <v-data-table
        :headers="headers"
        :items="tableItems"
        class="elevation-1"
        hide-default-footer
        hide
      >
        <template v-slot:item.image_front="{ item }">
          <v-img max-width="90" :src="img(item.image_front)"></v-img>
        </template>
        <template v-slot:item.image_back="{ item }">
          <v-img max-width="90" :src="img(item.image_back)"></v-img>
        </template>
        <template v-slot:item.act="{ item }">
          <v-btn
            fab
            text
            small
            title="Размеры и цены"
            color="success"
            :to="'/lk/color/size/' + item.id"
          >
            <v-icon>mdi-currency-rub</v-icon>
          </v-btn>
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/color/' + item.id"
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
      { text: 'Цвет', value: 'name' },
      { text: 'Артикул', value: 'article' },
      { text: 'Модель', value: 'model.name' },
      {
        text: 'Вид спереди',
        value: 'image_front',
        width: '150',
        sortable: false
      },
      { text: 'Вид сзади', value: 'image_back', width: '150', sortable: false },
      { text: '', value: '', value: 'act', width: '170', sortable: false }
    ]
  }),
  methods: {
    ...mapActions(['getAllColors', 'resetConfirmDialogResult', 'deleteColor']),
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
        this.deleteColor(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.color.allColors,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async mounted() {
    await this.getAllColors()
  }
}
</script>
