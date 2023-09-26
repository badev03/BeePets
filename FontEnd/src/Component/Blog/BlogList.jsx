import React from 'react'
import { Link } from 'react-router-dom'

const BlogList = () => {
  return (
    <>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">TIN TỨC</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item"><a href="index.html">Trang Chủ</a></li>
                  <li className="breadcrumb-item" aria-current="page">Tin Tức</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-lg-8 col-md-12">
              <div className="row blog-grid-row">
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <Link to={"/blogdetails"}><img className="img-fluid" src="../src/assets/img/blog/blog-01.jpg" alt="Post Image" /></Link>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-01.jpg" alt="Post Author" /> <span>Dr. Ruby Perrin</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 4 Dec 2023</li>
                      </ul>
                      <h3 className="blog-title"><Link to={"/blogdetails"}>Doccure – Making your clinic painless visit?</Link></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <Link to={"blogdetails"}><img className="img-fluid" src="../src/assets/img/blog/blog-02.jpg" alt="Post Image" /></Link>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-02.jpg" alt="Post Author" /> <span>Dr. Darren Elder</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 3 Dec 2023</li>
                      </ul>
                      <h3 className="blog-title"><Link to={"blogdetails"}>What are the benefits of Online Doctor Booking?</Link></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-03.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-03.jpg" alt="Post Author" /> <span>Dr. Deborah Angel</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 3 Dec 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">Benefits of consulting with an Online Doctor</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-04.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-04.jpg" alt="Post Author" /> <span>Dr. Sofia Brient</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 2 Dec 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">5 Great reasons to use an Online Doctor</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-05.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-05.jpg" alt="Post Author" /> <span>Dr. Marvin Campbell</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 1 Dec 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">Online Doctor Appointment Scheduling</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-06.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-06.jpg" alt="Post Author" /> <span>Dr. Katharine Berthold</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 30 Nov 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">Simple steps to make your doctor visits exceptional!</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-07.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-07.jpg" alt="Post Author" /> <span>Dr. Linda Tobin</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 28 Nov 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">Choose your own Online Doctor Appointment</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-08.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-08.jpg" alt="Post Author" /> <span>Dr. Paul Richard </span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 25 Nov 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">Simple steps to visit your doctor today</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-09.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-09.jpg" alt="Post Author" /> <span>Dr. John Gibbs</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 24 Nov 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">5 Great reasons to use an Online Doctor</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
                <div className="col-md-6 col-sm-12">
                  <div className="blog grid-blog">
                    <div className="blog-image">
                      <a href="blog-details.html"><img className="img-fluid" src="../src/assets/img/blog/blog-10.jpg" alt="Post Image" /></a>
                    </div>
                    <div className="blog-content">
                      <ul className="entry-meta meta-item">
                        <li>
                          <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-10.jpg" alt="Post Author" /> <span>Dr. Olga Barlow</span></a>
                          </div>
                        </li>
                        <li><i className="far fa-clock" /> 23 Nov 2023</li>
                      </ul>
                      <h3 className="blog-title"><a href="blog-details.html">Online Doctoral Programs</a></h3>
                      <p className="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-12">
                  <div className="blog-pagination">
                    <nav>
                      <ul className="pagination justify-content-center">
                        <li className="page-item disabled">
                          <a className="page-link" href="#" tabIndex={-1}><i className="fas fa-angle-double-left" /></a>
                        </li>
                        <li className="page-item">
                          <a className="page-link" href="#">1</a>
                        </li>
                        <li className="page-item active">
                          <a className="page-link" href="#">2 <span className="visually-hidden">(current)</span></a>
                        </li>
                        <li className="page-item">
                          <a className="page-link" href="#">3</a>
                        </li>
                        <li className="page-item">
                          <a className="page-link" href="#"><i className="fas fa-angle-double-right" /></a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
            <div className="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
              <div className="card search-widget">
                <div className="card-body">
                  <form className="search-form">
                    <div className="input-group">
                      <input type="text" placeholder="Search..." className="form-control" />
                      <button type="submit" className="btn btn-primary"><i className="fa fa-search" /></button>
                    </div>
                  </form>
                </div>
              </div>
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
              <div className="card category-widget">
                <div className="card-header">
                  <h4 className="card-title">Danh mục</h4>
                </div>
                <div className="card-body">
                  <ul className="categories">
                    <li><a href="#">Cardiology <span>(62)</span></a></li>
                    <li><a href="#">Health Care <span>(27)</span></a></li>
                    <li><a href="#">Nutritions <span>(41)</span></a></li>
                    <li><a href="#">Health Tips <span>(16)</span></a></li>
                    <li><a href="#">Medical Research <span>(55)</span></a></li>
                    <li><a href="#">Health Treatment <span>(07)</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </>
  )
}

export default BlogList