import React, { useEffect, useState } from 'react';
import { Link, useParams } from 'react-router-dom';
import ReactPaginate from 'react-paginate';
import { FaChevronLeft, FaChevronRight } from 'react-icons/fa';
import serviceApi from '../../api/serviceApi';
import TopLink from '../../Link/TopLink';
import LoadingSkeleton from '../Loading';
import BreadcrumbBar from '../BreadcrumbBar';

const ListServices = () => {
  const [services, setServices] = useState([]);
  const [currentPage, setCurrentPage] = useState(0);
  const [postsPerPage] = useState(4);
  function truncateText(text, lines) {
    const words = text.split(" ");
    const truncatedText = words.slice(0, lines * 8).join(" ");
    if (words.length > lines * 8) {
      return `${truncatedText} ...`;
    }
    return truncatedText;
  }
  useEffect(() => {
    const fetchService = async () => {
      try {
        const response = await serviceApi.getAll();
        setServices(response.service);
        console.log(response);
      } catch (error) {
        console.error('Không có dữ liệu:', error);
      }
    };

    fetchService();
  }, []);

  const indexOfLastService = (currentPage + 1) * postsPerPage;
  const indexOfFirstService = currentPage * postsPerPage;
  const currentServices = services.slice(indexOfFirstService, indexOfLastService);

  const handlePageClick = ({ selected }) => {
    setCurrentPage(selected);
  };

  return (
    <>
      <BreadcrumbBar title="DỊCH VỤ" lable="Dịch vụ" />

      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-lg-8 col-md-12">
              <div className="row blog-grid-row">
                {currentServices.map((service) => (
                  <div key={service.id} className="col-md-6 col-sm-12">
                    <div className="blog grid-blog">
                      <div className="blog-image">
                        <Link to={`/services/${service.slug}`}>
                          <img
                            className="img-fluid"
                            src={service.image}
                            alt="Post Image"
                            style={{ width: '100%'}}
                          />
                        </Link>
                      </div>
                      <div className="blog-content">
                        <h3 className="blog-title">
                          <Link to={`/services/${service.slug}`}>{service.name}</Link>
                        </h3>
                        <div
                                dangerouslySetInnerHTML={{
                                  __html: truncateText(service.description, 2),
                                }}
                              />
                      </div>
                    </div>
                  </div>
                ))}
              </div>
              <div className="row">
                <div className="col-md-12">
                  <div className="blog-pagination">
                    <ReactPaginate
                      pageCount={Math.ceil(services.length / postsPerPage)}
                      pageRangeDisplayed={3}
                      marginPagesDisplayed={1}
                      onPageChange={handlePageClick}
                      containerClassName={'pagination'}
                      activeClassName={'active'}
                      nextLabel={<FaChevronRight />}
                      previousLabel={<FaChevronLeft />}
                    />
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
                                    <h4 className="card-title">Dịch vụ của chúng tôi</h4>
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
                                                    {/* <p><div>Ngày hôm nay: {currentDate}</div></p> */}
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

export default ListServices;