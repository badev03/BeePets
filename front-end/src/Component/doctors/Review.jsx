import React, { useEffect } from 'react'
import Menudashboard from './Menu-dashboard'
import { Link } from 'react-router-dom'
import { useState } from 'react'
import reviewsDoctorApi from '../../api/reviews-doctor'
import axios from 'axios'




// const [reviews, setReviews] = useState([]);

// useEffect(() => {
//   const fetchBlog = async () => {
//     try {
//       const response = await reviewsDoctorApi.getAll();
//       setReviews(response.reviews);
//       console.log(response);
//     } catch (error) {
//       console.error("Không có dữ liệu:", error);
//     }
//   };

//   fetchBlog();
// }, []);

const Review = () => {
  const [reviews, setReviews] = useState([]);
  const token = localStorage.getItem('token');
  useEffect(() => {
    getReview();
  }, [])
  const getReview = async () => {
    try {
      const response = await reviewsDoctorApi.getAll(token);
      setReviews(response.data.reviews);

    } catch (error) {
      console.error("Không có dữ liệu:", error);
    }
  }
  if (!reviews) {
    return <div>Loading...</div>;
  }


  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Đánh giá</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
                  <li className="breadcrumb-item" aria-current="page">Đánh giá</li>
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
              <div className="doc-review review-listing">
                {reviews.length > 0 ? (

                  reviews.map((item, index) => {
                    return (<ul className="comments-list" key={index}>
                      <li>
                        <div className="comment">
                          <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient.jpg" />
                          <div className="comment-body">
                            <div className="meta-data">
                              <span className="comment-author">{item.user_name}</span>
                              <span className="comment-date">Đánh giá lúc:  {item.created_at}</span>
                              <div className="review-count rating">
                                <i className="fas fa-star filled" />
                                <i className="fas fa-star filled" />
                                <i className="fas fa-star filled" />
                                <i className="fas fa-star filled" />
                                <i className="fas fa-star" />
                              </div>
                            </div>
                            {/* <p className="recommended"><i className="far fa-thumbs-up" /> Tôi khuyên bạn nên
                      bác sĩ</p> */}
                            <p className="comment-content">
                              {item.content}
                            </p>

                          </div>
                        </div>

                      </li>


                    </ul>)
                  })

                ) : (<p>Không có đánh giá nào ở đây !</p>)
                }

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  )
}

export default Review