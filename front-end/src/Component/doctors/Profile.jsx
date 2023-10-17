//thong tin tk
import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi'

const Profile = () => {
   const [doctor, setDoctors] = useState([]);
  
  const token = localStorage.getItem('token');
  
   if(token){
     useEffect(() => {
      const fetchDoctor = async () => {
        try {
         const response = await doctorsApi.getDoctor(
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
          setDoctors(response.doctor);     
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };
  
      fetchDoctor();
    }, []); 
   }
    return (
        <div>
            <div className="breadcrumb-bar-two">
                <div className="container">
                    <div className="row align-items-center inner-banner">
                        <div className="col-md-12 col-12 text-center">
                            <h2 className="breadcrumb-title">Thông tin bác sĩ</h2>
                            <nav aria-label="breadcrumb" className="page-breadcrumb">
                                <ol className="breadcrumb">
                                    <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
                                    <li className="breadcrumb-item" aria-current="page">Thông tin bác sĩ</li>
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
                            <Menudashboard />
                        </div>
                        <div className="col-md-7 col-lg-8 col-xl-9">
                            <div className="card">
                                <div className="card-body">
                                    <h4 className="card-title">Thông tin bác sĩ</h4>
                                    <div className="row">
                                        <div className="col-md-12">
                                            <div className="mb-3">
                                                <div className="change-avatar">
                                                    <div className="profile-img">
                                                        <img src="/img/doctors/doctor-thumb-02.jpg" alt="User Image" />
                                                    </div>
                                                    <div className="upload-img">
                                                        <div className="change-photo-btn">
                                                            <span><i className="fa fa-upload" /> Tải ảnh lên</span>
                                                            <input type="file" className="upload" />
                                                        </div>
                                                        <small className="form-text text-muted">Allowed JPG, GIF or PNG. Max
                                                            size of 2MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Tên người dùng <span className="text-danger">*</span></label>
                                                <input type="text" className="form-control" readOnly value={doctor.name} />
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Email <span className="text-danger">*</span></label>
                                                <input type="email" className="form-control" readOnly value={doctor.email}/>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Họ  <span className="text-danger">*</span></label>
                                                <input type="text" className="form-control" value={doctor.name}/>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Tên <span className="text-danger">*</span></label>
                                                <input type="text" className="form-control" value={doctor.name} />
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Số điện thoại</label>
                                                <input type="text" className="form-control" value={doctor.phone}/>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Giới tính</label>
                                                <select className="form-select form-control">
                                                    <option>{doctor.gender}</option>
                                                    <option>Nam</option>
                                                    <option>Nữ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-0">
                                                <label className="mb-2">Ngày sinh</label>
                                                <input type="text" className="form-control" value={doctor.birthday}/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="card">
                                <div className="card-body">
                                    <h4 className="card-title">Về tôi</h4>
                                    <div className="mb-0">
                                        <label className="mb-2">Tiểu sử</label>
                                        <textarea className="form-control" rows={5} value={doctor.description} defaultValue={""}  />
                                    </div>
                                </div>
                            </div>
                            {/* <div className="card">
                                <div className="card-body">
                                    <h4 className="card-title">Thông tin phòng khám</h4>
                                    <div className="row">
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Tên phòng khám</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Địa chỉ phòng khám</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div className="card ">
                                <div className="card-body">
                                    <h4 className="card-title">Địa chỉ bác sĩ</h4>
                                    <div className="row">
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="mb-2">Địa chỉ</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                        </div>

                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="control-label">Thành phố</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="control-label">Quận/Huyện</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                        </div>
                                        <div className="col-md-6">
                                            <div className="mb-3">
                                                <label className="control-label">Phường/Xã</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div className="card">
                                <div className="card-body">
                                    <h4 className="card-title">Kinh nghiệm</h4>
                                    <div className="education-info">
                                        <div className="row education-cont">
                                            <div className="col-12 col-md-10 col-lg-11">
                                                <div className="row">
                                                    <div className="col-12 col-md-6 col-lg-4">
                                                        <div className="mb-3">
                                                            <label className="mb-2">Tên bệnh viện</label>
                                                            <input type="text" className="form-control" />
                                                        </div>
                                                    </div>
                                                    <div className="col-12 col-md-6 col-lg-4">
                                                        <div className="mb-3">
                                                            <label className="mb-2">Thời gian làm từ</label>
                                                            <input type="text" className="form-control" />
                                                        </div>
                                                    </div>
                                                    <div className="col-12 col-md-6 col-lg-4">
                                                        <div className="mb-3">
                                                            <label className="mb-2">Đến</label>
                                                            <input type="text" className="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> */}
                                    {/* <div className="add-more">
                <Link to="javascript:void(0);" className="add-education"><i className="fa fa-plus-circle" /> Add More</Link>
              </div> */}
                                {/* </div>
                            </div> */}
                            <ul className="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                                <div className="submit-section">
                                    <button type="submit" className="btn btn-primary submit-btn">Lưu thông tin</button>
                                </div>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    )
}

export default Profile