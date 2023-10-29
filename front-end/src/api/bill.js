import instance from "./instance";

const billApi = {
    getBill(params) {
        const url = "/bill-user";
        return instance.get(url,  params );
      },
    getBillPatient(id,params) {
      const url = `/bills/${id}`;
      return instance.get(url,  params );
    },
    getBillDetail(id,params) {
      const url = `/detail-bill/${id}`;
      return instance.get(url,  params );
    },
    getProduct(params) {
      const url = "/get-products";
      return instance.get(url,  params );
    },

    updateBill(id, data, params) {
      const url = `/update-bill/${id}`;
      return instance.post(url, data, params);
    },


    
};

export default billApi;
