import instance from "./instance";

const BookingApi = {
  getTypePet(params) {
    const url = "/type-pets";
    return instance.get(url, { params });
  },

  getServiceDoctor(params) {
    const url = "/services-doctor";
    return instance.get(url, { params });
  },

  async getWorkingHours(doctorId, date) {
    const url = "/doctors-service";
    const formData = new FormData();
    // formData.append("doctor_id", 5);
    formData.append("doctor_id", doctorId.toString());
    formData.append("date", date.toString());
    
    // console.log(doctorId);
    // console.log(date);
 

    try {
      const response = await instance.post(url, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
      return response.data;
    } catch (error) {
      console.error("Không có dữ liệu ca làm việc1:", error);
      throw error;
    }
  },
};

export default BookingApi;
