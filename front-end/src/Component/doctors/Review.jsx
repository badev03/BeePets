import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import { useEffect, useState } from 'react'
import reviewsApi from '../../api/reviews';



const Review = () => {
  const [reviews, setReviews] = useState([]);

    useEffect(() => {
        const fetchBlog = async () => {
            try {
                const response = await reviewsApi.getAll();
                setReviews(response);
                console.log(services);
            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };

        fetchBlog();
    }, []);
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
          <Menudashboard/>
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9">
          <div className="doc-review review-listing">

            <ul className="comments-list">
              
              <li>
                <div className="comment">
                  <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient.jpg" />
                  <div className="comment-body">
                    <div className="meta-data">
                      <span className="comment-author">Richard Wilson</span>
                      <span className="comment-date">Đánh giá 2 ngày trước</span>
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
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    
                  </div>
                </div>
                
              </li>
              
              
            </ul>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  )
}

export default Review