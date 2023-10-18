import React from 'react'
import doctorsApi from '../../api/doctorsApi';
import { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import serviceApi from '../../api/serviceApi';
import axios from 'axios';
import BookingDoctor from './BookingDoctor';


const Search = ({ data }) => {
  const [doctors, setDoctors] = useState([]);
  console.log(data);
  const [selectedDoctorId, setSelectedDoctorId] = useState(null);

  const handleBookingg = (doctorId) => {
    setSelectedDoctorId(doctorId);
  };

  useEffect(() => {
    const fetchDoctor = async () => {
      try {
        // console.log(data);
        const response = await doctorsApi.getAll();
        setDoctors(response.doctor);
        console.log(response);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };
    const fetchDoctorService = async () => {
      try {
        console.log(data);
        const response = await axios.post(
          `http://127.0.0.1:8000/api/service-filter-doctor`,
          { service: data },
        );
        setDoctors(response.data.service);
        console.log(response.data.service);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };
    if (data.length === 0) {
      fetchDoctor();
    } else {
      fetchDoctorService();
    }

  }, [data]);

  return (
    <div>



      {doctors.map(doctor => (
        <div key={doctor.id} className="card">
          <div className="card-body">
            <div className="doctor-widget">
              <div className="doc-info-left">
                <div className="doctor-img">
                  <a href="doctor-profile.html">
                    <img src={doctor.image} className="img-fluid" alt="User Image" />
                  </a>
                </div>
                <div className="doc-info-cont">
                  <h4 className="doc-name">
                    <Link to={`/doctor/profile/${doctor.slug}`}>{doctor.name}</Link>
                  </h4>
                  {/* <p className="doc-speciality">{doctor.description.service}
                    </p> */}

                  <div className="rating">
                    {Array.from({ length: doctor.average_score }, (_, index) => (
                      <i key={index} className="fas fa-star filled" />
                    ))}
                    {Array.from({ length: 5 - doctor.average_score }, (_, index) => (
                      <i key={index} className="fas fa-star" />
                    ))}
                    <span className="d-inline-block average-rating">( {doctor.review_count} )</span>
                  </div>
                  <div className="clinic-details">
                    <p className="doc-location"><i className="fas fa-map-marker-alt" />{doctor.address}</p>
                    <ul className="clinic-gallery">
                      <li>
                        <a href={doctor.image.anh1} data-fancybox="gallery">
                          <img src={doctor.image.anh1} alt="Feature" />
                        </a>
                      </li>
                      <li>
                        <a href={doctor.image.anh2} data-fancybox="gallery">
                          <img src={doctor.image.anh2} alt="Feature" />
                        </a>
                      </li>
                      <li>
                        <a href={doctor.image.anh3} data-fancybox="gallery">
                          <img src={doctor.image.anh3} alt="Feature" />
                        </a>
                      </li>
                      <li>
                        <a href={doctor.image.anh4} data-fancybox="gallery">
                          <img src={doctor.image.anh4} alt="Feature" />
                        </a>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
              <div className="doc-info-right">
                <div className="clini-infos">
                  <ul>
                    {/* <li><i className="far fa-thumbs-up" /> 98%</li> */}
                    <li><i className="far fa-comment" /> {doctor.review_count} Feedback</li>
                    {/* <li><i className="fas fa-map-marker-alt" /> Florida, USA</li> */}
                  </ul>
                </div>
                <div className="clinic-booking">
                  <Link className="view-pro-btn" to={`/doctor/profile/${doctor.slug}`}>Xem hồ sơ</Link>
                  <button className="apt-btn" onClick={() => handleBookingg(doctor.id)}>
                    <BookingDoctor doctorId={selectedDoctorId === doctor.id ? selectedDoctorId : null} />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      ))}


      <div className="load-more text-center">
        <a className="btn btn-primary btn-sm prime-btn" href="#">Xem thêm</a>
      </div>
    </div>


  )
}

export default Search