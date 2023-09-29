import React from 'react'



const Search = () => {
  return (
    <div>
<div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">BÁC SĨ</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page"> Bác Sĩ</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="row">
        <div className="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
          <div className="card search-filter">
            <div className="card-header">
              <h4 className="card-title mb-0">Bộ lọc tìm kiếm</h4>
            </div>
            <div className="card-body">
              <div className="filter-widget">
                <div className="cal-icon">
                  <input type="text" className="form-control datetimepicker" placeholder="Select Date" />
                </div>
              </div>

              <div className="filter-widget">
                <h4>Dịch vụ</h4>
                <div>
                  <label className="custom_check">
                    <input type="checkbox" name="select_specialist" defaultChecked />
                    <span className="checkmark" /> Khám bệnh
                  </label>
                </div>
                <div>
                  <label className="custom_check">
                    <input type="checkbox" name="select_specialist" defaultChecked />
                    <span className="checkmark" /> Chăm sóc và làm đẹp
                  </label>
                </div>
                <div>
                  <label className="custom_check">
                    <input type="checkbox" name="select_specialist" />
                    <span className="checkmark" /> Tiêm phòng
                  </label>
                </div>
              </div>
              <div className="btn-search">
                <button type="button" className="btn w-100">Tìm kiếm</button>
              </div>
            </div>
          </div>
        </div>
        <div className="col-md-12 col-lg-8 col-xl-9">
          <div className="card">
            <div className="card-body">
              <div className="doctor-widget">
                <div className="doc-info-left">
                  <div className="doctor-img">
                    <a href="doctor-profile.html">
                      <img src="src/assets/img/doctors/doctor-thumb-01.jpg" className="img-fluid" alt="User Image" />
                    </a>
                  </div>
                  <div className="doc-info-cont">
                    <h4 className="doc-name"><a href="doctor-profile.html">Dr. Ruby Perrin</a></h4>
                    <p className="doc-speciality">MDS - Periodontology and Oral Implantology, BDS
                    </p>
                  
                    <div className="rating">
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star" />
                      <span className="d-inline-block average-rating">(17)</span>
                    </div>
                    <div className="clinic-details">
                      <p className="doc-location"><i className="fas fa-map-marker-alt" /> Florida,
                        USA</p>
                      <ul className="clinic-gallery">
                        <li>
                          <a href="src/assets/img/features/feature-01.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-01.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-02.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-02.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-03.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-03.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-04.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-04.jpg" alt="Feature" />
                          </a>
                        </li>
                      </ul>
                    </div>
                  
                  </div>
                </div>
                <div className="doc-info-right">
                  <div className="clini-infos">
                    <ul>
                      <li><i className="far fa-thumbs-up" /> 98%</li>
                      <li><i className="far fa-comment" /> 17 Feedback</li>
                      <li><i className="fas fa-map-marker-alt" /> Florida, USA</li>
                    </ul>
                  </div>
                  <div className="clinic-booking">
                  <a className="view-pro-btn" href="/doctor/profile">Xem hồ sơ</a>
                    <a className="apt-btn" href="/booking">Đặt lịch hẹn</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="card">
            <div className="card-body">
              <div className="doctor-widget">
                <div className="doc-info-left">
                  <div className="doctor-img">
                    <a href="doctor-profile.html">
                      <img src="src/assets/img/doctors/doctor-thumb-01.jpg" className="img-fluid" alt="User Image" />
                    </a>
                  </div>
                  <div className="doc-info-cont">
                    <h4 className="doc-name"><a href="doctor-profile.html">Dr. Ruby Perrin</a></h4>
                    <p className="doc-speciality">MDS - Periodontology and Oral Implantology, BDS
                    </p>
                  
                    <div className="rating">
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star" />
                      <span className="d-inline-block average-rating">(17)</span>
                    </div>
                    <div className="clinic-details">
                      <p className="doc-location"><i className="fas fa-map-marker-alt" /> Florida,
                        USA</p>
                      <ul className="clinic-gallery">
                        <li>
                          <a href="src/assets/img/features/feature-01.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-01.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-02.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-02.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-03.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-03.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-04.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-04.jpg" alt="Feature" />
                          </a>
                        </li>
                      </ul>
                    </div>
                  
                  </div>
                </div>
                <div className="doc-info-right">
                  <div className="clini-infos">
                    <ul>
                      <li><i className="far fa-thumbs-up" /> 98%</li>
                      <li><i className="far fa-comment" /> 17 Feedback</li>
                      <li><i className="fas fa-map-marker-alt" /> Florida, USA</li>
                    </ul>
                  </div>
                  <div className="clinic-booking">
                    <a className="view-pro-btn" href="doctor-profile.html">Xem hồ sơ</a>
                    <a className="apt-btn" href="booking.html">Đặt lịch hẹn</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="card">
            <div className="card-body">
              <div className="doctor-widget">
                <div className="doc-info-left">
                  <div className="doctor-img">
                    <a href="doctor-profile.html">
                      <img src="src/assets/img/doctors/doctor-thumb-01.jpg" className="img-fluid" alt="User Image" />
                    </a>
                  </div>
                  <div className="doc-info-cont">
                    <h4 className="doc-name"><a href="doctor-profile.html">Dr. Ruby Perrin</a></h4>
                    <p className="doc-speciality">MDS - Periodontology and Oral Implantology, BDS
                    </p>
                  
                    <div className="rating">
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star" />
                      <span className="d-inline-block average-rating">(17)</span>
                    </div>
                    <div className="clinic-details">
                      <p className="doc-location"><i className="fas fa-map-marker-alt" /> Florida,
                        USA</p>
                      <ul className="clinic-gallery">
                        <li>
                          <a href="src/assets/img/features/feature-01.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-01.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-02.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-02.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-03.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-03.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-04.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-04.jpg" alt="Feature" />
                          </a>
                        </li>
                      </ul>
                    </div>
                  
                  </div>
                </div>
                <div className="doc-info-right">
                  <div className="clini-infos">
                    <ul>
                      <li><i className="far fa-thumbs-up" /> 98%</li>
                      <li><i className="far fa-comment" /> 17 Feedback</li>
                      <li><i className="fas fa-map-marker-alt" /> Florida, USA</li>
                    </ul>
                  </div>
                  <div className="clinic-booking">
                    <a className="view-pro-btn" href="/doctor/profile">Xem hồ sơ</a>
                    <a className="apt-btn" href="/booking">Đặt lịch hẹn</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className="card">
            <div className="card-body">
              <div className="doctor-widget">
                <div className="doc-info-left">
                  <div className="doctor-img">
                    <a href="doctor-profile.html">
                      <img src="src/assets/img/doctors/doctor-thumb-01.jpg" className="img-fluid" alt="User Image" />
                    </a>
                  </div>
                  <div className="doc-info-cont">
                    <h4 className="doc-name"><a href="doctor-profile.html">Dr. Ruby Perrin</a></h4>
                    <p className="doc-speciality">MDS - Periodontology and Oral Implantology, BDS
                    </p>
                  
                    <div className="rating">
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star filled" />
                      <i className="fas fa-star" />
                      <span className="d-inline-block average-rating">(17)</span>
                    </div>
                    <div className="clinic-details">
                      <p className="doc-location"><i className="fas fa-map-marker-alt" /> Florida,
                        USA</p>
                      <ul className="clinic-gallery">
                        <li>
                          <a href="src/assets/img/features/feature-01.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-01.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-02.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-02.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-03.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-03.jpg" alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href="src/assets/img/features/feature-04.jpg" data-fancybox="gallery">
                            <img src="src/assets/img/features/feature-04.jpg" alt="Feature" />
                          </a>
                        </li>
                      </ul>
                    </div>
                  
                  </div>
                </div>
                <div className="doc-info-right">
                  <div className="clini-infos">
                    <ul>
                      <li><i className="far fa-thumbs-up" /> 98%</li>
                      <li><i className="far fa-comment" /> 17 Feedback</li>
                      <li><i className="fas fa-map-marker-alt" /> Florida, USA</li>
                    </ul>
                  </div>
                  <div className="clinic-booking">
                    <a className="view-pro-btn" href="doctor-profile.html">Xem hồ sơ</a>
                    <a className="apt-btn" href="booking.html">Đặt lịch hẹn</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div className="load-more text-center">
            <a className="btn btn-primary btn-sm prime-btn" href="#">Xem thêm</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    
    </div>
  )
}

export default Search