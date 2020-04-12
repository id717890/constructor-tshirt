<template>
  <v-data-table
    :headers="headers"
    :items="data"
    class="elevation-1"
    hide-default-footer
    hide
  >
    <template v-slot:header.act="{ item }">
      <v-btn text title="Добавить запись" color="success" @click="addSize">
        Добавить<v-icon>mdi-plus</v-icon>
      </v-btn>
    </template>
    <template v-slot:item.size="{ item }">
      <div v-if="item.edit === true">
        <v-text-field
          label="Размер"
          v-model="item.size"
          required
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
    <template v-slot:item.count="{ item }">
      <div v-if="item.edit === true">
        <v-text-field
          label="На складе"
          v-model="item.count"
          required
          type="number"
          :rules="textField"
        ></v-text-field>
      </div>
      <div v-else>{{ item.count }}</div>
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
  props: ['rows', 'color_id'],
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
      { text: 'Размер', value: 'size' },
      { text: 'Цена (руб)', value: 'price' },
      { text: 'На складе (шт.)', value: 'count' },
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
      'createSize',
      'deleteSize',
      'updateSize',
      'resetConfirmDialogResult'
    ]),
    save(item) {
      if (item.size && item.price && item.count) {
        if (item.id === 0) {
          this.createSize(item).then(x => {
            item.id = x.id
            item.edit = false
          })
        } else {
          this.updateSize(item)
            .then(x => {
              item.edit = false
            })
            .catch(x => console.log(x))
        }
      }
    },
    addSize() {
      this.data.push({
        id: 0,
        color_id: this.color_id,
        size: '',
        price: 0,
        count: 0,
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
        this.deleteSize(this.removedItem).then(() => {
          const find = this.data.find(x => x.id === id)
          if (find) this.data.splice(this.data.indexOf(find), 1)
        })
        this.removedItem = null
      }
    }
  },
  watch: {
    rows(value) {
      // console.log(value)
      // const d = this.rows.map(x => {
      //   this.$set(x, 'edit', false)
      //   return x
      // })
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
