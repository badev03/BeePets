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
  getAcceptAppointment(id,params ) {
    const url = `/get-appiontment/${id}`;
    return instance.get(url,  params);
  },
  get(id,params ) {
    const url = `/appoinment/${id}`;
    return instance.get(url,  params);
  },
  getAppoinmentsUser(id,params) {
    const url = `/list-appiontment/${id}`;
    return instance.get(url, params);
  },
  getPres(id,params) {
    const url = `/prescription/${id}`;
    return instance.get(url, params);
  },
  getPresDetail(id,params) {
    const url = `/detail-prescription-doctor/${id}`;
    return instance.get(url, params);
  },

};

export default appointmentsApi;
