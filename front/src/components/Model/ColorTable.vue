<template>
  <v-data-table
    :headers="headers"
    :items="data"
    class="elevation-1"
    :options="pagination"
    hide
  >
    <template v-slot:item.image_front="{ item }">
      <div class="d-flex flex-row flex-nowrap align-center">
        <v-img
          max-width="90"
          :src="img(item.image_front)"
          v-if="item.image_front"
        ></v-img>
        <v-btn
          fab
          text
          small
          v-if="item.edit === true"
          class="ml-2"
          @click="$refs['fileForFront_' + item.id].click()"
        >
          <v-icon>mdi-upload</v-icon>
        </v-btn>
        <input
          style="display: none"
          :ref="'fileForFront_' + item.id"
          type="file"
          @change="uploadImageForSize($event, item, 'front')"
          multiple
          enctype="multipart/form-data"
        />
      </div>
    </template>
    <template v-slot:item.image_back="{ item }">
      <div class="d-flex flex-row flex-nowrap align-center">
        <v-img
          max-width="90"
          :src="img(item.image_back)"
          v-if="item.image_back"
        ></v-img>
        <v-btn
          fab
          text
          small
          v-if="item.edit === true"
          class="ml-2"
          @click="$refs['fileForBack_' + item.id].click()"
        >
          <v-icon>mdi-upload</v-icon>
        </v-btn>
        <v-btn
          fab
          text
          small
          v-if="item.edit === true"
          class="ml-2"
          color="red"
          @click="item.image_back = null"
        >
          <v-icon>mdi-delete</v-icon>
        </v-btn>
        <input
          style="display: none"
          :ref="'fileForBack_' + item.id"
          type="file"
          @change="uploadImageForSize($event, item, 'back')"
          multiple
          enctype="multipart/form-data"
        />
      </div>
    </template>
    <template v-slot:header.act="{ item }">
      <v-btn text title="Добавить запись" color="success" @click="addColor">
        Добавить<v-icon>mdi-plus</v-icon>
      </v-btn>
    </template>

    <!-- <template v-slot:item.name="{ item }">
      <div v-if="item.edit === true">
        <v-text-field
          label="Цвет"
          v-model="item.article"
          required
          :rules="textField"
        ></v-text-field>
      </div>
      <div v-else>{{ item.name }}</div>
    </template> -->
    <template v-slot:item.article="{ item }">
      <div v-if="item.edit === true">
        <v-text-field
          label="Артикул"
          v-model="item.article"
          required
          :rules="textField"
        ></v-text-field>
      </div>
      <div v-else>{{ item.article }}</div>
    </template>
    <template v-slot:item.act="{ item }">
      <section v-if="item.edit === true">
        <v-btn
          fab
          text
          title="Сохранить изменения"
          color="success"
          @click="save(item)"
        >
          <v-icon>mdi-check</v-icon>
        </v-btn>
        <v-btn
          fab
          text
          title="Отменить изменения"
          color="warning"
          @click="item.edit = false"
        >
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </section>
      <section v-else>
        <v-btn
          fab
          text
          small
          title="Размеры и цены"
          color="success"
          :to="'/lk/model/ ' + model_id + '/color/size/' + item.id"
        >
          <v-icon>mdi-currency-rub</v-icon>
        </v-btn>
        <v-btn
          fab
          text
          small
          title="Редакитровать"
          color="primary"
          @click="item.edit = true"
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
      </section>
    </template>

    <template v-slot:no-data>
      <span class="text-xs-center">Нет данных</span>
    </template>
  </v-data-table>
</template>

<script>
const settings = {
  height: 'auto',
  maxWidth: 400,
  adaptive: true,
  transition: 'nice-modal-fade',
  clickToClose: false
}
import config from '../../init/config'
import { mapActions, mapState } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  props: ['rows', 'model_id'],
  data: () => ({
    data: [],
    footerOption: {
      itemsPerPageText: 'Кол-во строк на странице'
    },
    pagination: {
      itemsPerPage: -1
    },
    removedItem: null,
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      size: '',
      price: 0,
      count: 0
    },
    headers: [
      // { text: 'Цвет', value: 'name' },
      { text: 'Артикул', value: 'article' },
      {
        text: 'Вид спереди',
        value: 'image_front',
        width: '150',
        sortable: false
      },
      { text: 'Вид сзади', value: 'image_back', width: '150', sortable: false },
      { text: '', value: '', value: 'act', width: '150', sortable: false }
    ]
  }),
  async created() {
    this.data = this.rows.map(x => {
      this.$set(x, 'edit', false)
      return x
    })
  },
  computed: {
    ...mapState({
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  methods: {
    ...mapActions([
      'createColorPromise',
      'deleteColorPromise',
      'updateColorPromise',
      'uploadImage',
      'resetConfirmDialogResult'
    ]),
    uploadImageForSize(event, item, type) {
      const file = event.target.files[0]
      let fd = new FormData()
      fd.append('image', file)
      fd.append('prefix', 'model-color-')
      this.uploadImage(fd).then(x => {
        if (type && type === 'front') item.image_front = x.fullname
        if (type && type === 'back') item.image_back = x.fullname
      })
    },
    img(url) {
      return config.apiAddress + 'api/image/' + url
    },
    save(item) {
      item.name = item.article
      if (item.name && item.article && item.image_front) {
        if (item.id === 0) {
          this.createColorPromise(item).then(x => {
            item.id = x.id
            item.edit = false
          })
        } else {
          this.updateColorPromise(item)
            .then(x => {
              item.edit = false
            })
            .catch(x => console.log(x))
        }
      }
    },
    addColor() {
      this.data.push({
        id: 0,
        model_id: this.model_id,
        name: '',
        article: '',
        image_front: null,
        image_back: null,
        edit: true
      })
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
        const id = this.removedItem.id
        this.resetConfirmDialogResult()
        this.deleteColorPromise(this.removedItem).then(() => {
          const find = this.data.find(x => x.id === id)
          if (find) this.data.splice(this.data.indexOf(find), 1)
        })
        this.removedItem = null
      }
    }
  },
  watch: {
    rows(value) {
      this.data = value.map(x => {
        // x.edit = false
        this.$set(x, 'edit', false)
        return x
      })
    }
  }
}
</script>

<style></style>
