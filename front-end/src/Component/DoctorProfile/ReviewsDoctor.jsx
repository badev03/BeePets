import React from 'react'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi';
const ReviewsDoctor = () => {
  const { id } = useParams();
  const [reviews, setDoctors] = useState(null);

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await doctorsApi.get(id);
        setDoctors(response.reviews);
        // setDoctors(response.review);
        console.log(response.reviews);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchBlog();
  }, []);
  if (!reviews) {
    return <div>Loading...</div>;
  }
  return (
    <div role="tabpanel" id="doc_reviews" className="tab-pane fade">
      <div className="widget review-listing">
        <ul className="comments-list">
          {reviews.map(review => (
            <li key={review.id}>
              <div className="comment">
                <img className="avatar avatar-sm rounded-circle" alt="User Image" src="../src/assets/img/patients/patient.jpg" />
                <div className="comment-body">
                  <div className="meta-data">
                    <span className="comment-author"></span>
                    <span className="comment-date">Đã đánh giá vào lúc {review.created_at}</span>
                    <div className="review-count rating">
                    {Array.from({ length: review.score }, (_, index) => (
                        <i key={index} className="fas fa-star filled" />
                      ))}
                      {Array.from({ length: 5 - review.score }, (_, index) => (
                        <i key={index} className="fas fa-star" />
                      ))}
                    </div>
                  </div>
                  <p className="recommended"><i className="far fa-thumbs-up" /> Tôi đánh giá cao bác sĩ này</p>
                  <p className="comment-content">
                    {review.content}
                  </p>

                </div>
              </div>

            </li>
          ))}
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

  )
}

export default ReviewsDoctor