import instance from "./instance";

const severcesApi = {
  getAll(params) {
    const url = "/severces";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/severces/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/severces";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/severces/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/severces/${id}`;
    return instance.delete(url);
  },
};

export default severcesApi;
