import { useRef } from "react";
// import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import billApi from "../../api/bill";
import LoadingSkeleton from "../Loading";
import { useReactToPrint } from "react-to-print";
import appointmentsApi from "../../api/appointmentsApi";
const DetailPrescription = () => {
    const { id } = useParams();
    const [bill, setBill] = useState({});
    const [prescription, setPrescription] = useState([]);
    const [loading, setLoading] = useState(true);
    const componetPDF = useRef();
  
    const generatePDF = useReactToPrint({
      content: () => componetPDF.current,
      documentTitle: "UserData",
      onAfterPrint: () => alert("Dữ liệu đã được lưu vào PDF"),
    });
  
    const token = localStorage.getItem("token");

    const fetchPrescription = async () => {
      try {
        const response = await appointmentsApi.getPresDetail(id, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setPrescription(response.prescription_product);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };
    console.log(prescription);
    const fetchBill = async () => {
      try {
        const response = await appointmentsApi.getPresDetail(id, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setBill(response.prescription);
       
        setLoading(false);
  
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };
    console.log(bill);
    useEffect(() => {
      fetchBill();
      fetchPrescription();

    }, []);
    const formatCurrency = (value) => {
      const numberValue = parseFloat(value);
      return numberValue.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    };
    function formatDate(dateString) {
      if (dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        const formattedDate = new Date(dateString).toLocaleDateString('vi-VN', options);
        // Loại bỏ từ "lúc" từ chuỗi được định dạng
        return formattedDate.replace('lúc', '').trim();
      }
      return '';
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
          <div className="content" >
            <div ref={componetPDF}>
              <div className="container">
                <div >
                  {/* <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                    <div className="card widget-profile pat-widget-profile">
                      <div className="card-body">
                        <div style={{ display: "none" }}>
                        <Menudashboard />
                        </div>
                        <div className="pro-widget-content">
                          <div className="profile-info-widget">
                            <Link to="#" className="booking-doc-img">
                              <img src={bill.avatar} alt="User Image" />
                            </Link>
                            <div className="profile-det-info">
                              <h3>{bill.user_name}</h3>
                            </div>
                          </div>
                        </div>
                        <div className="patient-info">
                          <ul>
                            <li>
                              SĐT <span>{bill.user_phone}</span>
                            </li>
                          </ul>
                        </div>
                        
                      </div>
                    </div>
                  </div> */}
                  <div >
                    <div className="card">
                      <div className="card-header">
                        <h2 className="card-title mb-0">Chi tiết đơn thuốc</h2>
                      </div>
                      <div className="card-body">
                        <div className="row">
                          <div className="col-sm-6">
                            <div className="biller-info">
                            <h4 className="d-block"> Tên bác sĩ : {bill.doctor.name}</h4>
                              <h4 className="d-block"> Tên khách hàng : {bill.user.name}</h4>
                            </div>
                          </div>
                          <div className="col-sm-6 text-sm-end">
                            <div className="billing-info">
                            <h4 className="d-block">Thời gian tạo : {formatDate(bill.created_at)}</h4>
                            
                            </div>
                          </div>
                          <div className="col-sm-6" style={{marginTop:"30px"}}>
                            <div className="biller-info">
                            <h4 className="d-block">Tên đơn thuốc : {bill.name}</h4>
                            </div>
                          </div>
                        </div>
                        <div className="card card-table">
                          <div className="card-body">
                            <div className="table-responsive">
                              <table className="table table-hover table-center add-table-prescription">
                                <thead>
                                  <tr>
                                    <th className="table-name">Tên loại thuốc</th>
                                    <th>Số lượng</th>
                                    <th >Giá tiền</th>
                                    <th >Tổng tiền</th>
                                    <th className="table-name">
                                      Hướng dẫn sử dụng
                                    </th>
                                    {/* <th>Action</th> */}
                                  </tr>
                                </thead>
                                <tbody>
                                  {prescription.map((pres, index) => (
                                    <tr className="test" key={index}>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={pres.product_name}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={pres.quantity}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={pres.price}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={
                                            pres.quantity * pres.price_product
                                          }
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          defaultValue={pres.instructions}
                                        />
                                      </td>
                                    </tr>
                                  ))}
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div className="add-more-item text-end">
                          <div className="biller-info">
                          <h4 className="d-block">Tổng tiền đơn thuốc : {formatCurrency(bill.prescriptions_price)} </h4>
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
    

export default DetailPrescription