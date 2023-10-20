import instance from "./instance";

const blogApi = {
  getAll(params) {
    const url = "/new";
    return instance.get(url, { params });
  },

  get(slug) {
    const url = `/new/${slug}`;
    return instance.get(url);
  },
  
  search(name) {
    const url = `/new-search/${name}`;
    return instance.get(url);
  },
};

export default blogApi;
