import instance from "./instance";

const doctorsApi = {
  getAll(params) {
    const url = "/doctors-clients";
    return instance.get(url, { params });
  },
  getDoctor(params) {
    const url = "/doctor-info";
    return instance.get(url, params);
  },
  get(id) {
    const url = `/doctors-clients/${id}`;
    return instance.get(url);
  },

  addReviews(data ,params) {
    const url = "/reviews";
    return instance.post(url, data,params);
  },

};

export default doctorsApi;
