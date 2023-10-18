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
  getDoctorService(params) {
    const url = "/doctor-service";
    return instance.post(url, { params });
  },

  async getWorkingHours(doctorId, date) {
    const url = "/doctors-service";
    const formData = new FormData();
    formData.append("doctor_id", doctorId);
    formData.append("date", date);

    try {
      const response = await instance.post(url, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      });
      return response.data;
    } catch (error) {
      console.error("Không có dữ liệu ca làm việc:", error);
      throw error;
    }
  },

  async saveBooking(bookingData) {
    const url = "/save";  

    try {
      const response = await instance.post(url, bookingData);
      // console.log(response);
      return response.data;
    } catch (error) {
      console.error("Error while saving booking:", error);
      throw error;
    }
  },
};

export default BookingApi;
