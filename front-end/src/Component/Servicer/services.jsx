//sevice
import React from 'react'
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom';
import serviceApi from '../../api/serviceApi';

const Services = () => {
    const [services, setServices] = useState([]);

    useEffect(() => {
        const fetchService = async () => {
            try {
                const response = await serviceApi.getHome();
                setServices(response.service);
                console.log(response);
            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };

        fetchService();
    }, []);
    return (
        <div className="container">
            <div className="row">
                <div className="col-lg-12 aos" >
                    <div className="section-header-fourteen service-inner-fourteen">
                        <div className="service-inner-fourteen">
                            <div className="service-inner-fourteen-two">
                                <h3>DỊCH VỤ CỦA CHÚNG TÔI</h3>
                            </div>
                        </div>
                        <h2>Chúng tôi có thể</h2>
                        <p>Dịch vụ chuyên nghiệp của chúng tôi</p>
                    </div>
                </div>
            </div>
            <div className="row row-gap justify-content-center">
                {services.map(service => (

                    <div className="col-lg-3 col-md-4 col-sm-12 d-flex" key={service.id}>

                        <div className="our-services-list w-100">
                            <Link to={`/services/details/${service.id}`}>

                                <div className="service-icon">
                                    <img
                                        src="../src/assets/img/icons/injection.svg"
                                        alt="injection-icon"
                                    />
                                </div>

                                <h4>{service.name}</h4>
                                <p>
                                    {service.slug}
                                </p>
                            </Link>

                        </div>

                    </div>

                ))}
            </div>

        </div>
    )
}

export default Services