import instance from "./instance";

const blogCategoryApi = {
  getAll(params) {
    const url = "/news_categories";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/news_categories/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/news_categories";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/news_categories/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/news_categories/${id}`;
    return instance.delete(url);
  },
};

export default blogCategoryApi;
