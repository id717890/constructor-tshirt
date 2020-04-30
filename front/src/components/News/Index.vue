<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Новости
        <v-btn fab small to="/lk/news/create">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
        <v-btn
          fab
          text
          small
          class="mx-3"
          v-if="view === 'module'"
          @click="view = 'list'"
        >
          <v-icon>mdi-view-list</v-icon>
        </v-btn>
        <v-btn
          fab
          text
          small
          class="mx-3"
          v-if="view === 'list'"
          @click="view = 'module'"
        >
          <v-icon>mdi-view-module</v-icon>
        </v-btn>
      </h2>
    </v-col>
    <v-col cols="12" v-if="view === 'module'" class="d-flex flex-row flex-wrap">
      <v-card
        v-for="item in tableItems"
        :key="item.id"
        width="260"
        class="card-hover mr-6 mb-6 d-flex flex-column"
      >
        <v-img
          height="260px"
          aspect-ratio="1.6"
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
            :to="'/lk/news/' + item.id"
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
    <v-col cols="12" v-if="view === 'list'">
      <v-data-table
        :headers="headers"
        :items="tableItems"
        class="elevation-1"
        hide
      >
        <template v-slot:item.image="{ item }">
          <v-img max-width="90" :src="img(item.image)"></v-img>
        </template>
        <template v-slot:item.act="{ item }">
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/news/' + item.id"
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
import imageMixin from '../../mixins/image'
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  mixins: [imageMixin],
  data: () => ({
    view: 'list',
    removedItem: null,
    headers: [
      { text: 'Заголовок', value: 'title' },
      { text: 'Изображение', value: 'image', sortable: false, width: '150' },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions(['getAllNews', 'resetConfirmDialogResult', 'deleteNews']),
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
        this.deleteNews(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.news.allNews,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllNews()
  }
}
</script>
