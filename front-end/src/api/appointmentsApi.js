import instance from "./instance";

const appointmentsApi = {
  //lấy tất cả các lịch khám đã được chấp nhận
  getAll(params) {
    const url = "/appoinments";
    return instance.get(url,  params );
  },
  //lấy tất cả các lịch khám chưa được chấp nhận
  getStatus(params) {
    const url = "/appoinments-status";
    return instance.get(url,  params );
  },
 
  get(id) {
    const url = `/appoinment/${id}`;
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
