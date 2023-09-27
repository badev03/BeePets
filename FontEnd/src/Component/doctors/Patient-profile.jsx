import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'


const Patientprofile = () => {
  return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Chi tiết bệnh nhân</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
              <li className="breadcrumb-item" aria-current="page">Chi tiết bệnh nhân</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="row">
        <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">
          <div className="card widget-profile pat-widget-profile">
            <div className="card-body">
                <Menudashboard/>
              <div className="pro-widget-content">
                <div className="profile-info-widget">
                  <Link to="#" className="booking-doc-img">
                    <img src="/img/patients/patient.jpg" alt="User Image" />
                  </Link>
                  <div className="profile-det-info">
                    <h3>Richard Wilson</h3>
                    <div className="patient-details">
                      <h5><b>Patient ID :</b> PT0016</h5>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div className="patient-info">
                <ul>
                  <li>SĐT <span>+1 952 001 8563</span></li>
                </ul>
              </div>
            </div>
          </div>
          <div className="card">
            <div className="card-header">
              <h4 className="card-title">Lịch đặt gần đây</h4>
            </div>
            <ul className="list-group list-group-flush">
              <li className="list-group-item">
                <div className="notify-block align-items-center d-flex">
                  <div className="me-3 flex-shrink-0">
                    <img alt="Image placeholder" src="/img/doctors/doctor-thumb-02.jpg" className="avatar  rounded-circle" />
                  </div>
                  <div className="media-body flex-grow-1">
                    <h5 className="d-block mb-0">Dr. Darren Elder </h5>
                    <span className="d-block text-sm text-muted">Dentist</span>
                    <span className="d-block text-sm text-muted">14 Nov 2023 5.00 PM</span>
                  </div>
                </div>
              </li>
              <li className="list-group-item">
                <div className="notify-block align-items-center d-flex">
                  <div className="me-3 flex-shrink-0">
                    <img alt="Image placeholder" src="/img/doctors/doctor-thumb-02.jpg" className="avatar  rounded-circle" />
                  </div>
                  <div className="media-body flex-grow-1">
                    <h5 className="d-block mb-0">Dr. Darren Elder </h5>
                    <span className="d-block text-sm text-muted">Dentist</span>
                    <span className="d-block text-sm text-muted">12 Nov 2023 11.00 AM</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
          <div className="card">
            <div className="card-body pt-0">
              <div className="user-tabs">
                <ul className="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
                  <li className="nav-item">
                    <Link className="nav-link active" to="#pat_appointments" data-bs-toggle="tab">Cuộc hẹn</Link>
                  </li>
                  <li className="nav-item">
                    <Link className="nav-link" to="#pres" data-bs-toggle="tab"><span>Đơn thuốc</span></Link>
                  </li>
                  {/* <li className="nav-item">
                    <Link className="nav-link" to="#medical" data-bs-toggle="tab"><span className="med-records">Hóa đơn</span></Link>
                  </li> */}
                  <li className="nav-item">
                    <Link className="nav-link" to="#billing" data-bs-toggle="tab"><span>Hóa đơn</span></Link>
                  </li>
                </ul>
              </div>
              <div className="tab-content">
                <div id="pat_appointments" className="tab-pane fade show active">
                  <div className="card card-table mb-0">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>Bác sĩ</th>
                              <th>Ngày đặt lịch</th>
                              <th>Tổng tiền</th>
                              <th>Trạng thái</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Dr. Darren Elder
                                    <span>Dental</span></Link>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00
                                  AM</span></td>
                              
                              <td>$160</td>
                              
                              <td><span className="badge rounded-pill bg-success-light">Confirm</span>
                              </td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                    <i className="far fa-edit" /> Edit
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Dr. Darren Elder
                                    <span>Dental</span></Link>
                                </h2>
                              </td>
                              <td>12 Nov 2023 <span className="d-block text-info">8.00
                                  PM</span></td>
                              
                              <td>$250</td>
                              <td><span className="badge rounded-pill bg-success-light">Confirm</span>
                              </td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                    <i className="far fa-edit" /> Edit
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Dr. Darren Elder
                                    <span>Dental</span></Link>
                                </h2>
                              </td>
                              <td>11 Nov 2023 <span className="d-block text-info">11.00
                                  AM</span></td>
                              <td>$400</td>
                              <td><span className="badge rounded-pill bg-danger-light">Cancelled</span>
                              </td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                    <i className="far fa-edit" /> Edit
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="tab-pane fade" id="pres">
                  <div>
                    <Link to="/doctors/add-prescription" className="add-new-btn">Thêm đơn thuốc</Link>
                  </div>
                  <div className="card card-table mb-0">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>Ngày </th>
                              <th>Tên</th>
                              <th>Tạo bởi </th>
                              <th>Hoạt động</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Dr. Ruby Perrin
                                    <span>Dental</span></Link>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-primary-light">
                                    <i className="fas fa-print" /> Print
                                  </Link>
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>13 Nov 2023</td>
                              <td>Prescription 2</td>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Dr. Darren Elder
                                    <span>Dental</span></Link>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-primary-light">
                                    <i className="fas fa-print" /> Print
                                  </Link>
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </Link>
                                  <Link to="/doctors/edit-prescription" className="btn btn-sm bg-success-light">
                                    <i className="fas fa-edit" /> Edit
                                  </Link>
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                    <i className="far fa-trash-alt" /> Delete
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            
                            <tr>
                              <td>11 Nov 2023</td>
                              <td>Prescription 4</td>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-04.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Dr. Sofia Brient
                                    <span>Urology</span></Link>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-primary-light">
                                    <i className="fas fa-print" /> Print
                                  </Link>
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="tab-pane" id="billing">
                  <div>
                    <Link className="add-new-btn" to="/doctors/add-bill">Tạo hóa đơn</Link>
                  </div>
                  <div className="card card-table mb-0">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>Mã hóa đơn</th>
                              <th>Người tạo</th>
                              <th>Tổng tiền</th>
                              <th>Hoạt động</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <Link to="invoice-view.html">#INV-0010</Link>
                              </td>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Ruby Perrin
                                    <span>Dental</span></Link>
                                </h2>
                              </td>
                              <td>$450</td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-primary-light">
                                    <i className="fas fa-print" /> Print
                                  </Link>
                                  <Link to="/doctors/edit-bill" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <Link to="invoice-view.html">#INV-0009</Link>
                              </td>
                              <td>
                                <h2 className="table-avatar">
                                  <Link to="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                                  </Link>
                                  <Link to="doctor-profile.html">Dr. Darren Elder
                                    <span>Dental</span></Link>
                                </h2>
                              </td>
                              <td>$300</td>
                              <td>
                                <div className="table-action">
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-primary-light">
                                    <i className="fas fa-print" /> Print
                                  </Link>
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </Link>
                                  <Link to="edit-billing.html" className="btn btn-sm bg-success-light">
                                    <i className="fas fa-edit" /> Edit
                                  </Link>
                                  <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                    <i className="far fa-trash-alt" /> Delete
                                  </Link>
                                </div>
                              </td>
                            </tr>
                            
                            
                          </tbody>
                        </table>
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
  </div>
</div>

  )
}

export default Patientprofile