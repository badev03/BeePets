import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import ReactPaginate from 'react-paginate';
import doctorsApi from '../../api/doctorsApi';
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import BookingDoctor from './BookingDoctor';


const Search = ({ data }) => {
  const [doctors, setDoctors] = useState([]);
  const [pageNumber, setPageNumber] = useState(0);
  const doctorsPerPage = 3;
  const pagesVisited = pageNumber * doctorsPerPage;
  const [selectedDoctorId, setSelectedDoctorId] = useState(null);

  const handleBookingg = (doctorId) => {
    setSelectedDoctorId(doctorId);
  };
  useEffect(() => {
    const fetchDoctor = async () => {
      try {
        const response = await doctorsApi.getAll();
        setDoctors(response.doctor);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    const fetchDoctorService = async () => {
      try {
        const response = await axios.post(
          `http://127.0.0.1:8000/api/service-filter-doctor`,
          { service: data }
        );
        setDoctors(response.data.service);
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

  const pageCount = Math.ceil(doctors.length / doctorsPerPage);

  const changePage = ({ selected }) => {
    setPageNumber(selected);
  };

  const displayDoctors = doctors
    .slice(pagesVisited, pagesVisited + doctorsPerPage)
    .map(doctor => (
      <div  key={doctor.id} className="card">
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
                <button
                    className="btn btn-info"
                    style={{
                      fontSize: '13px',
                      letterSpacing: 'normal',
                      padding: '7px 20px',
                      width: '200px',
                      marginTop: '10px'

                    }}
                    onClick={() => handleBookingg(doctor.id)}
                  >
                    <BookingDoctor doctorId={selectedDoctorId === doctor.id ? selectedDoctorId : null} />
                  </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      ));

  return (
    <div >
      {displayDoctors}
      <div  className="blog-pagination">
      <ReactPaginate
        nextLabel={<FaChevronRight />}
        previousLabel={<FaChevronLeft />}
        pageCount={pageCount}
        onPageChange={changePage}
        containerClassName={'pagination'}
        previousLinkClassName={'previousBttn'}
        activeClassName={'active'}
      />
      </div>
    </div>
  );
};

export default Search;