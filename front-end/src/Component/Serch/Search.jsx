import React from 'react'
import doctorsApi from '../../api/doctorsApi';
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import FilterService from './FilterService';


const Search = () => {
  const [doctors, setDoctors] = useState([]);

  useEffect(() => {
    const fetchDoctor = async () => {
      try {
        const response = await doctorsApi.getAll();
        setDoctors(response.doctor);
        console.log(response);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchDoctor();
  }, []); 

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
        <FilterService/>
        </div>
        <div className="col-md-12 col-lg-8 col-xl-9">
        {doctors.map(doctor => (
          <div  key={doctor.id} className="card">
            <div className="card-body">
              <div className="doctor-widget">
                <div className="doc-info-left">
                  <div className="doctor-img">
                    <a href="doctor-profile.html">
                      <img src={doctor.image.profile} className="img-fluid" alt="User Image" />
                    </a>
                  </div>
                  <div className="doc-info-cont">
                    <h4 className="doc-name"><a href="doctor-profile.html">{doctor.name}</a></h4>
                    <p className="doc-speciality">{doctor.description.service}
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
                      <p className="doc-location"><i className="fas fa-map-marker-alt" />{doctor.address}</p>
                      <ul className="clinic-gallery">
                        <li>
                          <a href={doctor.image.anh1} data-fancybox="gallery">
                            <img src={doctor.image.anh1} alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href={doctor.image.anh2} data-fancybox="gallery">
                            <img src={doctor.image.anh2} alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href={doctor.image.anh3} data-fancybox="gallery">
                            <img src={doctor.image.anh3} alt="Feature" />
                          </a>
                        </li>
                        <li>
                          <a href={doctor.image.anh4} data-fancybox="gallery">
                            <img src={doctor.image.anh4} alt="Feature" />
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
                    <Link className="view-pro-btn" to={`/doctor/profile/${doctor.id}`}>Xem hồ sơ</Link>
                    <Link className="apt-btn" to={`/booking`}>Đặt lịch hẹn</Link>

                  {/* <a className="view-pro-btn" href="/doctor/profile">Xem hồ sơ</a> */}
                    {/* <a className="apt-btn" href="/booking">Đặt lịch hẹn</a> */}
                  </div>
                </div>
              </div>
            </div>
          </div>
          ))}

          
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