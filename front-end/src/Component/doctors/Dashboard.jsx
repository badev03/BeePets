import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'


const Dashboarddoctors = () => {
  return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Bảng điều khiển</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
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
          <Menudashboard/>
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9">
          <div className="row">
            <div className="col-md-12">
              <div className="card dash-card">
                <div className="card-body">
                  <div className="row">
                    <div className="col-md-12 col-lg-4">
                      <div className="dash-widget dct-border-rht">
                        <div className="circle-bar circle-bar1">
                          <div className="circle-graph1" data-percent={75}>
                            <img src="/img/icon-01.png" className="img-fluid" alt="patient" />
                          </div>
                        </div>
                        <div className="dash-widget-info">
                          <h6>Tổng số bệnh nhân</h6>
                          <h3>1500</h3>
                          <p className="text-muted">cho đến nay</p>
                        </div>
                      </div>
                    </div>
                    <div className="col-md-12 col-lg-4">
                      <div className="dash-widget dct-border-rht">
                        <div className="circle-bar circle-bar2">
                          <div className="circle-graph2" data-percent={65}>
                            <img src="/img/icon-02.png" className="img-fluid" alt="Patient" />
                          </div>
                        </div>
                        <div className="dash-widget-info">
                          <h6>Bệnh nhân hôm nay</h6>
                          <h3>160</h3>
                          <p className="text-muted">21/06/2003</p>
                        </div>
                      </div>
                    </div>
                    <div className="col-md-12 col-lg-4">
                      <div className="dash-widget">
                        <div className="circle-bar circle-bar3">
                          <div className="circle-graph3" data-percent={50}>
                            <img src="/img/icon-03.png" className="img-fluid" alt="Patient" />
                          </div>
                        </div>
                        <div className="dash-widget-info">
                          <h6>Lịch đặt</h6>
                          <h3>85</h3>
                          <p className="text-muted">21/06/2003</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="row">
            <div className="col-md-12">
              <h4 className="mb-4">Lịch hẹn của bệnh nhân</h4>
              <div className="appointment-tab">
                <ul className="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                  <li className="nav-item">
                    <Link className="nav-link active" to="#upcoming-appointments" data-bs-toggle="tab">Lịch hẹn sắp tới</Link>
                  </li>
                  
                </ul>
                <div className="tab-content">
                  <div className="tab-pane show active" id="upcoming-appointments">
                    <div className="card card-table mb-0">
                      <div className="card-body">
                        <div className="table-responsive">
                          <table className="table table-hover table-center mb-0">
                            <thead>
                              <tr>
                                <th>Tên bệnh nhân</th>
                                <th>Thời gian</th>
                                <th>Dịch vụ</th>
                                <th>Trạng thái</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Richard
                                      Wilson <span>#PT0016</span></Link>
                                  </h2>
                                </td>
                                <td>11 Nov 2023 <span className="d-block text-info">10.00 AM</span>
                                </td>
                                <td>Khám bệnh</td>
                                <td>
                                  <div className="table-action">
                                    <Link to="/doctors/detail-appointments" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);"  className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="/img/patients/patient1.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Charlene Reed
                                      <span>#PT0001</span></Link>
                                  </h2>
                                </td>
                                <td>3 Nov 2023 <span className="d-block text-info">11.00
                                    AM</span></td>
                                <td>Khám bệnh</td>
                               
                                <td>
                                  <div className="table-action">
                                    <Link to="/doctors/detail-appointments" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient2.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Travis
                                      Trimble <span>#PT0002</span></Link>
                                  </h2>
                                </td>
                                <td>1 Nov 2023 <span className="d-block text-info">1.00
                                    PM</span></td>
                                <td>Khám bệnh</td>
                                
                                <td>
                                  <div className="table-action">
                                    <Link to="/doctors/detail-appointments" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient3.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Carl Kelly
                                      <span>#PT0003</span></Link>
                                  </h2>
                                </td>
                                <td>30 Oct 2023 <span className="d-block text-info">9.00
                                    AM</span></td>
                                <td>Khám bệnh</td>
                                
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient4.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Michelle
                                      Fairfax <span>#PT0004</span></Link>
                                  </h2>
                                </td>
                                <td>28 Oct 2023 <span className="d-block text-info">6.00
                                    PM</span></td>
                                <td>Khám bệnh</td>
                                
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient5.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Gina Moore
                                      <span>#PT0005</span></Link>
                                  </h2>
                                </td>
                                <td>27 Oct 2023 <span className="d-block text-info">8.00
                                    AM</span></td>
                                <td>Khám bệnh</td>
                                
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
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
                  <div className="tab-pane" id="today-appointments">
                    <div className="card card-table mb-0">
                      <div className="card-body">
                        <div className="table-responsive">
                          <table className="table table-hover table-center mb-0">
                            <thead>
                              <tr>
                                <th>Patient Name</th>
                                <th>Appt Date</th>
                                <th>Purpose</th>
                                <th>Type</th>
                                <th>Paid Amount</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient6.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Elsie Gilley
                                      <span>#PT0006</span></Link>
                                  </h2>
                                </td>
                                <td>14 Nov 2023 <span className="d-block text-info">6.00
                                    PM</span></td>
                                <td>Fever</td>
                                <td>Old Patient</td>
                                <td>$300</td>
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient7.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Joan Gardner
                                      <span>#PT0006</span></Link>
                                  </h2>
                                </td>
                                <td>14 Nov 2023 <span className="d-block text-info">5.00
                                    PM</span></td>
                                <td>Khám bệnh</td>
                                <td>Old Patient</td>
                                <td>$100</td>
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient8.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Daniel
                                      Griffing <span>#PT0007</span></Link>
                                  </h2>
                                </td>
                                <td>14 Nov 2023 <span className="d-block text-info">3.00
                                    PM</span></td>
                                <td>Khám bệnh</td>
                                
                                <td>$75</td>
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient9.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Walter
                                      Roberson <span>#PT0008</span></Link>
                                  </h2>
                                </td>
                                <td>14 Nov 2023 <span className="d-block text-info">1.00
                                    PM</span></td>
                                <td>Khám bệnh</td>
                                <td>Old Patient</td>
                                <td>$350</td>
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient10.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Robert Rhodes
                                      <span>#PT0010</span></Link>
                                  </h2>
                                </td>
                                <td>14 Nov 2023 <span className="d-block text-info">10.00 AM</span>
                                </td>
                                <td>Khám bệnh</td>
                                
                                <td>$175</td>
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
                                    </Link>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <h2 className="table-avatar">
                                    <Link to="patient-profile.html" className="avatar avatar-sm me-2"><img className="avatar-img rounded-circle" src="img/patients/patient11.jpg" alt="User Image" /></Link>
                                    <Link to="patient-profile.html">Harry
                                      Williams <span>#PT0011</span></Link>
                                  </h2>
                                </td>
                                <td>14 Nov 2023 <span className="d-block text-info">11.00 AM</span>
                                </td>
                                <td>Khám bệnh</td>
                                
                                <td>$450</td>
                                <td>
                                  <div className="table-action">
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-info-light">
                                      <i className="far fa-eye" /> View
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-success-light">
                                      <i className="fas fa-check" /> Accept
                                    </Link>
                                    <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                                      <i className="fas fa-times" /> Cancel
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
</div>

  )
}

export default Dashboarddoctors