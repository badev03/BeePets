import instance from "./instance";

const doctorsApi = {
  getAll(params) {
    const url = "/doctors";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/doctors/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/doctors";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/doctors/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/doctors/${id}`;
    return instance.delete(url);
  },
};

export default doctorsApi;
