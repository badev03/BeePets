import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'


const Changepassword = () => {
  return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Change Password</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><Link to="/">Home</Link></li>
              <li className="breadcrumb-item" aria-current="page">Change Password</li>
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
          <div className="card">
            <div className="card-body">
              <div className="row">
                <div className="col-md-12 col-lg-6">
                  <form>
                    <div className="mb-3">
                      <label className="mb-2">Mật khẩu cũ</label>
                      <input type="password" className="form-control" />
                    </div>
                    <div className="mb-3">
                      <label className="mb-2">Mật khẩu mới</label>
                      <input type="password" className="form-control" />
                    </div>
                    <div className="mb-3">
                      <label className="mb-2">Nhập lại mật khẩu mới</label>
                      <input type="password" className="form-control" />
                    </div>
                    <div className="submit-section">
                      <button type="submit" className="btn btn-primary submit-btn">Lưu
                        mật khẩu</button>
                    </div>
                  </form>
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

export default Changepassword