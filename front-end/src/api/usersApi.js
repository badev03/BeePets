import instance from "./instance";

const usersApi = {
  getAll(params) {
    const url = "/info-user";
    return instance.get(url, { params });
  },

  get(id) {
    const url = `/info-user/${id}`;
    return instance.get(url);
  },
  
  add(data) {
    const url = "/info-user";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/info-user/${data.id}`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/info-user/${id}`;
    return instance.delete(url);
  },
  getUser(params) {
    const url = "/info-user";
    return instance.get(url,  params );
  },
};

export default usersApi;
