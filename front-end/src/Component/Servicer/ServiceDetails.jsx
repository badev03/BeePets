import React from 'react'

const ServiceDetails = () => {
  return (
    <>
    <div className="breadcrumb-bar-two">
        <div className="container">
        <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
            <h2 className="breadcrumb-title">CHI TIẾT DỊCH VỤ</h2>
            <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                <li className="breadcrumb-item"><a href="index.html">Trang Chủ</a></li>
                <li className="breadcrumb-item" aria-current="page">Giới Thiệu</li>
                <li className="breadcrumb-item" aria-current="page">Dịch Vụ</li>
                <li className="breadcrumb-item" aria-current="page">Tiêm chủng</li>
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
            <div className="blog-view">
                <div className="blog blog-single-post">
                <h3 className="blog-title">Doccure – Making your clinic painless visit?</h3>
                <div className="blog-image">
                    <a href="javascript:void(0);"><img alt="blog-image" src="../src/assets/img/blog/blog-01.jpg" className="img-fluid" /></a>
                </div>
                <div className="blog-info clearfix">
                    <div className="post-left">
                    <ul>
                        <li>
                        <div className="post-author">
                            <a href="doctor-profile.html"><img src="../src/assets/img/doctors/doctor-thumb-02.jpg" alt="Post Author" /> <span>Dr. Darren Elder</span></a>
                        </div>
                        </li>
                        <li><i className="far fa-calendar" />4 Dec 2023</li>
                        <li><i className="far fa-comments" />12 Comments</li>
                        <li><i className="fa fa-tags" />Health Tips</li>
                    </ul>
                    </div>
                </div>
                <div className="blog-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum....</p>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
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
            </div>
        </div>
        </div>
    </div>
</>
  )
}

export default ServiceDetails