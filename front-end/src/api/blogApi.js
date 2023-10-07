import instance from "./instance";

const blogApi = {
  getAll(params) {
    const url = "/blog";
    return instance.get(url, { params });
  },
  get(id) {
    const url = `/blog/${id}`;
    return instance.get(url);
  },
  add(data) {
    const url = "/blog";
    return instance.post(url, data);
  },
  update(data) {
    const url = `/blog/${data.id}`;
    return instance.patch(url, data);
  },
  remove(id) {
    const url = `/blog/${id}`;
    return instance.delete(url);
  },
};

export default blogApi;
