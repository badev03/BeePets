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
  
};

export default blogCategoryApi;
