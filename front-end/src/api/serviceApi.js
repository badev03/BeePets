import instance from "./instance";

const serviceApi = {
  getAll(params) {
    const url = "/service";
    return instance.get(url, { params });
  },
  getHome(params) {
    const url = "/service-show";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/service/${id}`;
    return instance.get(url);
  },

  add(data) {
    const url = "/service";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/service/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/service/${id}`;
    return instance.delete(url);
  },
};

export default serviceApi;
