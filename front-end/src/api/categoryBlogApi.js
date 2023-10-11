import instance from "./instance";

const blogCategoryApi = {
  getAll(params) {
    const url = "/new-categories";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/new-categories/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/new-categories";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/new-categories/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/new-categories/${id}`;
    return instance.delete(url);
  },
};

export default blogCategoryApi;
