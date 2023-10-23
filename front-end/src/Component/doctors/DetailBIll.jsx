import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import billApi from '../../api/bill';
const DetailBIll = () => {
    const { id } = useParams();
    const [bill, setBill] = useState(null);

    const token = localStorage.getItem('token');


  
     useEffect(() => {
      const fetchBill = async () => {
        try {
         const response = await billApi.getBillDetail(id,
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setBill(response.bill);     
        console.log(response.bill.code);
      

        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      fetchBill();
    }, []); 
        console.log(bill)
        if (!bill) {
            return <div>Loading...</div>;
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
          <div className="container">
            <div className="row">
              <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                <div className="card widget-profile pat-widget-profile">
                  <div className="card-body">
                    <Menudashboard />
                    {/* <div className="pro-widget-content">
                      <div className="profile-info-widget">
                        <Link to="#" className="booking-doc-img">
                          <img src="/img/patients/patient.jpg" alt="User Image" />
                        </Link>
                        <div className="profile-det-info">
                          <h3>Richard Wilson</h3>
                          <div className="patient-details">
                            <h5>
                              <b>Patient ID :</b> PT0016
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="patient-info">
                      <ul>
                        <li>
                          SĐT <span>+1 952 001 8563</span>
                        </li>
                      </ul>
                    </div> */}
                  </div>
                </div>
              </div>
              <div className="col-md-7 col-lg-8 col-xl-9">
                <div className="card">
                  <div className="card-header">
                    <h4 className="card-title mb-0">Chi tiết hóa đơn</h4>
                  </div>
                  <div className="card-body">
                    <div className="row">
                      <div className="col-sm-6">
                        <div className="biller-info">
                          <h4 className="d-block">{bill.user_name}</h4>
                        </div>
                      </div>
                      <div className="col-sm-6 text-sm-end">
                        <div className="billing-info">
                          <h4 className="d-block">{bill.date}</h4>
                          <span className="d-block text-muted">{bill.code}</span>
                        </div>
                      </div>
                    </div>
                    {/* <div className="add-more-item text-end">
                      <a
                        onClick={addPrescriptionRow}
                        className="add-prescription"
                      >
                        <i className="fas fa-plus-circle" /> Thêm đơn thuốc
                      </a>
                    </div> */}
  
                    <div className="card card-table">
                      <div className="card-body">
                        <div className="table-responsive">
                          <table className="table table-hover table-center add-table-prescription">
                            <thead>
                              <tr>
                                <th className="table-name">Tên loại thuốc</th>
                                <th>Số lượng</th>
                                <th className="table-name">Giá tiền</th>
                                <th className="table-name">Tổng tiền</th>
                                <th className="table-name">Hướng dẫn sử dụng</th>
                                {/* <th>Action</th> */}
                              </tr>
                            </thead>
                            <tbody>
                            <tr className="test">
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" />
                                                            </td>
                                                            <td>
                                                            <input className="form-control" type="text" />
                                                            </td> 
                                                            <td>
                                                            <input className="form-control" type="text" />
                                                            </td>
                                                            {/* <td>
                                                                <Link to="#" className="btn bg-danger-light trash"><i className="far fa-trash-alt" /></Link>
                                                            </td> */}
                                                        </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    {/* <div className="add-more-item text-end">
                      <a onClick={addServiceRow} className="add-prescription">
                        <i className="fas fa-plus-circle" /> Thêm dịch vụ
                      </a>
                    </div> */}
                    <div className="card card-table">
                      <div className="card-body">
                        <div className="table-responsive">
                          <table className="table table-hover table-center add-table-prescription">
                            <thead>
                              <tr>
                                <th className="table-name">Tên dịch vụ</th>
                                <th>Lịch khám</th>
                                <th className="table-name">Giá tiền</th>
                                <th className="table-name">Mô tả</th>
                                {/* <th>Action</th> */}
                              </tr>
                            </thead>
                            <tbody>
                            <tr className="test">
                                                            <td>
                                                                <input className="form-control" type="text" value={bill.service_name}/>
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" value={bill.shift_name} />
                                                            </td>
                                                            <td>
                                                                <input className="form-control" type="text" value={bill.service_price} />
                                                            </td>
                                                            <td>
                                                            <input className="form-control" type="text" value={bill.description} />
                                                            </td> 
                                                            {/* <td>
                                                            <input className="form-control" type="text" />
                                                            </td> */}
                                                            {/* <td>
                                                                <Link to="#" className="btn bg-danger-light trash"><i className="far fa-trash-alt" /></Link>
                                                            </td> */}
                                                        </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div className="row">
                      <div className="card">
                        <div className="card-body">
                          <h4 className="card-title">Kết quả</h4>
                          <div className="mb-0">
                            {/* <label className="mb-2">Tiểu sử</label> */}
                            <textarea
                              className="form-control"
                              rows={5}
                              defaultValue={""}
                              value={bill.description} 
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div className="row">
                      <div className="col-md-12">
                        <div className="submit-section">
                          <button
                            type="submit"
                            className="btn btn-primary submit-btn"
                          >
                            Lưu
                          </button>
                          <Link to="/doctors/patient-profile">
                            {" "}
                            <button
                              type="reset"
                              className="btn btn-secondary submit-btn"
                            >
                              Quay lại
                            </button>
                          </Link>
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
      )
}

export default DetailBIll