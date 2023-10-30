import React from 'react'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import doctorsApi from '../../api/doctorsApi';
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import { useAuth } from '../../Context/ContextAuth';
import LoadingSkeleton from '../Loading';
const MySwal = withReactContent(Swal);

const ReviewsDoctor = () => {
  const { id } = useParams();
  const [reviews, setReviews] = useState(null);
  const [doctor, setDoctor] = useState(null);
  const [user, setUser] = useState(null);
  const token = localStorage.getItem('token');
  const { role } = useAuth();

  const fetchDoctors = async () => {
    try {
      const response = await doctorsApi.get(id);
      setReviews(response.reviews);
      setDoctor(response.doctor);
    } catch (error) {
      console.error("Không có dữ liệu:", error);
    }
  };
  const addReviews = async (data, params) => {
    
    try {
      const response = await doctorsApi.addReviews( data, params);
      return response;
    } catch (error) {
      throw new Error(`Error adding reviews: ${error}`);
    }
  };
  const handleAddReview = async (event) => {
    event.preventDefault();
    const reviewContents = document.getElementById("review_desc").value;
    const ratingInputs = document.getElementsByName("rating");
    let score = 0;
    for (let i = 0; i < ratingInputs.length; i++) {
      if (ratingInputs[i].checked) {
        score = 5 - i;
        break;
      }
    }
    if (!user) {
      MySwal.fire({
        title: "Bạn chưa đăng nhập!",
        text: "Vui lòng đăng nhập trước khi gửi đánh giá.",
        icon: "error",
      });
      return;
    }
    if (reviewContents.trim() === "") {
      MySwal.fire({
        title: "Nội dung đánh giá không được để trống!",
        icon: "error",
      });
      return;
    }
    if (score === 0) {
      MySwal.fire({
        title: "Vui lòng chọn số sao đánh giá bác sĩ!",
        icon: "error",
      });
      return;
    }
    const data = {
      doctor_id: doctor.id,
      user_id: user.id,
      contents: reviewContents,
      score: score,
    };
    console.log(data)

    const params = { headers: { Authorization: `Bearer ${token}` } };
    try {
      const response = await addReviews(data, params);
      console.log('Đánh giá của bạn đã được gửi thành công:', response);
      MySwal.fire({
        title: "Đánh giá của bạn đã được gửi thành công!",
        icon: "success",
      });
      document.getElementById("review_desc").value = ""; // Clear content
      for (let i = 0; i < ratingInputs.length; i++) {
        ratingInputs[i].checked = false; // Clear score
      }
      fetchDoctors()
      // Thực hiện các hành động cần thiết sau khi gửi đánh giá thành công
    } catch (error) {
      console.error('Đã xảy ra lỗi khi gửi đánh giá:', error);
      MySwal.fire({
        title: "Đã xảy ra lỗi khi gửi đánh giá!",
        text: `Error: ${error.message}`,
        icon: "error",
      });
    }
  };
  useEffect(() => {
    const userFromLocalStorage = JSON.parse(localStorage.getItem('user'));
    setUser(userFromLocalStorage);
    fetchDoctors();
  }, []);
  function formatDate(dateString) {
    if (dateString) {
        const options = { year: "numeric", month: "long", day: "numeric" };
        const date = new Date(dateString);
        const formattedDate = date.toLocaleDateString("vi-VN", options);
        const time = date.toLocaleTimeString("vi-VN", { hour: '2-digit', minute: '2-digit' });
        // Loại bỏ từ "lúc" từ chuỗi được định dạng
        return `${time} ngày ${formattedDate.replace("lúc", "").trim()}`;
    }
    return "";
}
  if (!reviews) {
    return <LoadingSkeleton/>

  }
  return (
    <div role="tabpanel" id="doc_reviews" className="tab-pane fade">
      <div className="widget review-listing" >
        <ul className="comments-list" >
          {reviews.map(review => (
            <li key={review.id}>
              <div className="comment" >
                <img className="avatar avatar-sm rounded-circle" alt="User Image" src={review.avatar} />
                <div className="comment-body" style={{width:"100%"}}>
                  <div className="meta-data">
                    <span className="comment-author">{review.user_name}</span>
                    <span className="comment-date">Đã đánh giá vào lúc {formatDate(review.created_at)}</span>
                    <div className="review-count rating">
                    {Array.from({ length: review.score }, (_, index) => (
                        <i key={index} className="fas fa-star filled" />
                      ))}
                      {Array.from({ length: 5 - review.score }, (_, index) => (
                        <i key={index} className="fas fa-star" />
                      ))}
                    </div>
                  </div>
                 
                  <p className="comment-content" >
                    Nội dung đánh giá :  {review.content}                  
                  </p>

                </div>
              </div>

            </li>
          ))}
        </ul>

      </div>
      {role !== "doctor" && ( 
                 <div className="write-review">
                 <h4>Viết đánh giá cho <strong>Bác sĩ {doctor.name}</strong></h4>
                 <form onSubmit={handleAddReview}>
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
                       <label className="mb-2">Đánh giá của bạn</label>
                       <textarea id="review_desc" maxLength={300} className="form-control" defaultValue={""} />
                     </div>
                     <hr />
                     <div className="submit-section">
                       <button type="submit" className="btn btn-primary submit-btn">Đánh giá</button>
                     </div>
                 </form>
               </div>
              )}
    
    </div>

  )
}

export default ReviewsDoctor