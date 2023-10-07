import instance from "./instance";

const blogApi = {
  getAll(params) {
    const url = "/news";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/news/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/news";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/news/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/news/${id}`;
    return instance.delete(url);
  },
};

export default blogApi;
