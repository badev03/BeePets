import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'


const Appointments = () => {
    return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Lịch hẹn</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
              <li className="breadcrumb-item" aria-current="page">Lịch hẹn</li>
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
          <div className="appointments">
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="/doctors/detail-appointments">Richard Wilson</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 14 Nov 2023, 10.00 AM</h5>
                    
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 923 782 4575</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="/doctors/detail-appointments" className="btn btn-sm bg-info-light" >
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient1.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Charlene Reed </Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 12 Nov 2023, 5.00 PM</h5>
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 828 632 9170</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient2.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Travis Trimble</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 11 Nov 2023, 8.00 PM</h5>
                   
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 207 729 9974</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient3.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Carl Kelly</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 9 Nov 2023, 9.00 AM</h5>
                    
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 260 724 7769</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient4.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Michelle Fairfax</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 9 Nov 2023, 1.00 PM</h5>

                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 504 368 6874</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient5.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Gina Moore</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 8 Nov 2023, 3.00 PM</h5>

                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 954 820 7887</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient6.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Elsie Gilley</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 6 Nov 2023, 9.00 AM</h5>

                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 315 384 4562</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient7.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Joan Gardner</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 5 Nov 2023, 12.00 PM</h5>

                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 707 2202 603</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient8.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Daniel Griffing</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 5 Nov 2023, 7.00 PM</h5>
                    
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 973 773 9497</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient9.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Walter Roberson</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 4 Nov 2023, 10.00 AM</h5>
                    
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 850 358 4445</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient10.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Robert Rhodes</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 4 Nov 2023, 11.00 AM</h5>
                    
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 858 259 5285</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
              </div>
            </div>
            <div className="appointment-list">
              <div className="profile-info-widget">
                <Link to="patient-profile.html" className="booking-doc-img">
                  <img src="/img/patients/patient11.jpg" alt="User Image" />
                </Link>
                <div className="profile-det-info">
                  <h3><Link to="patient-profile.html">Harry Williams</Link></h3>
                  <div className="patient-details">
                    <h5><i className="far fa-clock" /> 3 Nov 2023, 6.00 PM</h5>
                    
                    <h5 className="mb-0"><i className="fas fa-phone" /> +1 303 607 7075</h5>
                  </div>
                </div>
              </div>
              <div className="appointment-action">
                <Link to="#" className="btn btn-sm bg-info-light" data-bs-toggle="modal" data-bs-target="#appt_details">
                  <i className="far fa-eye" /> View
                </Link>
                
                <Link to="javascript:void(0);" className="btn btn-sm bg-danger-light">
                  <i className="fas fa-times" /> Cancel
                </Link>
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

export default Appointments