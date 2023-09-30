import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'


const Mypatients = () => {
  return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Khách hàng của tôi</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
              <li className="breadcrumb-item" aria-current="page">Khách hàng của tôi</li>
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
          <div className="row row-grid">
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="/doctors/patient-profile" className="booking-doc-img">
                        <img src="/img/patients/patient.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3><Link to="/doctors/patient-profile">Richard Wilson</Link></h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> P0016</h5>
        
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
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="patient-profile.html" className="booking-doc-img">
                        <img src="/img/patients/patient1.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3><Link to="patient-profile.html">Charlene Reed</Link></h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> P0001</h5>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 828 632 9170</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient2.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Travis Trimble </h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0002</h5>

                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 207 729 9974</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient3.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Carl Kelly</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0003</h5>
        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 260 724 7769</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient4.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Michelle Fairfax</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0004</h5>
        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 504 368 6874</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient5.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Gina Moore</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0005</h5>
        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 954 820 7887</span></li>
                      
                    
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient6.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Elsie Gilley</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0006</h5>
            
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 315 384 4562</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient7.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Joan Gardner</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0007</h5>
                                                </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 707 2202 603</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient8.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Daniel Griffing</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0007</h5>
                    
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 973 773 9497</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient9.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Walter Roberson</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0009</h5>
        
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 850 358 4445</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient10.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Robert Rhodes</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0010</h5>
                                                </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 858 259 5285</span></li>
                      
                                        </ul>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-md-6 col-lg-4 col-xl-3">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient11.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Harry Williams</h3>
                        <div className="patient-details">
                          <h5><b>Mã bệnh nhân :</b> PT0011</h5>
            
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>SĐT <span>+1 303 607 7075</span></li>
                                                            </ul>
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

export default Mypatients