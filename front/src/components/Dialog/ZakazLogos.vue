<template>
  <v-card>
    <v-card-title>
      Заказ Нанесение
      <v-spacer></v-spacer>
      <v-btn
        color="success"
        text
        class="mr-25 px-10"
        large
        @click="$emit('close')"
      >
        <v-icon>mdi-close</v-icon>
        Закрыть
      </v-btn>
    </v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <v-tabs v-model="tab" background-color="primary" no-animation>
        <v-tab v-for="order in orders" :key="order.id">
          {{ order.titleTab }}
        </v-tab>
      </v-tabs>

      <v-tabs-items v-model="tab">
        <v-tab-item v-for="item in orders" :key="item.id">
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="">Нанесение</th>
                  <th class="">Кол-во</th>
                  <th class="">Цена (руб.)</th>
                  <th class="">Сумма (руб.)</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(row, index) in rows(item)" :key="index">
                  <td>{{ row.logoType }}</td>
                  <td>{{ row.count }}</td>
                  <td>{{ row.price }}</td>
                  <td>{{ row.price * row.count }}</td>
                </tr>
                <tr>
                  <td colspan="3" class="text-right">ИТОГО:</td>
                  <td>{{ sumByTab(rows(item)) }}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>

          <!-- <v-card flat>
            <v-simple-table>
              <template v-slot:default>
                <thead>
                  <tr>
                    <th class="" style="width: 200px">Размер</th>
                    <th class="">Номер</th>
                    <th class="">
                      <span style="left: 75px; position: relative"
                        >Фамилия</span
                      >
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(row, index) in order.sizes" :key="index">
                    <td colspan="3" class="pa-0">
                      <v-simple-table>
                        <tbody>
                          <tr v-for="(subRow, index) in row.rows" :key="index">
                            <td
                              v-if="index === 0"
                              :rowspan="row.rows.length"
                              style="width: 150px; border-right: 1px solid rgba(0, 0, 0, 0.12)"
                            >
                              {{ row.size }}
                            </td>
                            <td class="">
                              <div style="height: 32px">
                                <v-text-field
                                  class="input-fio"
                                  height="32"
                                  solo
                                  v-model="subRow.number"
                                ></v-text-field>
                              </div>
                            </td>
                            <td>
                              <div style="height: 32px">
                                <v-text-field
                                  class="input-fio"
                                  height="32"
                                  solo
                                  v-model="subRow.fio"
                                ></v-text-field>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </v-simple-table>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </v-card> -->
        </v-tab-item>
      </v-tabs-items>
    </v-card-text>
    <!-- <v-divider></v-divider> -->
    <!-- <v-card-actions> </v-card-actions> -->
  </v-card>
</template>

<script>
export default {
  props: ['orders'],
  data: () => ({
    tab: 0,
    data: [],
    show: false
  }),
  methods: {
    sumByTab(data) {
      console.log(data)
      let sum = 0
      data.forEach(x => {
        sum += x.count * x.price
      })
      return sum
    },
    rows(data) {
      let result = []
      if (data) {
        if (data.orderedLogos) {
          const logos = data.orderedLogos
          const types = [
            ...new Set(logos.map(x => x.logoType.name + ' ' + x.logoSize.name))
          ]
          types.forEach(type => {
            const find = logos.filter(
              x => x.logoType.name + ' ' + x.logoSize.name === type
            )
            result.push({
              logoType: type,
              count: find.length,
              price: find[0].logoType.price
            })
          })
        }
      }
      return result
    },
    mapData() {
      if (this.orders) {
        this.orders.forEach(order => {
          let sizes = []
          if (order.orderedSizes) {
            const filter = order.orderedSizes.filter(x => x.total > 0)
            filter.forEach(size => {
              let sizeRows = []
              let sizeName = size.size
              for (let i = 1; i <= size.total; i++) {
                sizeRows.push({
                  fio: '',
                  number: ''
                })
              }
              sizes.push({
                size: sizeName,
                rows: sizeRows
              })
            })
          }
          this.data.push({
            id: order.id,
            name: order.titleTab,
            sizes: sizes
          })
        })
      }
      this.show = true
    }
  },
  created() {
    // console.log('CREATED FIO-NUMBER')
    // console.log(this.orders)
    // this.mapData()
  }
}
</script>

<style></style>
