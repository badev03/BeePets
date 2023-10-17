import instance from "./instance";

const listCustomersApi = {
  getAll(params) {
    const url = "/list-customers";
    return instance.get(url, { params });
  },

  get(id,params ) {
    const url = `/get-customer/${id}`;
    return instance.get(url,  params);
  },
  
  add(data) {
    const url = "/list-customers";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/list-customers/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/list-customers/${id}`;
    return instance.delete(url);
  },
  getlistCustomers(params) {
    const url = "/list-customers";
    return instance.get(url,  params );
  },
  
};

export default listCustomersApi;
