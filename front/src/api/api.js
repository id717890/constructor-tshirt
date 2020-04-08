import Vue from 'vue'
export default {
  getTypes: () => {
    return Vue.$http
      .get('api/types')
      .then(x => {
        return x.data
      })
      .catch(error => {
        return error
      })
  }
}
