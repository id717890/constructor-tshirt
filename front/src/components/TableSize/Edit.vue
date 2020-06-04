<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Редактирование размера</h1>
        </v-col>
      </v-row>
      <v-row v-if="tableSize">
        <v-col lg="6" md="8" sm="12" cols="12">
          <v-text-field
            label="Размер"
            @input="sizeChanged"
            v-model="form.size"
            required
            :rules="textField"
          ></v-text-field>
        </v-col>
      </v-row>
      <v-row v-if="tableSize">
        <v-col lg="3" md="4" sm="12" cols="12">
          <v-text-field label="Возраст" v-model="form.age1"></v-text-field>
          <v-text-field label="РФ" v-model="form.rf1"></v-text-field>
          <v-text-field label="Рост" v-model="form.height1"></v-text-field>
          <v-text-field label="Грудь" v-model="form.chest1"></v-text-field>
          <v-text-field label="Талия" v-model="form.waist1"></v-text-field>
        </v-col>
        <v-col lg="3" md="4" sm="12" cols="12">
          <v-text-field label="Возраст" v-model="form.age2"></v-text-field>
          <v-text-field label="РФ" v-model="form.rf2"></v-text-field>
          <v-text-field label="Рост" v-model="form.height2"></v-text-field>
          <v-text-field label="Грудь" v-model="form.chest2"></v-text-field>
          <v-text-field label="Талия" v-model="form.waist2"></v-text-field>
        </v-col>
        <v-col lg="3" md="4" sm="12" cols="12">
          <v-text-field label="Возраст" v-model="form.age3"></v-text-field>
          <v-text-field label="РФ" v-model="form.rf3"></v-text-field>
          <v-text-field label="Рост" v-model="form.height3"></v-text-field>
          <v-text-field label="Грудь" v-model="form.chest3"></v-text-field>
          <v-text-field label="Талия" v-model="form.waist3"></v-text-field>
        </v-col>
        <v-col lg="3" md="4" sm="12" cols="12">
          <v-text-field label="Возраст" v-model="form.age4"></v-text-field>
          <v-text-field label="РФ" v-model="form.rf4"></v-text-field>
          <v-text-field label="Рост" v-model="form.height4"></v-text-field>
          <v-text-field label="Грудь" v-model="form.chest4"></v-text-field>
          <v-text-field label="Талия" v-model="form.waist4"></v-text-field>
        </v-col>
      </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12" class="d-flex">
          <v-btn class="mr-5" color="secondary" large to="/lk/table_sizes">
            <v-icon class="mr-2">mdi-arrow-left</v-icon>
            Отмена
          </v-btn>
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
        </v-col>
      </v-row>
    </v-container>
  </v-form>
</template>

<script>
import loading from '../../mixins/loading'
import { mapActions, mapGetters, mapState } from 'vuex'
import config from '../../init/config'

export default {
  mixins: [loading],
  props: ['id'],
  data: () => ({
    textField: [v => !!v || 'Обязательное поле'],
    form: {
      valid: true,
      size: '',
      age1: '',
      rf1: '',
      height1: '',
      chest1: '',
      waist1: '',
      age2: '',
      rf2: '',
      height2: '',
      chest2: '',
      waist2: '',
      age3: '',
      rf3: '',
      height3: '',
      chest3: '',
      waist3: '',
      age4: '',
      rf4: '',
      height4: '',
      chest4: '',
      waist4: ''
    }
  }),
  async created() {
    await this.getAllTableSizes()
    this.setLoad(false)
  },
  watch: {
    tableSize(value) {
      if (value) {
        this.form.size = value.size
        this.form.age1 = value.age1
        this.form.rf1 = value.rf1
        this.form.height1 = value.height1
        this.form.chest1 = value.chest1
        this.form.waist1 = value.waist1
        this.form.age2 = value.age2
        this.form.rf2 = value.rf2
        this.form.height2 = value.height2
        this.form.chest2 = value.chest2
        this.form.waist2 = value.waist2
        this.form.age3 = value.age3
        this.form.rf3 = value.rf3
        this.form.height3 = value.height3
        this.form.chest3 = value.chest3
        this.form.waist3 = value.waist3
        this.form.age4 = value.age4
        this.form.rf4 = value.rf4
        this.form.height4 = value.height4
        this.form.chest4 = value.chest4
        this.form.waist4 = value.waist4
      }
    }
  },
  computed: {
    ...mapGetters(['getTableSizeById']),
    tableSize() {
      return this.getTableSizeById(this.id)
    }
  },
  methods: {
    ...mapActions(['updateTableSize', 'getAllTableSizes']),
    sizeChanged(e) {
      this.form.size = e.toUpperCase()
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.updateTableSize({
          id: this.id,
          ...this.form
        })
      } else this.setLoad(false)
    }
  }
}
</script>
