import React from 'react';
import { useEffect, useState } from 'react'
import { Link, useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi';
import ReviewsDoctor from './ReviewsDoctor';
import CustomButton from '../Serch/CustomButton';
import LoadingSkeleton from '../Loading';
import { useAuth } from '../../Context/ContextAuth';
import BreadcrumbBar from '../BreadcrumbBar';
const DoctorProfile = () => {
  const { id } = useParams();
  const [doctor, setDoctors] = useState(null);
  const { role } = useAuth();

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await doctorsApi.get(id);
        setDoctors(response.doctor);
        // setDoctors(response.review);
        console.log(response.doctor);
      
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchBlog();
  }, []);
  if (!doctor) {
    return <LoadingSkeleton/>
  }
  const handleBookingg = (doctorId) => {
    setSelectedDoctorId(doctorId);
  };
  return (
    <div>
<div>
<BreadcrumbBar title="HỒ SƠ BÁC SĨ" lable="Hồ sơ bác sĩ" />

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
                {/* <p className="doc-speciality">{doctor.description.service}</p> */}
                <div className="rating">
                {Array.from({ length: doctor.average_score }, (_, index) => (
                        <i key={index} className="fas fa-star filled" />
                      ))}
                      {Array.from({ length: 5 - doctor.average_score }, (_, index) => (
                        <i key={index} className="fas fa-star" />
                      ))}
                  {/* <span className="d-inline-block average-rating">( {doctor.review_count} )</span> */}
                </div>
                <div className="clinic-details">
                  <p className="doc-location"> <i className="fas fa-map-marker-alt" style={{marginRight:"10px"}} />
                    {doctor.address ? doctor.address : "Hà Nội"}</p>
                    {doctor?.images?.length > 0 && (
                    <ul className="clinic-gallery">
                      {doctor.images[0] && (
                        <li>
                          <a href={doctor.images[0]} data-fancybox="gallery">
                            <img src={doctor.images[0]} alt="Feature" />
                          </a>
                        </li>
                      )}
                      {doctor.images[1] && (
                        <li>
                          <a href={doctor.images[1]} data-fancybox="gallery">
                            <img src={doctor.images[1]} alt="Feature" />
                          </a>
                        </li>
                      )}
                      {doctor.images[2] && (
                        <li>
                          <a href={doctor.images[2]} data-fancybox="gallery">
                            <img src={doctor.images[2]} alt="Feature" />
                          </a>
                        </li>
                      )}
                      {doctor.images[3] && (
                        <li>
                          <a href={doctor.images[3]} data-fancybox="gallery">
                            <img src={doctor.images[3]} alt="Feature" />
                          </a>
                        </li>
                      )}
                    </ul>
                  )}
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
              {role !== "doctor" && (
                  <div className="clinic-booking">
                  <CustomButton handleBookingg={handleBookingg} doctorId={doctor.id} />
                  </div>
              )}
            
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
                    <div dangerouslySetInnerHTML={{ __html: doctor.description }} />
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