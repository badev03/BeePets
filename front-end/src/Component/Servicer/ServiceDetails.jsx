import React from 'react';
import { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import servicesDetailApi from '../../api/serviceApi';
import LoadingSkeleton from '../Loading';
import serviceApi from '../../api/serviceApi';
import BreadcrumbBar from '../BreadcrumbBar';

const ServiceDetails = () => {
    const { slug } = useParams();
    const [service, setService] = useState('');
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
    }, [slug]);
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
                        <BreadcrumbBar title="CHI TIẾT DỊCH VỤ" lable="CHi tiết dịch vụ" />

            <div className="content">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8 col-md-12">
                            <div className="blog-view">
                                <div className="blog blog-single-post">
                                    <h3 className="blog-title">{service['service-detail'].name}</h3>
                                    <div className="blog-image">
                                  
                                            <img alt="blog-image" src={service['service-detail'].image} className="img-fluid" />
                                     
                                    </div>
                                    <div className="blog-info clearfix"></div>
                                    {service && service['service-detail'] && (
                                        <div dangerouslySetInnerHTML={{ __html: service['service-detail'].description }} />
                                    )}
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
                                        <ul className="latest-posts" >
                                    {services.map((service) => (

                                            <li key={service.id}>
                                                <div className="post-thumb">
                                                    <Link to={`/services/${service.slug}`}>
                                                    <img className="img-fluslug" src={service.image} alt="blog-image" />
                                                    </Link>
                                                </div>
                                                <div className="post-info">
                                                    <h4>
                                                    <Link to={`/services/${service.slug}`}>{service.name}</Link>
                                                    </h4>
                                                    <p><div>Ngày hôm nay: {currentDate}</div></p>
                                                </div>
                                            </li>
                                    ))}

                                     
                                        </ul>

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
