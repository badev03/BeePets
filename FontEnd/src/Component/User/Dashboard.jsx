import React from 'react'


const Dashboard = () => {
  return (
    <div><div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Bảng điều khiển</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Bảng điều khiển</li>
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
          <div className="profile-sidebar">
            <div className="widget-profile pro-widget-content">
              <div className="profile-info-widget">
                <a href="#" className="booking-doc-img">
                  <img src="../src/assets/img/patients/patient.jpg" alt="User Image" />
                </a>
                <div className="profile-det-info">
                  <h3>Tạ Anh Quý</h3>
                  <div className="patient-details">
                    <h5><i className="fas fa-birthday-cake" /> 24 Jul 2003, 18 years</h5>
                    <h5 className="mb-0"><i className="fas fa-map-marker-alt" /> Newyork, USA</h5>
                  </div>
                </div>
              </div>
            </div>
            <div className="dashboard-widget">
              <nav className="dashboard-menu">
                <ul>
                  <li className="active">
                    <a href="/user/dashbroad">
                      <i className="fas fa-columns" />
                      <span>Bảng điều khiển</span>
                    </a>
                  </li>
                  
                  <li>
                    <a href="profile-settings.html">
                      <i className="fas fa-user-cog" />
                      <span>Thông Tin Cá Nhân</span>
                    </a>
                  </li>
                  <li>
                    <a href="change-password.html">
                      <i className="fas fa-lock" />
                      <span>Thay Đổi Mật Khẩu</span>
                    </a>
                  </li>
                  <li>
                    <a href="login.html">
                      <i className="fas fa-sign-out-alt" />
                      <span>Đăng Xuất</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9">
       

          <div className="card">
            <div className="card-body pt-0">
              <nav className="user-tabs mb-4">
                <ul className="nav nav-tabs nav-tabs-bottom nav-justified">
                  <li className="nav-item">
                    <a className="nav-link active" href="#pat_appointments" data-bs-toggle="tab">Lịch khám</a>
                  </li>
                  <li className="nav-item">
                    <a className="nav-link" href="#pat_prescriptions" data-bs-toggle="tab">Đơn thuốc</a>
                  </li>
                  <li className="nav-item">
                    <a className="nav-link" href="#pat_medical_records" data-bs-toggle="tab"><span className="med-records">Hóa đơn</span></a>
                  </li>

                </ul>
              </nav>
              <div className="tab-content pt-0">
                <div id="pat_appointments" className="tab-pane fade show active">
                  <div className="card card-table mb-0">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>Bác sĩ</th>
                              <th>Lịch khám</th>
                              <th> Ngày đặt lịch</th>
                          
                              <th>Trạng thái</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-success-light">Confirm</span></td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-danger-light">Cancelled</span></td>

                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-warning-light">Pending</span></td>

                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-success-light">Confirm</span></td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-danger-light">Cancelled</span></td>

                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-warning-light">Pending</span></td>

                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-success-light">Confirm</span></td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-danger-light">Cancelled</span></td>

                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span></td>
                              <td>12 Nov 2023</td>
                            
                              <td><span className="badge rounded-pill bg-warning-light">Pending</span></td>

                              <td>
                                <div className="table-action">
                                  
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="tab-pane fade" id="pat_prescriptions">
                  <div className="card card-table mb-0">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>Mã thuốc </th>

                              <th>Ngày </th>
                              <th>Tên đơn thuốc</th>
                              <th>Người tạo </th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>001</td>

                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>001</td>

                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>001</td>

                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>001</td>

                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>001</td>

                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>001</td>

                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>001</td>

                              <td>14 Nov 2023</td>
                              <td>Prescription 1</td>
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  
                                  <a href="javascript:void(0);" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="pat_medical_records" className="tab-pane fade">
                  <div className="card card-table mb-0">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Ngày </th>
                              
                              <th>Giá</th>
                              <th>Tạo bởi</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                  
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                  
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                  
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                  
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                  
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><a href="#">#MR-0010</a></td>
                              <td>14 Nov 2023</td>
                              <td>$109</td>
                            
                              <td>
                                <h2 className="table-avatar">
                                  <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                    <img className="avatar-img rounded-circle" src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" />
                                  </a>
                                  <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                </h2>
                              </td>
                              <td>
                                <div className="table-action">
                                  <a href="#" className="btn btn-sm bg-info-light">
                                    <i className="far fa-eye" /> View
                                  </a>
                                  
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

export default Dashboard