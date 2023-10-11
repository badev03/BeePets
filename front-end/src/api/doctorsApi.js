import instance from "./instance";

const doctorsApi = {
  getAll(params) {
    const url = "/doctors-clients";
    return instance.get(url, { params });
  },
  getDoctor(params) {
    const url = "/doctor-info";
    return instance.get(url, { params });
  },
  get(id) {
    const url = `/doctors-clients/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/doctors-clients";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/doctors-clients/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/doctors-clients/${id}`;
    return instance.delete(url);
  },
};

export default doctorsApi;
