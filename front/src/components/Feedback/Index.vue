<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Отзывы
      </h2>
    </v-col>
    <v-col cols="12">
      <v-data-table
        :headers="headers"
        :items="tableItems"
        class="elevation-1"
        hide
      >
        <template v-slot:item.show="{ item }">
          <v-icon large color="success" v-if="item.show === 1"
            >mdi-toggle-switch</v-icon
          >
          <v-icon large color="red" v-else>mdi-toggle-switch-off</v-icon>
        </template>
        <template v-slot:item.rating="{ item }">
          <v-rating
            dense
            v-model="item.rating"
            :color="ratingColor(item.rating)"
            readonly
          ></v-rating>
        </template>
        <template v-slot:item.act="{ item }">
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/feedback/' + item.id"
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
import imageMixin from '../../mixins/image'
import config from '../../init/config'
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  mixins: [imageMixin],
  data: () => ({
    view: 'list',
    removedItem: null,
    headers: [
      { text: 'Текст', value: 'text' },
      { text: 'Рейтинг', value: 'rating', width: '200' },
      { text: 'Вкл/Выкл', value: 'show', sortable: false, width: '75' },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions([
      'getAllFeedbacks',
      'resetConfirmDialogResult',
      'deleteFeedback'
    ]),
    ratingColor(rating) {
      switch (rating) {
        case 1:
          return 'red'
        case 2:
          return 'orange'
        case 3:
          return 'yellow'
        case 4:
          return 'lime'
        case 5:
          return 'success'
      }
    },
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
        this.deleteFeedback(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.feedback.allFeedbacks,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllFeedbacks()
  }
}
</script>
