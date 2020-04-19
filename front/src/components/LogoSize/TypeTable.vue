<template>
  <v-data-table
    :headers="headers"
    :items="data"
    class="elevation-1"
    hide-default-footer
    hide
  >
    <template v-slot:header.act="{ item }">
      <v-btn text title="Добавить запись" color="success" @click="addRow">
        Добавить<v-icon>mdi-plus</v-icon>
      </v-btn>
    </template>
    <template v-slot:item.name="{ item }">
      <div v-if="item.edit === true">
        <v-text-field
          label="Размер"
          v-model="item.name"
          required
          :rules="textField"
        ></v-text-field>
      </div>
      <div v-else>{{ item.name }}</div>
    </template>
    <template v-slot:item.description="{ item }">
      <div v-if="item.edit === true">
        <v-text-field
          label="Размер"
          v-model="item.description"
          required
          :rules="textField"
        ></v-text-field>
      </div>
      <div v-else>{{ item.description }}</div>
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
import { mapActions, mapState } from 'vuex'
import ConfirmDialogModal from '../Dialog/ConfirmDialog'
export default {
  props: ['rows', 'logo_size_id'],
  data: () => ({
    data: [],
    removedItem: null,
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      size: '',
      price: 0,
      count: 0
    },
    headers: [
      { text: 'Наименование', value: 'name' },
      { text: 'Описание', value: 'description' },
      { text: 'Цена (руб)', value: 'price' },
      { text: '', value: '', value: 'act', width: '120', sortable: false }
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
      'createTypePromise',
      'deleteTypePromise',
      'updateTypePromise',
      'resetConfirmDialogResult'
    ]),
    save(item) {
      if (item.name && item.description && item.price) {
        if (item.id === 0) {
          this.createTypePromise(item).then(x => {
            item.id = x.id
            item.edit = false
          })
        } else {
          this.updateTypePromise(item)
            .then(x => {
              item.edit = false
            })
            .catch(x => console.log(x))
        }
      }
    },
    addRow() {
      this.data.push({
        id: 0,
        name: '',
        description: '',
        logo_size_id: this.logo_size_id,
        price: 0,
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
        console.log(this.removedItem)
        this.deleteTypePromise(this.removedItem).then(() => {
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
        this.$set(x, 'edit', false)
        return x
      })
    }
  }
}
</script>

<style></style>
