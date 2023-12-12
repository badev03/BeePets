import React from 'react'
import { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import ReactPaginate from "react-paginate";
// import BlogSideBar from "./BlogSideBar";
import serviceApi from '../../api/serviceApi';
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";
import TopLink from "../../Link/TopLink";
import LoadingSkeleton from '../Loading';

const ListServices = () => {
    const [blogs, setBlogs] = useState([]);
    const { id } = useParams()
    const [currentPage, setCurrentPage] = useState(0);
    const [postsPerPage] = useState(2);
    const [searchTerm, setSearchTerm] = useState("");
    const [searchedBlogs, setSearchedBlogs] = useState([]);
    const [showPagination, setShowPagination] = useState(true);
    const [noSearchResults, setNoSearchResults] = useState(false);
    const [currentDate, setCurrentDate] = useState('');
    const [service, setService] = useState(null);
    const [services, setServices] = useState("");





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

    function truncateText(text, lines) {
        const words = text.split(" ");
        const truncatedText = words.slice(0, lines * 8).join(" ");
        if (words.length > lines * 8) {
            return `${truncatedText} ...`;
        }
        return truncatedText;
    }

    const indexOfLastPost = (currentPage + 1) * postsPerPage;
    const indexOfFirstPost = currentPage * postsPerPage;
    const currentPosts = blogs.slice(indexOfFirstPost, indexOfLastPost);
    if (!services) {
        return <LoadingSkeleton />;
    }
    const handlePageClick = ({ selected }) => {
        setCurrentPage(selected);
    };
    return (
        <>
            <div className="breadcrumb-bar-two">
                <div className="container">
                    <div className="row align-items-center inner-banner">
                        <div className="col-md-12 col-12 text-center">
                            <h2 className="breadcrumb-title">DỊCH VỤ</h2>
                            <nav aria-label="breadcrumb" className="page-breadcrumb">
                                <ol className="breadcrumb">
                                    <li className="breadcrumb-item">
                                        <TopLink to="/">Trang Chủ</TopLink>
                                    </li>
                                    <li className="breadcrumb-item" aria-current="page">
                                        Dịch Vụ
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div className="content">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-12 col-md-12">
                            <div className="row blog-grid-row">
                            {services.map((service, index) => (
                                            <div key={service.id} className="col-md-3 col-sm-12">
                                                <div className="blog grid-blog">
                                                    <div className="blog-image">
                                                        <Link to={`/services/${service.slug}`}>
                                                            <img
                                                                className="img-fluid"
                                                                src={service.image}
                                                                alt="Post Image"
                                                                style={{width:"100%",height:"200px"}}
                                                            />
                                                        </Link>
                                                    </div>
                                                    <div className="blog-content">
                                                        <ul className="entry-meta meta-item">
                                                            {/* <li>
                                                                <i style={{ marginRight: 8 }} className="far fa-clock" />
                                                                {blog.public_date}
                                                            </li> */}
                                                        </ul>
                                                        <h3 className="blog-title">
                                                            <Link to={`/services/${service.slug}`}>{service.name}</Link>
                                                        </h3>
                                                        {/* <div
                                                            dangerouslySetInnerHTML={{
                                                                __html: truncateText(service.description, 2),
                                                            }}
                                                        /> */}
                                                    </div>
                                                </div>
                                            </div>
                                  ))}
                            </div>
                            <div className="row">
                                <div className="col-md-12">
                                    {/* <div className="blog-pagination">
                                        {showPagination && (
                                            <ReactPaginate
                                                pageCount={Math.ceil(
                                                    searchedBlogs.length > 0
                                                        ? searchedBlogs.length / postsPerPage
                                                        : blogs.length / postsPerPage
                                                )}
                                                pageRangeDisplayed={3}
                                                marginPagesDisplayed={1}
                                                onPageChange={handlePageClick}
                                                containerClassName={"pagination"}
                                                activeClassName={"active"}
                                                nextLabel={<FaChevronRight />}
                                                previousLabel={<FaChevronLeft />}
                                            />
                                        )}
                                    </div> */}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </>
    )
}

export default ListServices