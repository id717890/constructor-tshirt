<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Вопрос-ответ
        <v-btn fab small to="/lk/faq/create">
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
            :to="'/lk/faq/' + item.id"
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
export default {
  data: () => ({
    removedItem: null,
    headers: [
      { text: 'Вопрос', value: 'question' },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions(['getAllFaqs', 'resetConfirmDialogResult', 'deleteFaq']),
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
        this.deleteFaq(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.faq.allFaqs,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllFaqs()
  }
}
</script>
