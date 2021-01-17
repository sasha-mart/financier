import axios from "axios";

export default {
  create(object) {
    return axios.post("/api/transactions.json", object);
  },
  findAll() {
    return axios.get("/api/transactions");
  }
};