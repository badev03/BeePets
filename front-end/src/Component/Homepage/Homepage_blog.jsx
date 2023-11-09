
import React from 'react'
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import HomepageBlogApi from '../../api/homepageBlog';

const Homepage_Blog = () => {
  const [blogs, setBlogs] = useState([]);

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await HomepageBlogApi.getAll();
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
    const truncatedText = words.slice(0, lines *8).join(' ');
    if (words.length > lines * 8) {
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
            {blogs.map(blog => (
              <div key={blog.id} className="col-md-4 col-sm-12">
                <div className="blog grid-blog">
                  <div className="blog-image">
                    <Link to={`/blog/${blog.slug}`}><img className="img-fluid" src={blog.image} alt="Post Image" /></Link>
                  </div>
                  <div className="blog-content">
                    <ul className="entry-meta meta-item">
                      <li><i className="far fa-clock" />{blog.public_date}</li>
                    </ul>
                    <h3 className="blog-title"><Link to={`/blog/${blog.slug}`}>{blog.name}</Link></h3>
                    <p
                      className="mb-0"
                      dangerouslySetInnerHTML={{ __html: truncateText(blog.content, 2) }}
                    ></p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>

        <div className="blog-btn-sec text-center aos aos-init aos-animate" data-aos="fade-up">
          {/* <a href="/blog" className="btn btn-primary btn-view">Đọc Thêm Bài Viết</a> */}
          <Link to="/blog" className="btn btn-primary btn-view">Đọc Thêm Bài Viết</Link>
        </div>
      </div>
    </div>
  )
}

export default Homepage_Blog