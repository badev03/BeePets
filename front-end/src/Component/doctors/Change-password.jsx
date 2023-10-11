//doi mk
import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi'

const Changepassword = () => {
  const { id } = useParams();
    const [doctor, setDoctor] = useState(null);

    useEffect(() => {
        const fetchBlog = async () => {
            try {
                const response = await doctorsApi.get(1);
                setDoctor(response);
            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };

        fetchBlog();
    }, []);
    if (!doctor) {
        return <div>Loading...</div>;
    }
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
                      <input type="password" className="form-control" value={doctor.password}/>
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