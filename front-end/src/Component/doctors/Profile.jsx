//thong tin tk
import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi'
import LoadingSkeleton from '../Loading';
import BreadcrumbBar from '../BreadcrumbBar';

const Profile = () => {
   const [doctor, setDoctors] = useState("");
  
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
                         <BreadcrumbBar title="THÔNG TIN BÁC SĨ" lable="Thông tin bác sĩ" />

            <div className="content">
                <div className="container">
                    <div className="row">
                        <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                            <Menudashboard />
                        </div>
                        {!doctor ? (<div className="col-md-7 col-lg-8 col-xl-9"><LoadingSkeleton /></div>):(       <div className="col-md-7 col-lg-8 col-xl-9">
                <div className="card">
                  <div className="card-body">
                    <form>
                      <div className="row">
                        <div className="col-xl-6">
                          {" "}
                          <div className="profile-info">
                            
                            <div className="profile-item">
                              <span className="profile-label">Tên bác sĩ:</span>
                              <span className="profile-value">
                                {doctor.name}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">Quê quán:</span>
                              <span className="profile-value">
                                {doctor.address}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">Ngày sinh:</span>
                              <span className="profile-value">
                                {doctor.birthday}
                              </span>
                            </div>
                            <div className="profile-item">
                              <span className="profile-label">
                              Số điện thoại:
                              </span>
                              <span className="profile-value">
                                {doctor.phone}
                              </span>
                            </div>
                            <div className="profile-item">
                            <span className="profile-label">Giới tính:</span>
<span className="profile-value">
    {doctor.gender == 1 ? 'Nam' : (doctor.gender == 2 ? 'Nữ' : 'Khác')}
</span>
                              
                            </div>
                            
                           
                           
                          </div>
                        </div>

                        <div className="col-xl-6">
                          {" "}
                          {doctor.image ? (
                            <div className="profile-img d-flex justify-content-center align-items-center">
                              <img
                                src={doctor.image}
                                alt="Doctor Image"
                                className="rounded-0"
                                style={{
                                  width: "50%",
                                  border: "none",
                                  marginBottom: "20px",
                                }}
                              />
                            </div>
                          ) : (
                            <div className="profile-img d-flex justify-content-center align-items-center">
                              <img
                                src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg"
                                alt="User Image"
                                className="rounded-0"
                                style={{
                                  width: "50%",
                                  border: "none",
                                  marginBottom: "20px",
                                }}
                              />
                            </div>
                          )}
                        </div>
<div className="col-xl-12"> <div className="profile-item">
                              <span className="profile-label">Ghi chú:</span>
                              <span className="profile-value">
                              <div dangerouslySetInnerHTML={{ __html: doctor.description }} />
                                
                              </span>
                            </div></div>
                        
                      </div>
                    </form>
                  </div>
                </div>
              </div>)}
                 
                    </div>
                </div>
            </div>
        </div>


    )
}

export default Profile