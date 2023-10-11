//sevies detail
import React from 'react'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import servicesDetailApi from '../../api/servicesDetailApi';
const ServiceDetails = () => {
    const { id } = useParams();
    const [services, setServices] = useState(null);

    useEffect(() => {
        const fetchBlog = async () => {
            try {
                const response = await servicesDetailApi.get(id);
                setServices(response);
            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };

        fetchBlog();
    }, []);
    if (!services) {
        return <div>Loading...</div>;
    }
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
                                    <h3 className="blog-title">{services['service-detail'].name}</h3>
                                    <div className="blog-image">
                                        <a href="" ><img alt="blog-image" src={services['service-detail'].image} className="img-fluid" /></a>

                                    </div>
                                    <div className="blog-info clearfix">

                                    </div>
                                    <div className="blog-content">
                                        {services['service-detail'].description}

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