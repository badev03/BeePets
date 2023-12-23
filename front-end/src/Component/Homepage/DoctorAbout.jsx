import React from 'react'
import { useEffect, useState } from 'react'
import { Link, useParams } from 'react-router-dom';
import LoadingSkeleton from '../Loading';
import HomepageDoctor from '../../api/hompageDoctor';

const DoctorAbout = () => {
    const [doctor, setDoctors] = useState(null);

    useEffect(() => {
        const fetchDoctor = async () => {
            try {
                const response = await HomepageDoctor.getAll();
                setDoctors(response.doctor);

            } catch (error) {
                console.error("Không có dữ liệu:", error);
            }
        };


        fetchDoctor();
    }, []);
    if (!doctor) {
        return <LoadingSkeleton />;
    }
    return (
        <div className="blog-section-fourteen our-doctor-twelve">
            <div className="floating-bg">
                <img src="/assets/img/bg/small-paw.png" alt="paw-image" />
                <img src="/assets/img/bg/big-paw.png" alt="paw-image" />
            </div>
            {/* <Homepage_doctors /> */}
            <div className="container">
                <div className="row">
                    <div className="col-lg-12">
                        <div className="section-header-fourteen service-inner-fourteen">
                            <h2>Bác sĩ hàng đầu</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div className="owl-carousel blog-slider-twelve owl-theme aos" >
                    {doctor.map((doctor) => (
                        <div className="col-lg-3 col-md-3 col-sm-6 col-12" key={doctor.id}>
                            <div className="card blog-inner-fourt-all d-flex"
                            >

                                <div className="card-body blog-inner-fourt-main">
                                    <div className="blog-inner-right-fourt">
                                        <Link to={`/doctor/profile/${doctor.slug}`} >
                                            <div className="blog-inner-right-img">
                                                <Link to={`/doctor/profile/${doctor.slug}`}>
                                                    <img className="img-fluid" style={{ height: '268px', width: '278px' }} src={doctor.image} alt="image" />
                                                </Link>
                                                <div className="blog-inner-top-content">
                                                    <span>   Bác sĩ</span>
                                                </div>
                                            </div>
                                        </Link>
                                        <h4 className="blog-inner-right-fourt-care">
                                            <Link to={`/doctor/profile/${doctor.slug}`} >{doctor.name}</Link>
                                        </h4>
                                        <ul className="articles-list nav blog-articles-list">
                                            <li>
                                                <i className="fa fa-location-dot" />{doctor.address ? doctor.address : 'Ha Noi'}
                                            </li>
                                        </ul>
                                        <div className="blog-list-ratings">
                                            {Array.from({ length: doctor.average_score }, (_, index) => (
                                                <i key={index} className="fa-solid fa-star rated" />
                                            ))}
                                            {Array.from({ length: 5 - doctor.average_score }, (_, index) => (
                                                <i key={index} className="fas fa-star" />
                                            ))}
                                            <span>({doctor.review_count})</span>
                                        </div>
                                        <Link to={`/doctor/profile/${doctor.slug}`} className="btn btn-primary">Xem chi tiết</Link>
                                    </div>
                                </div>
                            </div>
                        </div>

                    ))}
                </div>


                <div className="blog-btn-sec text-center aos aos-init aos-animate" >
                    <Link to="/doctor" className="btn btn-primary btn-view">Tất Cả Bác Sĩ</Link>
                    {/* <a href="/doctor" className="btn btn-primary btn-view">Tất Cả Bác Sĩ</a> */}
                </div>
            </div>
        </div>
    )
}


export default DoctorAbout