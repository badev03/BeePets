import { useRef } from "react";
// import Menudashboard from "./Menu-dashboard";
import axios from "axios";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import billApi from "../../api/bill";
import LoadingSkeleton from "../Loading";
import { useReactToPrint } from "react-to-print";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { FaSpinner } from 'react-icons/fa';
const MySwal = withReactContent(Swal);
const DetailBIll = () => {
  const { id } = useParams();
  const [bill, setBill] = useState({});
  const [service, setService] = useState([]);
  const [loading, setLoading] = useState(true);
  const [loadingId, setLoadingId] = useState(null);
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
      console.log(response);
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
  const handleUpdate = async (id) => {
    console.log(id);
    setLoadingId(id);
    try {
      const respon = await axios.put(
        `http://127.0.0.1:8000/api/update-appointment/${id}?status=3`,
        {},
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        },
      );
    fetchBill();
     
      MySwal.fire({
        title: "Cuộc hẹn đã hoàn thành!",
        icon: "success",
      });
   

    } catch (error) {
      console.log(error);
    }finally {
      setLoadingId(null);
    }
  };
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
                          <h4 className="d-block">
                            {" "}
                            Lịch khám : {bill.appointment.shift_name}
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
                    
                    {bill.prescriptions &&
  bill.prescriptions.length > 0 &&
  bill.prescriptions.map((prescription, prescriptionIndex) => (
    <div className="col-sm-12" style={{ marginTop: "30px" }} key={prescriptionIndex}>
      <div className="biller-info">
        <h4 className="d-block">Tên đơn thuốc : {prescription.name}</h4>
      </div>
      {prescription.productss && prescription.productss.length > 0 && (
        <div className="card card-table">
          <div className="card-body">
            <div className="table-responsive">
              <table className="table table-hover table-center add-table-prescription">
                <thead>
                  <tr>
                    <th >Stt</th>
                    <th className="table-name">Tên loại thuốc</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                    <th>Tổng tiền</th>
                    <th className="table-name">Hướng dẫn sử dụng</th>
                  </tr>
                </thead>
                <tbody>
                  {prescription.productss.map((pres, index) => (
                    <tr className="test" key={index}>
                      <td>{index + 1}</td>
                      <td>{pres.name}</td>
                      <td>{pres.pivot.quantity}</td>
                      <td>{formatCurrency(pres.pivot.price)}</td>
                      <td>{formatCurrency(pres.pivot.quantity * pres.price)}</td>
                      <td>{pres.pivot.instructions}</td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      )}
      {prescription.productss && prescription.productss.length > 0 && (
        <div className="add-more-item text-end">
          <div className="biller-info">
            <h4 className="d-block">
              Tổng tiền đơn thuốc : {formatCurrency(prescription.price)}{" "}
            </h4>
          </div>
        </div>
      )}
    </div>
  ))}

{service && service.length > 0 && (
  <div className="card card-table">
    <div className="card-body">
      <div className="table-responsive">
        <table className="table table-hover table-center add-table-prescription">
          <thead>
            <tr>
            <th className="table-name">Stt</th>
              <th className="table-name">Tên dịch vụ</th>
              <th className="table-name">Giá tiền</th>
            </tr>
          </thead>
          <tbody>
            {service.map((ser, index) => (
              <tr className="test" key={index}>
                              <td>{index + 1}</td>
                <td>{ser.name}</td>
                <td>{formatCurrency(ser.price)}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  </div>
)}
                    <div className="row">
  <div >
    <div className="card-body">
      <h3 className="card-title">Ghi chú : {bill.description}</h3>
    
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

                 
              <Link style={{color:"white" ,marginRight:"10px"}} to={`/doctors/appointments`}>
              <button
              type="submit"
              className="btn btn-secondary submit-btn"
              
            >
              Quay Lại
            </button>

              </Link>
            {bill.appointment.status == 1 && (
       
            <button
              type="submit"
              className="btn btn-primary submit-btn"
              onClick={() => handleUpdate(bill.appointment.id) }
            >
            
              {loadingId === bill.id ? (
                <div className="loading-spinner">
                <FaSpinner className="spinner" /> 
              </div>
              ) : (
                <>
                   Hoàn thành
                </>
              )}
            </button>
        
          
        )}
             {bill.appointment.status == 3 && (
      
            <button
              type="submit"
              className="btn btn-primary submit-btn"
              onClick={generatePDF}
            >
              In
            </button>
        
        )}
            </div>
    </div>
  );
};

export default DetailBIll;
