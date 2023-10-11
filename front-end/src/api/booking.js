import instance from "./instance";

const Booking = {
  
  add(data) {
    const url = "/form";
    return instance.post(url, data);
  },

};

export default Booking;
