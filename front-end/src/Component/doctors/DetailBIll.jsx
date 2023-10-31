import { useRef } from "react";
// import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import billApi from "../../api/bill";
import LoadingSkeleton from "../Loading";
import { useReactToPrint } from "react-to-print";

const DetailBIll = () => {
  const { id } = useParams();
  const [bill, setBill] = useState({});
  const [service, setService] = useState([]);
  const [loading, setLoading] = useState(true);
  const componetPDF = useRef();

  const generatePDF = useReactToPrint({
    content: () => componetPDF.current,
    documentTitle: "UserData",
    onAfterPrint: () => alert("Dữ liệu đã được lưu vào PDF"),
  });

  const token = localStorage.getItem("token");

  const fetchBill = async () => {
    try {
      const response = await billApi.getBillDetail(id, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      setBill(response.bill);
      setService(response.services);

      setLoading(false);
    } catch (error) {
      console.error("Không có dữ liệu:", error);
    }
  };

  useEffect(() => {
    fetchBill();
  }, []);
  const formatCurrency = (value) => {
    const numberValue = parseFloat(value);
    return numberValue.toLocaleString("vi-VN", {
      style: "currency",
      currency: "VND",
    });
  };
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
        options,
      );
      // Loại bỏ từ "lúc" từ chuỗi được định dạng
      return formattedDate.replace("lúc", "").trim();
    }
    return "";
  }
  if (loading) {
    return (
      <div>
        {" "}
        <LoadingSkeleton />
      </div>
    );
  }

  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Chi tiết hóa đơn</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/">Trang chủ</Link>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Chi tiết hóa đơn
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div className="content">
        <div ref={componetPDF}>
          <div className="container">
            <div>
              <div>
                <div className="card">
                  <div className="card-header">
                    <h2 className="card-title mb-0">Chi tiết hóa đơn</h2>
                  </div>
                  <div className="card-body">
                    <div className="row">
                      <div className="col-sm-6">
                        <div className="biller-info">
                          <h4 className="d-block">
                            {" "}
                            Tên bác sĩ : {bill.doctor.name}
                          </h4>
                          <h4 className="d-block">
                            {" "}
                            Tên khách hàng : {bill.appointment.user.name}
                          </h4>
                        </div>
                      </div>
                      <div className="col-sm-6 text-sm-end">
                        <div className="billing-info">
                          <h4 className="d-block">
                            Thời gian tạo : {formatDate(bill.created_at)}
                          </h4>
                          <span className="d-block text-muted">
                            Mã hóa đơn : {bill.code}
                          </span>
                          <h4 className="d-block">
                            Trạng thái :{" "}
                            {bill.appointment.status == 1 ? (
                              <span className="badge rounded-pill bg-success-light">
                                Xác nhận
                              </span>
                            ) : bill.appointment.status == 2 ? (
                              <span className="badge rounded-pill bg-danger-light">
                                Đã xóa
                              </span>
                            ) : bill.appointment.status == 3 ? (
                              <span className="badge rounded-pill bg-primary-light">
                                Đã hoàn thành
                              </span>
                            ) : bill.appointment.status == 6 ? (
                              <span className="badge rounded-pill bg-warning-light">
                                Yêu cầu hủy
                              </span>
                            ) : bill.appointment.status == 7 ? (
                              <span className="badge rounded-pill bg-info-light">
                                Yêu cầu đổi lịch
                              </span>
                            ) : (
                              // Default case
                              <span className="badge rounded-pill bg-info-light">
                                Không xác định
                              </span>
                            )}
                          </h4>
                        </div>
                      </div>
                    </div>
                    {bill.prescriptions && bill.prescriptions.length > 0 && (
                      <div className="col-sm-6" style={{ marginTop: "30px" }}>
                        <div className="biller-info">
                          <h4 className="d-block">
                            Tên đơn thuốc : {bill.prescriptions[0].name}
                          </h4>
                        </div>
                      </div>
                    )}

                    {bill.prescriptions && bill.prescriptions.length > 0 && (
                      <div className="card card-table">
                        <div className="card-body">
                          <div className="table-responsive">
                            <table className="table table-hover table-center add-table-prescription">
                              <thead>
                                <tr>
                                  <th className="table-name">Tên loại thuốc</th>
                                  <th>Số lượng</th>
                                  <th>Giá tiền</th>
                                  <th>Tổng tiền</th>
                                  <th className="table-name">
                                    Hướng dẫn sử dụng
                                  </th>
                                  {/* <th>Action</th> */}
                                </tr>
                              </thead>
                              <tbody>
                                {bill.prescriptions[0].productss.map(
                                  (pres, index) => (
                                    <tr className="test" key={index}>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={pres.name}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={pres.pivot.quantity}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={formatCurrency(
                                            pres.pivot.price,
                                          )}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={formatCurrency(
                                            pres.pivot.quantity * pres.price,
                                          )}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={pres.pivot.instructions}
                                        />
                                      </td>
                                    </tr>
                                  ),
                                )}
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    )}
                    {bill.prescriptions && bill.prescriptions.length > 0 && (
                      <div className="add-more-item text-end">
                        <div className="biller-info">
                          <h4 className="d-block">
                            Tổng tiền đơn thuốc :{" "}
                            {formatCurrency(bill.prescriptions[0].price)}{" "}
                          </h4>
                        </div>
                      </div>
                    )}

                    {service && service.length > 0 && (
                      <div className="card card-table">
                        <div className="card-body">
                          <div className="table-responsive">
                            <table className="table table-hover table-center add-table-prescription">
                              <thead>
                                <tr>
                                  <th className="table-name">Tên dịch vụ</th>
                                  <th>Lịch khám</th>
                                  <th className="table-name">Giá tiền</th>
                                  {/* <th className="table-name">Mô tả</th> */}
                                  {/* <th>Action</th> */}
                                </tr>
                              </thead>
                              <tbody>
                                <tr className="test">
                                  <td>
                                    <input
                                      className="form-control"
                                      type="text"
                                      defaultValue={service[0].name}
                                    />
                                  </td>
                                  <td>
                                    <input
                                      className="form-control"
                                      type="text"
                                      defaultValue={bill.appointment.shift_name}
                                    />
                                  </td>
                                  <td>
                                    <input
                                      className="form-control"
                                      type="text"
                                      defaultValue={formatCurrency(
                                        service[0].price,
                                      )}
                                    />
                                  </td>
                                  {/* <td>
                                    <input
                                      className="form-control"
                                      type="text"
                                      defaultValue={service.description}
                                    />
                                  </td> */}
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    )}
                    <div className="row">
                      <div className="card">
                        <div className="card-body">
                          <h4 className="card-title">Kết quả</h4>
                          <div className="mb-0">
                            <textarea
                              className="form-control"
                              rows={5}
                              defaultValue={bill.description}
                            />
                          </div>
                        </div>
                      </div>
                      <div className="add-more-item text-end">
                        <div className="biller-info">
                          <h2 className="d-block">
                            Tổng tiền : {formatCurrency(bill.total_amount)}
                          </h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className="submit-section submit-section2">
        <button
          type="submit"
          className="btn btn-primary submit-btn"
          onClick={generatePDF}
        >
          In
        </button>
      </div>
    </div>
  );
};

export default DetailBIll;
