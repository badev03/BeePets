import React from 'react'
import { Link } from 'react-router-dom'
import Sidebar from './Sidebar'
import usersApi from '../../api/usersApi';
import { useEffect, useState } from "react";




const ProfileSetting = () => {
  const [user, setUser] = useState([]);
  
  const token = localStorage.getItem('token');
  
   if(token){
     useEffect(() => {
      const fetchUser = async () => {
        try {
         const response = await usersApi.getUser(
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        setUser(response.user); 
        console.log(response.user);    
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      fetchUser();
    }, []); 
   }
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
        <Sidebar/>
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
                      <input type="text" className="form-control" defaultValue="Richard" value={user.name} />
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Tên</label>
                      <input type="text" className="form-control" defaultValue="Wilson" value={user.name}/>
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Ngày sinh</label>
                      <div className="cal-icon">
                        <input type="text" className="form-control datetimepicker" defaultValue="24-07-1983" value={user.birthday}/>
                      </div>
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Số điện thoại</label>
                      <input type="text" defaultValue="+1 202-555-0125" className="form-control" value={user.phone}/>
                    </div>
                  </div>
                  <div className="col-12 col-md-6">
                    <div className="mb-3">
                      <label className="mb-2">Email</label>
                      <input type="email" className="form-control" defaultValue="richard@example.com" value={user.email}/>
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