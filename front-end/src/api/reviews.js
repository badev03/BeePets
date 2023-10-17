import instance from "./instance";

const reviewsApi = {
  getAll(params) {
    const url = "/reviews";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/reviews/${id}`;
    return instance.get(url);
  },

  add(data) {
    const url = "/reviews";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/reviews/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/reviews/${id}`;
    return instance.delete(url);
  },
};

export default reviewsApi;
