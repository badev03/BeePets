import instance from "./instance";

const usersApi = {
  getAll(params) {
    const url = "/users";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/users/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/users";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/users/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/users/${id}`;
    return instance.delete(url);
  },
};

export default usersApi;
