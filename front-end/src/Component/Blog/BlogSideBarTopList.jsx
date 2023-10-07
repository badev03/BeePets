
const BlogSideBarTopList = () => {
  return (
    <div className="card post-widget">
                <div className="card-header">
                  <h4 className="card-title">Bài viết mới nhất</h4>
                </div>
                <div className="card-body">
                  <ul className="latest-posts">
                    <li>
                      <div className="post-thumb">
                        <a href="blog-details.html">
                          <img className="img-fluid" src="../src/assets/img/blog/blog-thumb-01.jpg" alt="blog-image" />
                        </a>
                      </div>
                      <div className="post-info">
                        <h4>
                          <a href="blog-details.html">Doccure – Making your clinic painless visit?</a>
                        </h4>
                        <p>4 Dec 2023</p>
                      </div>
                    </li>
                    <li>
                      <div className="post-thumb">
                        <a href="blog-details.html">
                          <img className="img-fluid" src="../src/assets/img/blog/blog-thumb-02.jpg" alt="blog-image" />
                        </a>
                      </div>
                      <div className="post-info">
                        <h4>
                          <a href="blog-details.html">What are the benefits of Online Doctor Booking?</a>
                        </h4>
                        <p>3 Dec 2023</p>
                      </div>
                    </li>
                    <li>
                      <div className="post-thumb">
                        <a href="blog-details.html">
                          <img className="img-fluid" src="../src/assets/img/blog/blog-thumb-03.jpg" alt="blog-image" />
                        </a>
                      </div>
                      <div className="post-info">
                        <h4>
                          <a href="blog-details.html">Benefits of consulting with an Online Doctor</a>
                        </h4>
                        <p>3 Dec 2023</p>
                      </div>
                    </li>
                    <li>
                      <div className="post-thumb">
                        <a href="blog-details.html">
                          <img className="img-fluid" src="../src/assets/img/blog/blog-thumb-04.jpg" alt="blog-image" />
                        </a>
                      </div>
                      <div className="post-info">
                        <h4>
                          <a href="blog-details.html">5 Great reasons to use an Online Doctor</a>
                        </h4>
                        <p>2 Dec 2023</p>
                      </div>
                    </li>
                    <li>
                      <div className="post-thumb">
                        <a href="blog-details.html">
                          <img className="img-fluid" src="../src/assets/img/blog/blog-thumb-05.jpg" alt="blog-image" />
                        </a>
                      </div>
                      <div className="post-info">
                        <h4>
                          <a href="blog-details.html">Online Doctor Appointment Scheduling</a>
                        </h4>
                        <p>1 Dec 2023</p>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
  )
}

export default BlogSideBarTopList