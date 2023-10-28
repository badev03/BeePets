import React from 'react';
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi';
import ReviewsDoctor from './ReviewsDoctor';
const DoctorProfile = () => {
  const { id } = useParams();
  const [doctor, setDoctors] = useState(null);

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await doctorsApi.get(id);
        setDoctors(response.doctor);
        // setDoctors(response.review);
        console.log(response);
      
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
<div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Hồ sơ bác sĩ</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page">Hồ sơ bác sĩ</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="card">
        <div className="card-body">
          <div className="doctor-widget">
            <div className="doc-info-left">
              <div className="doctor-img">
                <img src={doctor.image} className="img-fluid" alt="User Image" />
              </div>
              <div className="doc-info-cont">
                <h4 className="doc-name">{doctor.name}</h4>
                <p className="doc-speciality">{doctor.description.service}</p>
                <div className="rating">
                {Array.from({ length: doctor.average_score }, (_, index) => (
                        <i key={index} className="fas fa-star filled" />
                      ))}
                      {Array.from({ length: 5 - doctor.average_score }, (_, index) => (
                        <i key={index} className="fas fa-star" />
                      ))}
                  <span className="d-inline-block average-rating">( {doctor.review_count} )</span>
                </div>
                <div className="clinic-details">
                  <p className="doc-location"><i className="fas fa-map-marker-alt" /> {doctor.address}</p>
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
                  {/* <li><i className="far fa-thumbs-up" /> 99%</li> */}
                  <li><i className="far fa-comment" /> {doctor.review_count} Feedback</li>
                  {/* <li><i className="fas fa-map-marker-alt" /> {doctor.address}</li> */}
                 
                </ul>
              </div>
         
              <div className="clinic-booking">
                <a className="apt-btn" href="/booking">Đặt lịch hẹn</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div className="card">
        <div className="card-body pt-0">
          <nav className="user-tabs mb-4">
            <ul className="nav nav-tabs nav-tabs-bottom nav-justified">
              <li className="nav-item">
                <a className="nav-link active" href="#doc_overview" data-bs-toggle="tab">Tổng quan</a>
              </li>
             
              <li className="nav-item">
                <a className="nav-link" href="#doc_reviews" data-bs-toggle="tab">Đánh giá</a>
              </li>
              
            </ul>
          </nav>
          <div className="tab-content pt-0">
            <div role="tabpanel" id="doc_overview" className="tab-pane fade show active">
              <div className="row">
                <div className="col-md-12 col-lg-9">
                  <div className="widget about-widget">
                    <h4 className="widget-title">Giới thiệu bản thân</h4>
                    <p>{doctor.description}</p>
                  </div>
                  {/* <div className="widget education-widget">
                    <h4 className="widget-title">Học vấn</h4>
                    <div className="experience-box">
                      <ul className="experience-list">
                        {doctor.description.education.map(edication=>(
                          <li>
                          <div className="experience-user">
                            <div className="before-circle" />
                          </div>
                          <div className="experience-content">
                            <div className="timeline-content">
                              <a  className="name">{edication.title}</a>
                              <div>{edication.service}</div>
                              <span className="time">{edication.year}</span>
                            </div>
                          </div>
                          </li>
                        ))}
                       
                        
                      </ul>
                    </div>
                  </div>
                  <div className="widget experience-widget">
                    <h4 className="widget-title">Kinh nghiệm làm việc</h4>
                    <div className="experience-box">
                      <ul className="experience-list">
                      {doctor.description.experience.map(experience=>(
                        <li>
                          <div className="experience-user">
                            <div className="before-circle" />
                          </div>
                          <div className="experience-content">
                            <div className="timeline-content">
                              <a href="#/" className="name">{experience.title}</a>
                              <span className="time">{experience.year}</span>
                            </div>
                          </div>
                        </li>
                        ))}
                      </ul>
                    </div>
                  </div>
                  <div className="widget awards-widget">
                    <h4 className="widget-title">Giải thưởng</h4>
                    <div className="experience-box">
                      <ul className="experience-list">
                      {doctor.description.awards.map(awards=>(

                        <li>
                          <div className="experience-user">
                            <div className="before-circle" />
                          </div>
                          <div className="experience-content">
                            <div className="timeline-content">
                              <p className="exp-year">{awards.year}</p>
                              <h4 className="exp-title">{awards.title}</h4>
                              <p>{awards.content}</p>
                            </div>
                          </div>
                        </li>
                        ))}

                      
                      </ul>
                    </div>
                  </div> */}
                
                </div>
              </div>
            </div>
        <ReviewsDoctor/>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
  )
}

export default DoctorProfile