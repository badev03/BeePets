import React, { useEffect, useState } from 'react';
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
                console.error('Không có dữ liệu:', error);
            }
        };

        fetchService();
    }, []);

    function limitWords(str, wordLimit) {
        const words = str.split(' ');
        if (words.length > wordLimit) {
            const truncatedWords = words.slice(0, wordLimit).join(' ');
            return truncatedWords + '...';
        }
        return str;
    }

    
    return (
        <div className="container">
            <div className="row">
                <div className="col-lg-12 aos">
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
    {services.map((service, index) => (
        <div className="col-lg-3 col-md-4 col-sm-12 d-flex" key={service.id}>
            <div className="our-services-list w-100">
                <Link to={`/service-detail/${service.slug}`}>
                    <div className="service-icon">
                        {index === 0 && <img src="../src/assets/img/icons/injection.svg" alt="injection-icon" />}
                        {index === 1 && <img src="../src/assets/img/icons/pet-doctor.svg" alt="injection-icon" />}
                        {index === 2 && <img src="../src/assets/img/icons/bath-tub.svg" alt="injection-icon" />}
                        {index === 3 && <img src="../src/assets/img/icons/bottel.svg" alt="injection-icon" />}
                    </div>
                    <h4>{limitWords(service.name, 5)}</h4>
                </Link>
            </div>
        </div>
    ))}
</div>

        </div>
    );
};

export default Services;
