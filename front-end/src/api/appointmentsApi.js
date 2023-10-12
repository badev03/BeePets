import instance from "./instance";

const appointmentsApi = {
  //lấy tất cả các lịch khám đã được chấp nhận
  getAll(params) {
    const url = "/list-appiontment-doctor";
    return instance.get(url,  params );
  },
  //lấy tất cả các lịch khám chưa được chấp nhận
  getStatus(params) {
    const url = "/appoinments-status";
    return instance.get(url,  params );
  },
 
  get(id,params ) {
    const url = `/appoinment/${id}`;
    return instance.get(url,  params);
  },
  
  add(data) {
    const url = "/appointments";
    return instance.post(url, data);
  },

  update(data) {
    const url = `/update-appointment/${data.id}?status=1`;
    return instance.patch(url, data);
  },

  remove(id) {
    const url = `/appointments/${id}`;
    return instance.delete(url);
  },
};

export default appointmentsApi;
