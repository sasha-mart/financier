import axios from 'axios'

export default {
  create (object) {
    return axios.post('http://financier.localhost:8100/api/categories.json', object)
  },
  findAll () {
    return axios.get('http://financier.localhost:8100/api/categories')
  }
}
