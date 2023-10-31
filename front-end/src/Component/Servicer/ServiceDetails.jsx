import React from 'react';
import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import ReactHtmlParser from 'react-html-parser';
import servicesDetailApi from '../../api/serviceApi';
import LoadingSkeleton from '../Loading';
import serviceApi from '../../api/serviceApi';

const ServiceDetails = () => {
    const { slug } = useParams();
    const [service, setService] = useState(null);
    const [isLoading, setIsLoading] = useState(true);
    const [currentDate, setCurrentDate] = useState('');

    useEffect(() => {
        const fetchBlog = async () => {
            try {
                const response = await servicesDetailApi.get(slug);
                setService(response);
                setIsLoading(false);
            } catch (error) {
                console.error('Không có dữ liệu:', error);
                setIsLoading(false);
            }
        };

        fetchBlog();
    }, []);
    const [services, setServices] = useState([]);

    useEffect(() => {
        const fetchService = async () => {
            try {
                const response = await serviceApi.getAll();
                setServices(response.service);
            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };

        fetchService();
        setCurrentDate(new Date().toLocaleDateString());
    }, []);

    if (isLoading) {
        return <LoadingSkeleton />;
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
                                    <li className="breadcrumb-item"><a href="/">Trang Chủ</a></li>
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
                                    <h3 className="blog-title">{service['service-detail'].name}</h3>
                                    <div className="blog-image">
                                        <a href="">
                                            <img alt="blog-image" src={service['service-detail'].image} className="img-fluid" />
                                        </a>
                                    </div>
                                    <div className="blog-info clearfix"></div>
                                    <div className="blog-content">
                                        {ReactHtmlParser(service['service-detail'].description)}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="col-lg-4 col-md-12 sslugebar-right theiaStickySslugebar">
                            {/* <div className="card search-wslugget">
                                <div className="card-body">
                                    <form className="search-form">
                                        <div className="input-group">
                                            <input type="text" placeholder="Search..." className="form-control" />
                                            <button type="submit" className="btn btn-primary"><i className="fa fa-search" /></button>
                                        </div>
                                    </form>
                                </div>
                            </div> */}
                            <div className="card post-wslugget">
                                <div className="card-header">
                                    <h4 className="card-title">Dịch vụ liên quan</h4>
                                </div>
                                <div className="card-body">
                                {services.map(services => (
                                    <ul className="latest-posts">
                                    <li>
                                        <div className="post-thumb">
                                            <a href="blog-details.html">
                                                <img className="img-fluslug" src="../src/assets/img/blog/blog-thumb-01.jpg" alt="blog-image" />
                                            </a>
                                        </div>
                                        <div className="post-info">
                                            <h4>
                                                <a href="blog-details.html">{services.name}</a>
                                            </h4>
                                            <p><div>Ngày hôm nay: {currentDate}</div></p>
                                        </div>
                                    </li>
                                    <br />
                                    
                                    
                                </ul>
                                ))}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default ServiceDetails;
