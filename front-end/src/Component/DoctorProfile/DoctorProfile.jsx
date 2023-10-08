import React from 'react';
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi';
const DoctorProfile = () => {
  const { id } = useParams();
  const [doctor, setDoctors] = useState(null);

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await doctorsApi.get(id);
        setDoctors(response);
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
                <img src={doctor.image.profile} className="img-fluid" alt="User Image" />
              </div>
              <div className="doc-info-cont">
                <h4 className="doc-name">{doctor.name}</h4>
                <p className="doc-speciality">{doctor.description.service}</p>
                <div className="rating">
                  <i className="fas fa-star filled" />
                  <i className="fas fa-star filled" />
                  <i className="fas fa-star filled" />
                  <i className="fas fa-star filled" />
                  <i className="fas fa-star" />
                  <span className="d-inline-block average-rating">(35)</span>
                </div>
                <div className="clinic-details">
                  <p className="doc-location"><i className="fas fa-map-marker-alt" /> BeePets Nam Từ Liêm</p>
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
                  <li><i className="far fa-thumbs-up" /> 99%</li>
                  <li><i className="far fa-comment" /> 35 Feedback</li>
                  <li><i className="fas fa-map-marker-alt" /> {doctor.address}</li>
                 
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
                    <p>{doctor.description.about}</p>
                  </div>
                  <div className="widget education-widget">
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
                  </div>
                
                </div>
              </div>
            </div>
        
            <div role="tabpanel" id="doc_reviews" className="tab-pane fade">
              <div className="widget review-listing">
                <ul className="comments-list">
                  <li>
                    <div className="comment">
                      <img className="avatar avatar-sm rounded-circle" alt="User Image" src="../src/assets/img/patients/patient.jpg" />
                      <div className="comment-body">
                        <div className="meta-data">
                          <span className="comment-author">Lê Huy Đạt</span>
                          <span className="comment-date">Đã đánh giá 2 ngày trước</span>
                          <div className="review-count rating">
                            <i className="fas fa-star filled" />
                            <i className="fas fa-star filled" />
                            <i className="fas fa-star filled" />
                            <i className="fas fa-star filled" />
                            <i className="fas fa-star" />
                          </div>
                        </div>
                        <p className="recommended"><i className="far fa-thumbs-up" /> Tôi đánh giá cao bác sĩ này</p>
                        <p className="comment-content">
                        Điều quan trọng là phải tự chăm sóc nỗi đau, sau đó là sự trưởng thành của bệnh nhân, nhưng đồng thời cũng sẽ có rất nhiều công việc và nỗi đau. Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì? Tôi không nghĩ có thời gian để người hâm mộ trò chuyện
                        </p>
                        
                      </div>
                    </div>
             
                  </li>
                  <li>
                    <div className="comment">
                      <img className="avatar avatar-sm rounded-circle" alt="User Image" src="../src/assets/img/patients/patient.jpg" />
                      <div className="comment-body">
                        <div className="meta-data">
                          <span className="comment-author">Vũ Anh Bá</span>
                          <span className="comment-date">Đã đánh giá 1 ngày trước</span>
                          <div className="review-count rating">
                            <i className="fas fa-star filled" />
                            <i className="fas fa-star " />
                            <i className="fas fa-star " />
                            <i className="fas fa-star " />
                            <i className="fas fa-star" />
                          </div>
                        </div>
                        <p className="recommended" style={{color:"red"}}><i className="far fa-thumbs-up" /> Tôi đánh giá thấp bác sĩ này</p>
                        <p className="comment-content">
                        Bác sĩ này làm việc tệ vl, điều quan trọng là phải tự chăm sóc nỗi đau, sau đó là sự trưởng thành của bệnh nhân, nhưng đồng thời cũng sẽ có rất nhiều công việc và nỗi đau. Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì? Tôi không nghĩ có thời gian để người hâm mộ trò chuyện
                        </p>
                        
                      </div>
                    </div>
             
                  </li>
                </ul>
                
              </div>
              <div className="write-review">
                <h4>Viết đánh giá cho <strong>Bác sĩ Tạ Anh Quí</strong></h4>
                <form>
                  <div className="mb-3">
                
                    <div className="star-rating">
                      <input id="star-5" type="radio" name="rating" defaultValue="star-5" />
                      <label htmlFor="star-5" title="5 stars">
                        <i className="active fa fa-star" />
                      </label>
                      <input id="star-4" type="radio" name="rating" defaultValue="star-4" />
                      <label htmlFor="star-4" title="4 stars">
                        <i className="active fa fa-star" />
                      </label>
                      <input id="star-3" type="radio" name="rating" defaultValue="star-3" />
                      <label htmlFor="star-3" title="3 stars">
                        <i className="active fa fa-star" />
                      </label>
                      <input id="star-2" type="radio" name="rating" defaultValue="star-2" />
                      <label htmlFor="star-2" title="2 stars">
                        <i className="active fa fa-star" />
                      </label>
                      <input id="star-1" type="radio" name="rating" defaultValue="star-1" />
                      <label htmlFor="star-1" title="1 star">
                        <i className="active fa fa-star" />
                      </label>
                    </div>
                  </div>
                  <div className="mb-3">
                    <label className="mb-2">Tiêu đề</label>
                    <input className="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?" />
                  </div>
                  <div className="mb-3">
                    <label className="mb-2">Đánh giá của bạn</label>
                    <textarea id="review_desc" maxLength={100} className="form-control" defaultValue={""} />
                    {/* <div className="d-flex justify-content-between mt-3"><small className="text-muted"><span id="chars">100</span> characters remaining</small></div> */}
                  </div>
                  <hr />
               
                  <div className="submit-section">
                    <button type="submit" className="btn btn-primary submit-btn">Đánh giá</button>
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

export default DoctorProfile