<template>
  <v-row>
    <v-col cols="12">
      <h2>
        Размеры надписей
        <v-btn fab small @click="addRow">
          <v-icon>mdi-plus</v-icon>
        </v-btn>
      </h2>
    </v-col>
    <v-col cols="12">
      <v-data-table :headers="headers" :items="rows" class="elevation-1" hide>
        <template v-slot:item.name="{ item }">
          <div v-if="item.edit === true">
            <v-text-field
              label="Наименование"
              v-model="item.name"
              required
              :rules="textField"
            ></v-text-field>
          </div>
          <div v-else>{{ item.name }}</div>
        </template>
        <template v-slot:item.size="{ item }">
          <div v-if="item.edit === true">
            <v-text-field
              label="Размер"
              v-model="item.size"
              required
              type="number"
              :rules="textField"
            ></v-text-field>
          </div>
          <div v-else>{{ item.size }}</div>
        </template>
        <template v-slot:item.price="{ item }">
          <div v-if="item.edit === true">
            <v-text-field
              label="Цена"
              v-model="item.price"
              required
              type="number"
              :rules="textField"
            ></v-text-field>
          </div>
          <div v-else>{{ item.price }}</div>
        </template>
        <template v-slot:item.act="{ item }">
          <section v-if="item.edit === true">
            <v-btn
              fab
              text
              small
              title="Сохранить изменения"
              color="success"
              @click="save(item)"
            >
              <v-icon>mdi-check</v-icon>
            </v-btn>
            <v-btn
              fab
              text
              small
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
        <!-- <template v-slot:item.act="{ item }">
          <v-btn
            fab
            text
            small
            title="Редакитровать"
            color="primary"
            :to="'/lk/text_size/' + item.id"
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
        </template> -->

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
    rows: [],
    removedItem: null,
    textField: [v => !!v || 'Обязательное поле'],
    headers: [
      { text: 'Наименование', value: 'name' },
      { text: 'Размер (мм)', value: 'size' },
      { text: 'Цена (руб)', value: 'price' },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
    ]
  }),
  methods: {
    ...mapActions([
      'getAllTextSizes',
      'resetConfirmDialogResult',
      'deleteTextSizePromise',
      'updateTextSizePromise',
      'createTextSizePromise'
    ]),
    addRow() {
      this.rows.push({
        id: 0,
        name: '',
        size: '',
        price: 0,
        edit: true
      })
    },
    save(item) {
      if (item.name && item.size && item.price) {
        if (item.id === 0) {
          this.createTextSizePromise(item).then(x => {
            item.id = x.id
            item.edit = false
          })
        } else {
          this.updateTextSizePromise(item)
            .then(x => {
              item.edit = false
            })
            .catch(x => console.log(x))
        }
      }
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
        if (id) {
          this.deleteTextSizePromise(this.removedItem).then(() => {})
        }
        const find = this.rows.find(x => x.id === id)
        if (find) this.rows.splice(this.rows.indexOf(find), 1)
        this.removedItem = null
      }
    }
    // confirmDelete() {
    //   if (this.confirmDialogResult === true) {
    //     this.resetConfirmDialogResult()
    //     this.deleteTextSize(this.removedItem)
    //     this.removedItem = null
    //   }
    // }
  },
  computed: {
    ...mapState({
      tableItems: state => state.textSize.allTextSizes,
      confirmDialogResult: state => state.dialog.confirmDialogResult
    })
  },
  async created() {
    await this.getAllTextSizes()
  },
  watch: {
    tableItems(values) {
      if (values && values.length > 0) {
        this.rows = values.map(x => {
          this.$set(x, 'edit', false)
          return x
        })
      } else {
        this.rows = []
      }
    }
  }
}
</script>
