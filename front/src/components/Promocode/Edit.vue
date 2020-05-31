<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование промокода</h1>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            label="Наименование"
            v-model="form.name"
            required
            :rules="textField"
          ></v-text-field>
          <v-text-field
            label="Промокод"
            v-model="form.code"
            required
            :rules="textField"
          ></v-text-field>
          <v-text-field
            label="Скидка"
            type="number"
            min="0"
            max="99"
            v-model="form.discount"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12" class="d-flex">
          <v-btn
            color="primary"
            large
            :loading="loading"
            @click.prevent="save"
            :disabled="!form.valid"
          >
            <v-icon class="mr-2">mdi-content-save</v-icon>
            Сохранить
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="secondary" large to="/lk/promocodes">
            <v-icon class="mr-2">mdi-arrow-left</v-icon>
            Отмена
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import loading from '../../mixins/loading'
import { mapActions, mapGetters } from 'vuex'

export default {
  mixins: [loading],
  props: ['id'],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      name: '',
      code: '',
      discount: 0
    }
  }),
  async created() {
    await this.getAllPromocodes()
    this.setLoad(false)
  },
  watch: {
    promocode(value) {
      if (value) {
        this.form.name = value.name
        this.form.discount = value.discount
        this.form.code = value.code
      }
    }
  },
  mounted() {
    if (this.promocode) {
      this.form.name = this.promocode.name
      this.form.code = this.promocode.code
      this.form.discount = this.promocode.discount
    }
  },
  computed: {
    ...mapGetters(['getPromocodeById']),
    promocode() {
      return this.getPromocodeById(this.id)
    }
  },
  methods: {
    ...mapActions(['updatePromocode', 'getAllPromocodes']),
    inputPromocode(e) {
      this.form.code = e.toUpperCase()
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.updatePromocode({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
