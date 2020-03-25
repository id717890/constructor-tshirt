import Vue from 'vue'
export default {
  createCallback: data => {
    return Vue.$http
      .post('api/callback/create', data)
      .then(x => {
        return x
      })
      .catch(error => {
        return error
      })
  }
}
