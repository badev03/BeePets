import instance from "./instance";

const blogApi = {
  getAll(params) {
    const url = "/new-post";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/new-post/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/new-post";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/new-post/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/new-post/${id}`;
    return instance.delete(url);
  },
};

export default blogApi;
