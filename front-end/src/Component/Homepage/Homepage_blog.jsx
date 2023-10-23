
import React from 'react'
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import blogApi from '../../api/BlogApi';

const Homepage_Blog = () => {
  const [blogs, setBlogs] = useState([]);

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await blogApi.getAll();
        setBlogs(response.new);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchBlog();
  }, []);
  if (!blogs) {
    return <div>Loading...</div>;
  }

  function truncateText(text, lines) {
    const words = text.split(' ');
    const truncatedText = words.slice(0, lines * 11).join(' ');
    if (words.length > lines * 11) {
      return `${truncatedText} ...`;
    }
    return truncatedText;
  }
  return (
    <div className="blog-section-fourteen">
      <div className="container">
        <div className="row">
          <div className="col-lg-12">
            <div className="section-header-fourteen service-inner-fourteen">
              <div className="service-inner-fourteen">
                <div className="service-inner-fourteen-two">
                  <h3>TIN TỨC</h3>
                </div>
              </div>
              <h2>Tin tức của chúng tôi</h2>
              <p>Các bài viết gần đây của chúng tôi</p>
            </div>
          </div>
        </div>
        <div className="col-lg- col-md-12">
          <div className="row blog-grid-row">

          </div>
        </div>

        <div className="blog-btn-sec text-center aos aos-init aos-animate" data-aos="fade-up">
          <a href="/blog" className="btn btn-primary btn-view">Đọc Thêm Bài Viết</a>
        </div>
      </div>
    </div>
  )
}

export default Homepage_Blog