import axios from "axios";

const apiUrl = "https://beepets.id.vn/api/";

const DoctorInfoApi = {
  getAll(token) {
    const url = apiUrl + "doctor-info";
    const tokenApi = token;
    const config = {
      headers: {
        Authorization: `Bearer ${tokenApi}`,
      },
    };
    return axios.get(url, config);
  },
};

export default DoctorInfoApi;
