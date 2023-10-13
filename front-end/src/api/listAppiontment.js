import instance from "./instance";

const listAppiontmentApi = {
  getAll(params) {
    const url = "/list-appiontment";
    return instance.get(url, { params });
  },

  get(id,params ) {
    const url = `/list-appiontment/${id}`;
    return instance.get(url,  params);
  },
  
  add(data) {
    const url = "/list-appiontment";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/list-appiontment/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/list-appiontment/${id}`;
    return instance.delete(url);
  },
  getListAppiontment(params) {
    const url = "/list-appiontment";
    return instance.get(url,  params );
  },
};

export default listAppiontmentApi;
