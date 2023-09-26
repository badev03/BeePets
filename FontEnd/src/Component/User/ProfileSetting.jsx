import React from 'react'



const ProfileSetting = () => {
  return (
    <div><div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Thông tin cá nhân</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Thông tin cá nhân</li>
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
                  <h3>Richard Wilson</h3>
                  <div className="patient-details">
                    <h5><i className="fas fa-birthday-cake" /> 24 Jul 1983, 38 years</h5>
                    <h5 className="mb-0"><i className="fas fa-map-marker-alt" /> Newyork, USA</h5>
                  </div>
                </div>
              </div>
            </div>
            <div className="dashboard-widget">
              <nav className="dashboard-menu">
                <ul>
                  <li >
                    <a href="/user/dashbroad">
                      <i className="fas fa-columns" />
                      <span>Bảng điều khiển</span>
                    </a>
                  </li>
                  
                  <li className="active">
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
            <div className="card-body">
              <form>
                <div className="row">
                  <div className="col-12 col-md-12">
                    <div className="mb-3">
                      <div className="change-avatar">
                        <div className="profile-img">
                          <img src="../src/assets/img/patients/patient.jpg" alt="User Image" />
                        </div>
                        <div className="upload-img">
                          <div className="change-photo-btn">
                            <span><i className="fa fa-upload" />Tải ảnh lên</span>
                            <input type="file" className="upload" />
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Họ</label>
                      <input type="text" className="form-control" defaultValue="Richard" />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Tên</label>
                      <input type="text" className="form-control" defaultValue="Wilson" />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Ngày sinh</label>
                      <div className="cal-icon">
                        <input type="text" className="form-control datetimepicker" defaultValue="24-07-1983" />
                      </div>
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Số điện thoại</label>
                      <input type="text" defaultValue="+1 202-555-0125" className="form-control" />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Email</label>
                      <input type="email" className="form-control" defaultValue="richard@example.com" />
                    </div>
                  </div>
                  
  
                </div>
                <div className="submit-section">
                  <button type="submit" className="btn btn-primary submit-btn">Lưu</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div></div>

  )
}

export default ProfileSetting