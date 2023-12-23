import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import Sidebar from "./Sidebar";
import axios from "axios";
import LoadingSkeleton from "../Loading";
import BreadcrumbBar from "../BreadcrumbBar";
const BillDetail = () => {
  const [bill, setBill] = useState({});
  const [products, setProducts] = useState([]);
  const [service, setService] = useState([]);
  const [isLoading, setIsLoading] = useState(true); // Khởi tạo isLoading
  const { id } = useParams();
  const token = localStorage.getItem("token");

  useEffect(() => {
    if (token) {
      const fetchBillDetail = async () => {
        try {
          const response = await axios.get(
            `https://beepets.id.vn/api/detail-bill-user/${id}`,
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );
          setBill(response.data.bill);
          setProducts(response.data.products);
          setService(response.data.service);
          console.log(response);
          setIsLoading(false);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
      fetchBillDetail();
    }
  }, [id, token]);
  function formatDate(dateString) {
    if (dateString) {
      const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
      };
      const formattedDate = new Date(dateString).toLocaleDateString(
        "vi-VN",
        options
      );
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace("lúc", "").trim();
    }
    return "";
  }
  const formatCurrency = (value) => {
    const numberValue = parseFloat(value);
    return numberValue.toLocaleString("vi-VN", {
      style: "currency",
      currency: "VND",
    });
  };
  return (
    <div>
                  <BreadcrumbBar title="CHI TIẾT HÓA ĐƠN" lable="Chi tiết hóa đơn" />

      <div className="content">
        <div className="container">
          <div className="row">
            <Sidebar />
            <div className="col-md-7 col-lg-8 col-xl-9">
              {isLoading ? (
                <LoadingSkeleton />
              ) : (
                <div className="card">
                  <div className="card-body">
                    <form>
                      <div className="row align-items-center mb-4">
                        <div className="col-6">
                        <img
                      src="/assets/img/logo.png"
                      className="img-fluid"
                      alt="Logo"
                  />
                        </div>
                        <div className="col-12 col-md-6">
                          <div className="mb-3" style={{ marginLeft: "140px" }}>
                            <label className="mb-2">
                              Mã hóa đơn: {bill.code}
                            </label>
                            <br />
                            <label className="mb-2">
                              Thời gian tạo: {formatDate(bill.created_at)}
                            </label>
                          </div>
                        </div>
                      </div>
                      <div className="table-responsive">
                        <table
                          className="table table-hover table-center mb-0"
                          style={{ marginTop: "20px" }}
                        >
                          <thead>
                            <tr>
                              <th>Số thứ tự</th>
                              <th>Tên sản phẩm</th>
                              <th>Số lượng</th>
                              <th>Đơn giá</th>
                            </tr>
                          </thead>
                          <tbody>
                            {products.map((product, index) => (
                              <tr key={index}>
                                <td>{index + 1}</td>
                                <td>{product.product_name}</td>
                                <td>{product.quantity}</td>
                                <td>{formatCurrency(product.product_price)}</td>
                              </tr>
                            ))}
                          </tbody>
                        </table>
                      </div>
                      <div className="table-responsive">
                        <table
                          className="table table-hover table-center mb-0"
                          style={{ marginTop: "20px" }}
                        >
                          <thead>
                            <tr>
                              <th>Số thứ tự</th>
                              <th>Tên Dịch vụ</th>
                            
                              <th>Đơn giá</th>
                            </tr>
                          </thead>
                          <tbody>
                            {service.map((product, index) => (
                              <tr key={index}>
                                <td>{index + 1}</td>
                                <td>{product.service_name}</td>
                                
                                <td>{formatCurrency(product.service_price)}</td>
                              </tr>
                            ))}
                          </tbody>
                        </table>
                      </div>
                   
                      <div className="col-12 col-md-12 mt-5">
                        <div className="mb-3"> <label className="mb-2">
                                <strong>Loại thú cưng :</strong>
                              </label>
                              <span style={{marginLeft:"10px"}} >{bill.type_pet_name}</span></div>
                        <div className="mb-3">
                       
                          {bill.status === 3 ? (
                            <>
                              <label className="mb-2">
                                <strong>Lý do hủy</strong>
                              </label>
                              <textarea
                                className="form-control"
                                rows="4"
                                value={bill.cancelReason} // Giả sử lý do hủy được lưu trong thuộc tính cancelReason của đối tượng bill
                                readOnly // Nếu bạn muốn ô textarea chỉ đọc
                              />
                            </>
                          ) : (
                            <>
                              <label className="mb-2">
                                <strong>Ghi chú :</strong>
                              </label>
                              <span style={{marginLeft:"10px"}} dangerouslySetInnerHTML={{ __html: bill.description }} />

                            </>
                          )}
                        </div>
                      </div>
                      <div className="col-12 col-md-12 text-end mt-4">
                        <label className="mb-2">
                          <strong>
                            Tổng tiền: {formatCurrency(bill.total_amount)}{" "}
                          </strong>
                        </label>
                      </div>
                    </form>
                    <Link to={`/user/dashbroad`}>
                      {" "}
                      <button
                        type="reset"
                        className="btn btn-success submit-btn"
                      >
                        Quay lại
                      </button>
                    </Link>
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default BillDetail;
