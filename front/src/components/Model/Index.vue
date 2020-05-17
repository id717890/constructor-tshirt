<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Модели футболок
        <v-btn fab small to="/lk/model/create" class="mx-3">
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
        <v-btn
          fab
          small
          text
          class="mx-3"
          @click="downloadExcel"
          title="Выгрузить список размеров и цен"
        >
          <v-icon>mdi-file-excel-box</v-icon>
        </v-btn>
        <v-btn
          fab
          small
          text
          class="mx-3"
          @click="$refs.fileSizes.click()"
          title="ИМПОРТ размеров и цен"
        >
          <v-icon>mdi-upload</v-icon>
        </v-btn>
        <input
          style="display: none"
          ref="fileSizes"
          type="file"
          @change="uploadSizes"
          multiple
          enctype="multipart/form-data"
        />
      </h2>
    </v-col>
    <v-col cols="12" v-if="view === 'module'" class="d-flex flex-row flex-wrap">
      <v-card
        v-for="item in tableItems"
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
          {{ item.name }}
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/model/' + item.id"
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
        <template v-slot:item.order="{ item }">
          <v-text-field
            v-model="item.order"
            @blur="orderChanged($event, item)"
          ></v-text-field>
        </template>
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
            :to="'/lk/model/' + item.id"
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
import axios from 'axios'
import { mapActions, mapState, mapGetters } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
import config from '../../init/config'
import context from '../../api/api'

export default {
  data: () => ({
    view: 'list',
    removedItem: null,
    headers: [
      { text: 'Наименование', value: 'name' },
      { text: 'Тип', value: 'type.name' },
      { text: '', value: 'image', width: '150', sortable: false },
      { text: 'Очередь', value: 'order', width: '100', sortable: false },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions([
      'getAllModels',
      'resetConfirmDialogResult',
      'deleteModel',
      'updateModelOrder'
    ]),
    orderChanged(event, model) {
      this.updateModelOrder(model)
    },
    uploadSizes(event) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('sizes', file)
      context.post('api/import/sizes', fd).then(x => {
        console.log(x)
        alert('Импорт завершён!')
      })
    },
    downloadExcel() {
      // axios({
      //   url: 'http://localhost/jomafull/back/public/api/export/sizes',
      //   method: 'POST',
      //   responseType: 'blob'
      // }).then(x => {
      //   console.log(x)
      //   let fileUrl = window.URL.createObjectURL(new Blob([x.data]))
      //   let fileLink = document.createElement('a')
      //   fileLink.href = fileUrl
      //   fileLink.setAttribute('download', 'report.xls')
      //   document.body.appendChild(fileLink)
      //   fileLink.click()
      // })
      context
        .post('api/export/sizes', null, {
          // 'content-type': 'application/vnd.ms-excel;charset=UTF-8',
          responseType: 'blob'
        })
        .then(x => {
          // console.log(x)
          let fileUrl = window.URL.createObjectURL(new Blob([x]))
          let fileLink = document.createElement('a')
          fileLink.href = fileUrl
          fileLink.setAttribute('download', 'sizes.xls')
          document.body.appendChild(fileLink)
          fileLink.click()
          fileLink.remove()
        })
    },
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
        this.deleteModel(this.removedItem)
        this.removedItem = null
      }
    }
  },
  computed: {
    ...mapState({
      tableItems: state => state.model.allModels,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async mounted() {
    await this.getAllModels()
  }
}
</script>
