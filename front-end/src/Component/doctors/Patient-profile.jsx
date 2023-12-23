import React from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom';
import listCustomersApi from '../../api/listCustomers';
import AppoimentList from './List-Appoiment';
import { useAuth } from '../../Context/ContextAuth';
import logoutDoctor from '../../api/logoutDoctor';
import PatientBill from './PatientBill';
import LoadingSkeleton from '../Loading';
import Prescription from './Prescription';
import BreadcrumbBar from '../BreadcrumbBar';

const Patientprofile = () => {
  const { id } = useParams();
  const [customers, setCustomers] = useState(null);

  const [loading, setLoading] = useState(true);
  const token = localStorage.getItem('token');
  const navigate = useNavigate();
  const { onLogout } = useAuth(); // Sử dụng context để lấy hàm onLogout

  const handleLogout = async () => {
    // Gọi hàm logout khi người dùng nhấp vào "Đăng Xuất"
    try {
      await logoutDoctor.logout({
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      onLogout(); // Gọi hàm onLogout để xác định người dùng đã đăng xuất
      navigate('/'); // Sau khi đăng xuất, điều hướng đến trang chính hoặc trang bạn muốn
    } catch (error) {
      console.log(error);
    }
  };
  if (token) {
    useEffect(() => {
      const fetchCustomers = async () => {
        try {
          const response = await listCustomersApi.get(id,
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );
          setCustomers(response.customer);
          // console.log(response);
          setLoading(false);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };

      fetchCustomers();
    }, []);

  }


  const initialActiveItems = JSON.parse(
    localStorage.getItem("activeItems")
  ) || ["Khách hàng của tôi"];
  const [activeItems, setActiveItems] = useState(initialActiveItems);

  const handleItemClick = (itemName) => {
    setActiveItems((prevActiveItems) => {
      if (prevActiveItems.includes(itemName)) {
        return prevActiveItems.filter((item) => item !== itemName);
      } else {
        return [itemName];
      }
    });
  };

  const handleScroll = () => {
    const position = window.scrollY;
    setScrollPosition(position);
  };

  useEffect(() => {
    localStorage.setItem("activeItems", JSON.stringify(activeItems));
  }, [activeItems]);

  useEffect(() => {
    window.addEventListener("scroll", handleScroll, { passive: true });

    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);
  if (loading) {
    return <LoadingSkeleton />
  }
  return (
    <div>
             <BreadcrumbBar title="CHI TIẾT KHÁCH HÀNG" lable="Chi tiết khách hàng" />

      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">
              <div >
                <div className="profile-sidebar" >
                  <div className="widget-profile pro-widget-content">
                    <div className="profile-info-widget">
                      <div className="pro-widget-content">
                        <div className="profile-info-widget">
                          <Link to="#" className="booking-doc-img">
                            <img src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" alt="User Image" />
                          </Link>
                          <div className="profile-det-info">
                            <h3>{customers.name}</h3>
                            <div className="patient-details">
                              <h5><b>Patient ID :</b> {customers.id}</h5>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div className="patient-info d-flex justify-content-center">
                        <ul>
                          <li>SĐT:  <span>{customers.phone}</span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div className="dashboard-widget">
                    <nav className="dashboard-menu">
                      <ul>
                        <li
                          className={`has-submenu megamenu ${location.pathname === "/doctors" ? "active" : ""
                            }`}
                          onClick={() => handleItemClick("Bảng điều khiển")}
                        >
                          <Link to={"/doctors"}>
                            <i className="fas fa-columns" />
                            <span>Bảng điều khiển</span>
                          </Link>
                        </li>
                        <li
                          className={`has-submenu megamenu ${location.pathname === "/doctors/appointments" ? "active" : ""
                            }`}
                          onClick={() => handleItemClick("Cuộc hẹn")}
                        >
                          <Link to={"/doctors/appointments"}>
                            <i className="fas fa-calendar-check" />
                            <span>Cuộc hẹn</span>
                          </Link>
                        </li>
                        <li
                          className='active'
                        >
                          <Link to={"/doctors/patients"}>
                            <i className="fas fa-user-injured" />
                            <span>Khách hàng của tôi</span>
                          </Link>
                        </li>
                        <li
                          className={`has-submenu megamenu ${location.pathname === "/doctors/customer-invoice" ? "active" : ""
                            }`}
                          onClick={() => handleItemClick("Hóa đơn của khách hàng")}
                        >
                          <Link to={"/doctors/customer-invoice"}>
                            <i className="fas fa-user-injured" />
                            <span>Hóa đơn của khách hàng</span>
                          </Link>
                        </li>
                        <li
                          className={`has-submenu megamenu ${location.pathname === "/doctors/review" ? "active" : ""
                            }`}
                          onClick={() => handleItemClick("Đánh giá")}
                        >
                          <Link to={"/doctors/review"}>
                            <i className="fas fa-star" />
                            <span>Đánh giá</span>
                          </Link>
                        </li>
                        <li
                          className={`has-submenu megamenu ${location.pathname === "/doctors/profile" ? "active" : ""
                            }`}
                          onClick={() => handleItemClick("Thông tin tài khoản")}
                        >
                          <Link to={"/doctors/profile"}>
                            <i className="fas fa-user-cog" />
                            <span>Thông tin tài khoản</span>
                          </Link>
                        </li>
                        <li
                          className={`has-submenu megamenu ${location.pathname === "/doctors/change-password" ? "active" : ""
                            }`}
                          onClick={() => handleItemClick("Đổi mật khẩu")}
                        >
                          <Link to={"/doctors/change-password"}>
                            <i className="fas fa-lock" />
                            <span>Đổi mật khẩu</span>
                          </Link>
                        </li>
                        <li
                          className={`has-submenu megamenu ${location.pathname === "/doctor/logout" ? "active" : ""
                            }`}
                          onClick={() => handleLogout("Đăng xuất")}
                        >
                          <Link>
                            <i className="fas fa-sign-out-alt" />
                            <span>Đăng Xuất</span>
                          </Link>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>

              </div>
              {/* <div className="card">
            <div className="card-header">
              <h4 className="card-title">Lịch đặt gần đây</h4>
            </div>
            <ul className="list-group list-group-flush">
              <li className="list-group-item">
                <div className="notify-block align-items-center d-flex">
                  <div className="me-3 flex-shrink-0">
                    <img alt="Image placeholder" src="/img/doctors/doctor-thumb-02.jpg" className="avatar  rounded-circle" />
                  </div>
                  <div className="media-body flex-grow-1">
                    <h5 className="d-block mb-0">Dr. Darren Elder </h5>
                    <span className="d-block text-sm text-muted">Dentist</span>
                    <span className="d-block text-sm text-muted">14 Nov 2023 5.00 PM</span>
                  </div>
                </div>
              </li>
              <li className="list-group-item">
                <div className="notify-block align-items-center d-flex">
                  <div className="me-3 flex-shrink-0">
                    <img alt="Image placeholder" src="/img/doctors/doctor-thumb-02.jpg" className="avatar  rounded-circle" />
                  </div>
                  <div className="media-body flex-grow-1">
                    <h5 className="d-block mb-0">Dr. Darren Elder </h5>
                    <span className="d-block text-sm text-muted">Dentist</span>
                    <span className="d-block text-sm text-muted">12 Nov 2023 11.00 AM</span>
                  </div>
                </div>
              </li>
            </ul>
          </div> */}
            </div>
            <div className="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
              <div className="card">
                <div className="card-body pt-0">
                  <div className="user-tabs">
                    <ul className="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
                      <li className="nav-item">
                        <Link className="nav-link active" to="#pat_appointments" data-bs-toggle="tab">Cuộc hẹn</Link>
                      </li>
                      {/* <li className="nav-item">
                        <Link className="nav-link" to="#pres" data-bs-toggle="tab"><span>Đơn thuốc</span></Link>
                      </li> */}
                      {/* <li className="nav-item">
                    <Link className="nav-link" to="#medical" data-bs-toggle="tab"><span className="med-records">Hóa đơn</span></Link>
                  </li> */}
                      <li className="nav-item">
                        <Link className="nav-link" to="#billing" data-bs-toggle="tab"><span>Hóa đơn</span></Link>
                      </li>
                    </ul>
                  </div>
                  <div className="tab-content">
                    <div id="pat_appointments" className="tab-pane fade show active">
                      <div className="card card-table mb-0">
                        <div className="card-body">
                          <AppoimentList />
                        </div>
                      </div>
                    </div>
                    <Prescription />

                    <PatientBill />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  )
}

export default Patientprofile