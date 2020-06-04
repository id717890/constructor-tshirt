<template>
  <v-form lazy-validation v-model="form.valid" ref="form">
    <v-container fluid>
      <v-row>
        <v-col cols="12">
          <h1>Новый размер</h1>
        </v-col>
      </v-row>
      <v-row>
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
      <v-row>
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
      <v-row> </v-row>
      <v-row>
        <v-col lg="6" md="8" sm="12" cols="12" class="d-flex">
          <v-btn color="secondary" class="mr-5" large to="/lk/table_sizes">
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
import { mapActions } from 'vuex'

export default {
  mixins: [loading],
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
  methods: {
    ...mapActions(['createTableSize']),
    sizeChanged(e) {
      this.form.size = e.toUpperCase()
    },
    save() {
      this.setLoad(true)
      if (this.$refs.form.validate()) {
        this.createTableSize(this.form)
      } else this.setLoad(false)
    }
  }
}
</script>
