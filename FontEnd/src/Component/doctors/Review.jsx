import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'

const Review = () => {
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
                    <p className="recommended"><i className="far fa-thumbs-up" /> Tôi khuyên bạn nên
                      bác sĩ</p>
                    <p className="comment-content">
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    <div className="comment-reply">
                      <Link className="comment-btn" to="#">
                        <i className="fas fa-reply" /> Phản hồi
                      </Link>
                      <p className="recommend-btn">
                        <span>Gợi ý?</span>
                        <Link to="#" className="like-btn">
                          <i className="far fa-thumbs-up" /> Có
                        </Link>
                        <Link to="#" className="dislike-btn">
                          <i className="far fa-thumbs-down" /> Không
                        </Link>
                      </p>
                    </div>
                  </div>
                </div>
                <ul className="comments-reply">
                  <li>
                    {/* <div className="comment">
                      <img className="avatar rounded-circle" alt="User Image" src="/img/doctors/doctor-thumb-02.jpg" />
                      <div className="comment-body">
                        <div className="meta-data">
                          <span className="comment-author">Dr. Darren Elder</span>
                          <span className="comment-date">Đánh giá 3 ngày trước</span>
                        </div>
                        <p className="comment-content">
                        Điều quan trọng là phải tự chăm sóc nỗi đau, sau đó là sự trưởng thành của bệnh nhân, nhưng đồng thời cũng sẽ có rất nhiều công việc và nỗi đau. Trong những năm qua, tôi sẽ đến. Tôi Không nghĩ có thời gian dành cho người hâm mộ

                        </p>
                        <div className="comment-reply">
                          <Link className="comment-btn" to="#">
                            <i className="fas fa-reply" /> Phản hồi
                          </Link>
                        </div>
                      </div>
                    </div> */}
                  </li>
                </ul>
              </li>
              <li>
                <div className="comment">
                  <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient2.jpg" />
                  <div className="comment-body">
                    <div className="meta-data">
                      <span className="comment-author">Travis Trimble</span>
                      <span className="comment-date">Đánh giá 4 ngày trước</span>
                      <div className="review-count rating">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                      </div>
                    </div>
                    <p className="comment-content">
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    <div className="comment-reply">
                      <Link className="comment-btn" to="#">
                        <i className="fas fa-reply" /> Phản hồi
                      </Link>
                      <p className="recommend-btn">
                        <span>Gợi ý?</span>
                        <Link to="#" className="like-btn">
                          <i className="far fa-thumbs-up" /> Có
                        </Link>
                        <Link to="#" className="dislike-btn">
                          <i className="far fa-thumbs-down" /> Không
                        </Link>
                      </p>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div className="comment">
                  <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient3.jpg" />
                  <div className="comment-body">
                    <div className="meta-data">
                      <span className="comment-author">Carl Kelly</span>
                      <span className="comment-date">Đánh giá 5 ngày trước</span>
                      <div className="review-count rating">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                      </div>
                    </div>
                    <p className="comment-content">
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    <div className="comment-reply">
                      <Link className="comment-btn" to="#">
                        <i className="fas fa-reply" /> Phản hồi
                      </Link>
                      <p className="recommend-btn">
                        <span>Gợi ý?</span>
                        <Link to="#" className="like-btn">
                          <i className="far fa-thumbs-up" /> Có
                        </Link>
                        <Link to="#" className="dislike-btn">
                          <i className="far fa-thumbs-down" /> Không
                        </Link>
                      </p>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div className="comment">
                  <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient4.jpg" />
                  <div className="comment-body">
                    <div className="meta-data">
                      <span className="comment-author">Michelle Fairfax</span>
                      <span className="comment-date">Đánh giá 6 ngày trước</span>
                      <div className="review-count rating">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                      </div>
                    </div>
                    <p className="comment-content">
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    <div className="comment-reply">
                      <Link className="comment-btn" to="#">
                        <i className="fas fa-reply" /> Phản hồi
                      </Link>
                      <p className="recommend-btn">
                        <span>Gợi ý?</span>
                        <Link to="#" className="like-btn">
                          <i className="far fa-thumbs-up" /> Có
                        </Link>
                        <Link to="#" className="dislike-btn">
                          <i className="far fa-thumbs-down" /> Không
                        </Link>
                      </p>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div className="comment">
                  <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient5.jpg" />
                  <div className="comment-body">
                    <div className="meta-data">
                      <span className="comment-author">Gina Moore</span>
                      <span className="comment-date">Đánh giá 1 Week trước</span>
                      <div className="review-count rating">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                      </div>
                    </div>
                    <p className="comment-content">
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    <div className="comment-reply">
                      <Link className="comment-btn" to="#">
                        <i className="fas fa-reply" /> Phản hồi
                      </Link>
                      <p className="recommend-btn">
                        <span>Gợi ý?</span>
                        <Link to="#" className="like-btn">
                          <i className="far fa-thumbs-up" /> Có
                        </Link>
                        <Link to="#" className="dislike-btn">
                          <i className="far fa-thumbs-down" /> Không
                        </Link>
                      </p>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div className="comment">
                  <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient9.jpg" />
                  <div className="comment-body">
                    <div className="meta-data">
                      <span className="comment-author">Walter Roberson</span>
                      <span className="comment-date">Đánh giá 1 Week trước</span>
                      <div className="review-count rating">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                      </div>
                    </div>
                    <p className="comment-content">
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    <div className="comment-reply">
                      <Link className="comment-btn" to="#">
                        <i className="fas fa-reply" /> Phản hồi
                      </Link>
                      <p className="recommend-btn">
                        <span>Gợi ý?</span>
                        <Link to="#" className="like-btn">
                          <i className="far fa-thumbs-up" /> Có
                        </Link>
                        <Link to="#" className="dislike-btn">
                          <i className="far fa-thumbs-down" /> Không
                        </Link>
                      </p>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div className="comment">
                  <img className="avatar rounded-circle" alt="User Image" src="/img/patients/patient8.jpg" />
                  <div className="comment-body">
                    <div className="meta-data">
                      <span className="comment-author">Daniel Griffing</span>
                      <span className="comment-date">Đánh giá on 1 Nov 2023</span>
                      <div className="review-count rating">
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                        <i className="fas fa-star filled" />
                      </div>
                    </div>
                    <p className="comment-content">
                      Việc chăm sóc bệnh nhân là rất quan trọng.
                      nhưng vào thời điểm đó chúng xảy ra như một cơn lao động và đau đớn lớn lao.
                      Để đi đến chi tiết nhỏ nhất, bài tập của chúng ta là gì?
                      Tôi Không nghĩ có thời gian dành cho người hâm mộ
                    </p>
                    <div className="comment-reply">
                      <Link className="comment-btn" to="#">
                        <i className="fas fa-reply" /> Phản hồi
                      </Link>
                      <p className="recommend-btn">
                        <span>Gợi ý?</span>
                        <Link to="#" className="like-btn">
                          <i className="far fa-thumbs-up" /> Có
                        </Link>
                        <Link to="#" className="dislike-btn">
                          <i className="far fa-thumbs-down" /> Không
                        </Link>
                      </p>
                    </div>
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