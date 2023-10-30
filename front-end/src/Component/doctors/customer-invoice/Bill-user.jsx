import React, { useEffect, useState } from 'react';
import ReactPaginate from 'react-paginate';
import axios from 'axios';
import LoadingSkeleton from '../../Loading';
import { Link } from 'react-router-dom';
import { FaChevronLeft, FaChevronRight } from "react-icons/fa";

const BillUser = () => {
    const [bills, setBills] = useState([]);
    const [pageNumber, setPageNumber] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const itemsPerPage = 5; // Số mục trên mỗi trang
    const token = localStorage.getItem('token');
    const today = new Date().toISOString().slice(0, 10);
    useEffect(() => {
        const fetchBills = async () => {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/get-list-history-bill', {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                const data = response.data.bill;
                const billsData = Array.isArray(data) ? data : [data];
                setBills(billsData);
                setIsLoading(false);
            } catch (error) {
                console.error('Không có dữ liệu:', error);
                setIsLoading(false); // Xử lý lỗi
            }
        };
        fetchBills();
    }, [token]);

    const getStatusText = (status) => {
        if (status === 3) {
            return 'Đã thành công';
        } else if (status === 6) {
            return 'Bị hủy';
        } else {
            return '';
        }
    };

    const pageCount = Math.ceil(bills.length / itemsPerPage);

    const changePage = ({ selected }) => {
        setPageNumber(selected);
    };
    function formatDate(dateString) {
        if (dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = new Date(dateString).toLocaleDateString('vi-VN', options);
            // Loại bỏ từ "lúc" từ chuỗi được định dạng
            return formattedDate.replace('lúc', '').trim();
        }
        return '';
    }

    if (isLoading) {
        return <LoadingSkeleton />;
    }

    return (
        <div>
            <div className="card card-table mb-0">
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Mã hóa đơn</th>
                                    <th>Ngày </th>
                                    <th>Giá</th>
                                    <th>Tạo bởi</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {bills.map((bill) => (
                                    <tr key={bill.id}>
                                        <td>
                                            <a href="#">{bill.code}</a>
                                        </td>
                                        <td>{formatDate(bill.date)}</td>
                                        <td>{bill.total_amount} <span style={{ fontWeight: 'bold', color: 'red' }}>VND</span>
                                        </td>

                                        <td>
                                            <h2 className="table-avatar">
                                                <a href="doctor-profile.html" className="avatar avatar-sm me-2">
                                                    <img
                                                        className="avatar-img rounded-circle"
                                                        src={bill.avatar}
                                                        alt="User Image"
                                                    />
                                                </a>
                                                <a href="doctor-profile.html">{bill.doctor_name}</a>
                                            </h2>
                                        </td>
                                        <td>
                                            <span className={`badge rounded-pill ${parseInt(bill.status) === 3 ? 'bg-success-light' : parseInt(bill.status) === 6 ? 'bg-danger-light' : 'YOUR_DEFAULT_CLASS'}`}>{getStatusText(bill.status)}</span>
                                        </td>

                                        <td>
                                            <div className="table-action">
                                                <div className="table-action">
                                                    <button className="btn btn-sm bg-info-light">
                                                        <Link to={`/user/detail-bill/${bill.id}`}>
                                                            <i className="far fa-eye" /> View
                                                        </Link>

                                                    </button>
                                                    {bill.date === today && bill.status === 6 && (
                                                        <button style={{ marginLeft: '5px' }} className="btn btn-sm bg-danger-light">
                                                            <Link to={'/user/billdetail'}>
                                                                <i className="far fa-eye" /> Khôi phục
                                                            </Link>
                                                        </button>
                                                    )}
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br />
            <div className="pagination justify-content-end">
                <ReactPaginate
                    nextLabel={<FaChevronRight />}
                    previousLabel={<FaChevronLeft />}
                    pageCount={pageCount}
                    onPageChange={changePage}
                    containerClassName={'pagination justify-content-end'}
                    previousLinkClassName={'previousBttn'}
                    nextLinkClassName={'nextBttn'}
                    disabledClassName={'paginationDisabled'}
                    activeClassName={'paginationActive'}
                />
            </div>
        </div>
    );
};

export default BillUser;
