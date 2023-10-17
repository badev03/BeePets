import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import { useEffect, useState } from "react";
import doctorsApi from "../../api/doctorsApi";
import ChangePassword from "../../api/changePassword";
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';
const MySwal = withReactContent(Swal);
import { useAuth } from "../../Context/ContextAuth";

const Changepassword = () => {
  const { token } = useAuth();

  const [oldPassword, setOldPassword] = useState("");
  const [newPassword, setNewPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (newPassword !== confirmPassword) {
      console.error("Mật khẩu mới không khớp");
      return;
    }

    try {
      await ChangePassword.changePasswordDoctor({
        old_password: oldPassword,
        new_password: newPassword,
        confirm_password: confirmPassword,
      },{
        headers: {
          Authorization: `Bearer ${token}`
        },
      });

      MySwal.fire({
        title: 'Đổi mật khẩu thành công!',
        icon: 'success',
      });

      console.log("Đổi mật khẩu thành công");
    } catch (error) {
      console.error("Đổi mật khẩu thất bại:", error);

      if (error.response && error.response.status === 401) {
        MySwal.fire({
          title: 'Chưa đăng nhập',
          text: 'Vui lòng đăng nhập trước khi đổi mật khẩu.',
          icon: 'error',
        });
      } else {
        MySwal.fire({
          title: 'Đổi mật khẩu không thành công',
          text: 'Vui lòng thử lại sau.',
          icon: 'error',
        });
      }
    }
  };

  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Change Password</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/">Home</Link>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Change Password
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
            <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
              <Menudashboard />
            </div>
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="card">
                <div className="card-body">
                  <div className="row">
                    <div className="col-md-12 col-lg-6">
                      <form onSubmit={handleSubmit}>
                        <div className="mb-3">
                          <label className="mb-2">Mật khẩu cũ</label>
                          <input
                            type="text"
                            className="form-control"
                            value={oldPassword}
                            onChange={(e) => setOldPassword(e.target.value)}
                            name="oldPassword"
                          />
                        </div>
                        <div className="mb-3">
                          <label className="mb-2">Mật khẩu mới</label>
                          <input
                            type="text"
                            className="form-control"
                            value={newPassword}
                            onChange={(e) => setNewPassword(e.target.value)}
                            name="newPassword" 
                          />
                        </div>
                        <div className="mb-3">
                          <label className="mb-2">Nhập lại mật khẩu mới</label>
                          <input
                            type="text"
                            className="form-control"
                            value={confirmPassword}
                            onChange={(e) => setConfirmPassword(e.target.value)}
                            name="confirmPassword"
                          />
                        </div>
                        <div className="submit-section">
                          <button
                            type="submit"
                            className="btn btn-primary submit-btn"
                          >
                            Lưu mật khẩu
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Changepassword;
