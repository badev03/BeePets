import instance from "./instance";

const servicesApi = {
  getAll(params) {
    const url = "/services";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/services/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/services";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/services/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/services/${id}`;
    return instance.delete(url);
  },
};

export default servicesApi;
