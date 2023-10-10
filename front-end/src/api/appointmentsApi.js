import instance from "./instance";

const appointmentsApi = {
  getAll(params) {
    const url = "/appointments";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/appointments/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/appointments";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/appointments/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/appointments/${id}`;
    return instance.delete(url);
  },
};

export default appointmentsApi;
