<template>
  <section>
    <v-simple-table v-if="data && data.length > 0">
      <template v-slot:default>
        <thead>
          <tr>
            <th style="width: 200px; font-size: 1.2rem">
              Размерный ряд
            </th>
            <th
              v-for="size in data"
              :key="size.id"
              style="font-size: 1rem"
              class="pa-1"
            >
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <div v-on="on">
                    {{ size.size }}
                  </div>
                </template>
                <span v-html="getHint(size.size)"></span>
              </v-tooltip>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="font-size: 1.2rem">Склад Москва</td>
            <td v-for="size in data" :key="size.id">{{ size.inMoscow }}</td>
          </tr>
          <tr>
            <td style="font-size: 1.2rem">Склад Испания</td>
            <td v-for="size in data" :key="size.id">{{ size.inSpain }}</td>
          </tr>
          <tr>
            <td style="font-size: 1.2rem; font-weight: bold">ЗАКАЗ</td>
            <td v-for="size in data" :key="size.id">
              <v-text-field
                type="number"
                min="0"
                v-model="size.total"
                @input="changeOrder($event, size)"
              ></v-text-field>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <h2 class="text-center my-6" v-else>Размеры отсутствуют</h2>
  </section>
</template>

<script>
export default {
  props: ['sizes', 'model'],
  data: () => ({
    data: [],
    hints: hintsData
  }),
  // watch: {
  //   sizes(values) {
  //     console.log('WATCHED')
  //   }
  // },
  created() {
    // console.log('CREATED')
    // console.log(this.sizes)
    this.data = []
    this.copyArray(this.sizes)
  },
  mounted() {
    // console.log('MOUNTED')
  },
  updated() {},
  beforeUpdate() {
    // console.log('BEFORE UPDATED')
    this.data = []
    this.copyArray(this.sizes)
  },
  methods: {
    copyArray(array) {
      if (array) {
        array.forEach(x => {
          let obj = {}
          obj.id = x.id
          obj.size = x.size
          obj.price = x.price
          obj.discount = this.model.discount
          obj.count = x.count
          obj.inMoscow = 0
          obj.inSpain = 0
          obj.total = 0
          if (this.model.discount && this.model.discount > 0) {
            obj.price_discount = x.price - (x.price * this.model.discount) / 100
          } else obj.price_discount = x.price
          this.data.push(obj)
        })
      }
    },
    changeOrder(e, order) {
      let ordered = 0
      let val = !e ? 0 : e
      try {
        ordered = parseInt(val)
      } catch {}
      order.total = ordered
      if (ordered > order.count) {
        order.inMoscow = order.count
        order.inSpain = ordered - order.count
      } else {
        order.inMoscow = ordered
        order.inSpain = 0
      }
      this.$emit('changeOrderedSizes', this.data)
    },
    mapResult() {
      return this.data.filter(x => x.total > 0)
    },
    mapData(data) {
      let result = []
      if (data) {
        result = data.map(x => {
          this.$set(x, 'total', 0)
          this.$set(x, 'inMoscow', 0)
          this.$set(x, 'inSpain', 0)
          return x
        })
      }
      return result
    },
    getHint(key) {
      const find = this.hints.find(
        x => x.size.toLowerCase() === key.toLowerCase()
      )
      if (find) return find.hint
      return '????'
    }
  },
  watch: {
    sizes(values) {
      // this.data = this.mapData(values)
    }
  }
}

const hintsData = [
  {
    size: '6XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>Возраст</td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Дети</td><td>4</td><td>30</td><td>100-108</td><td>55-58</td><td>54-55</td></tr></table>"
  },
  {
    size: '6XS-5XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>Возраст</td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Дети</td><td>6-8</td><td>30-32</td><td>100-117</td><td>55-62</td><td>54-58</td></tr></table>"
  },
  {
    size: '5XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>Возраст</td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Дети</td><td>6</td><td>32</td><td>109-117</td><td>58-62</td><td>55-58</td></tr></table>"
  },
  {
    size: '4XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>Возраст</td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Дети</td><td>8</td><td>34</td><td>118-128</td><td>62-77</td><td>58-60</td></tr></table>"
  },
  {
    size: '4XS-3XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>Возраст</td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Дети</td><td>8-10</td><td>34-36</td><td>118-140</td><td>62-73</td><td>58-64</td></tr></table>"
  },
  {
    size: '3XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>Возраст</td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Дети</td><td>10</td><td>36</td><td>129-140</td><td>67-73</td><td>60-64</td></tr></table>"
  },
  {
    size: '2XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>Возраст</td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Дети</td><td>12</td><td>38</td><td>141-152</td><td>73-78</td><td>64-68</td></tr></table>"
  },
  {
    size: 'XS',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td></td><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Жен.</td><td></td><td>40-42</td><td>158-162</td><td>76-82</td><td>61-68</td></tr><tr><td>Дети</td><td>14</td><td>40-42</td><td>152-164</td><td>80-87</td><td>68-72</td></tr></table>"
  },
  {
    size: 'S',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Муж.</td><td>44-46</td><td>164-173</td><td>88-95</td><td>75-82</td></tr><tr><td>Жен.</td><td>44</td><td>162-164</td><td>83-89</td><td>69-73</td></tr></table>"
  },
  {
    size: 'M',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Муж.</td><td>46-48</td><td>173-178</td><td>95-102</td><td>83-90</td></tr><tr><td>Жен.</td><td>46-48</td><td>164-166</td><td>90-94</td><td>74-78</td></tr></table>"
  },
  {
    size: 'L',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Муж.</td><td>48-50</td><td>178-184</td><td>102-108</td><td>91-97</td></tr><tr><td>Жен.</td><td>50</td><td>166-168</td><td>95-98</td><td>79-82</td></tr></table>"
  },
  {
    size: 'XL',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Муж.</td><td>50-52</td><td>184-189</td><td>108-115</td><td>98-103</td></tr><tr><td>Жен.</td><td>52-54</td><td>169-172</td><td>99-102</td><td>83-86</td></tr></table>"
  },
  {
    size: '2XL',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Муж.</td><td>54</td><td>182-189</td><td>115-120</td><td>104-134</td></tr><tr><td>Жен.</td><td>56</td><td>172-178</td><td>105-110</td><td>87-90</td></tr></table>"
  },
  {
    size: '3XL',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td><td>ТАЛИЯ</td></th><tr><td>Муж.</td><td>54-56</td><td>194-198</td><td>143-155</td><td>134-150</td></tr></table>"
  },
  {
    size: '2XL-3XL',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td><td>ГРУДЬ</td></th><tr><td>Муж.</td><td>54-56</td><td>189-195</td><td>115-125</td></tr><tr><td>Жен.</td><td>54-56</td><td>175-180</td><td>105-110</td></tr></table>"
  },
  {
    size: '4XL',
    hint:
      "<table class='table table-dark table-hint m-0'><th><td>РФ</td><td>РОСТ</td></th><tr><td>Муж.</td><td>56-58</td><td>195-200</td></tr></table>"
  }
]
</script>
