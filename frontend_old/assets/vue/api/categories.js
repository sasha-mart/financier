import axios from "axios";

export default {
  create(object) {
    return axios.post("/api/categories.json", object);
  },
  findAll() {
    return axios.get("/api/categories");
  }
};