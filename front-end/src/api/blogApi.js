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
  
  search(params) {
    const url = "/new-search";
    return instance.get(url, { params });
  },
};

export default blogApi;
