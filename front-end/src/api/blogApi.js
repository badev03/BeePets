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
  
  search(name) {
    const url = `/new-search/${name}`;
    return instance.get(url);
  },
};

export default blogApi;
