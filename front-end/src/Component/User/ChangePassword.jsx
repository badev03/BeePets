import React from "react";
import Sidebar from "./Sidebar";
import { useState } from "react";
import axios from "axios";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);
import { useAuth } from "../../Context/ContextAuth";
import { FaEye, FaEyeSlash } from "react-icons/fa";
import { Link } from "react-router-dom";

const ChangePasswordUser = () => {
  const { token } = useAuth();
  const [oldPassword, setOldPassword] = useState("");
  const [newPassword, setNewPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const [showPassword, setShowPassword] = useState(false);
  const [showPasswordNew, setShowPasswordNew] = useState(false);
  const [showPasswordConfirm, setShowPasswordConfirm] = useState(false);
  const [oldPasswordError, setOldPasswordError] = useState("");
  const [newPasswordError, setNewPasswordError] = useState("");
  const [confirmPasswordError, setConfirmPasswordError] = useState("");
  const userString = localStorage.getItem("user");
  const user = JSON.parse(userString);
  // console.log(user.phone);
  const handleSubmit = async (e) => {
    e.preventDefault();

    setOldPasswordError("");
    setNewPasswordError("");
    setConfirmPasswordError("");

    if (oldPassword === "") {
      setOldPasswordError("Vui lòng nhập mật khẩu cũ.");
    }
    if (newPassword === "") {
      setNewPasswordError("Vui lòng nhập mật khẩu mới.");
    }
    if (confirmPassword === "") {
      setConfirmPasswordError("Vui lòng nhập lại mật khẩu mới.");
    }

    if (oldPasswordError || newPasswordError || confirmPasswordError) {
      return;
    }

    try {
      const response = await axios.post(
        `https://beepets.id.vn/api/change-password/${user.phone}`,
        {
          old_password: oldPassword,
          new_password: newPassword,
          password_confirmation: confirmPassword,
        },
        {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        }
      );

      MySwal.fire({
        title: "Đổi mật khẩu thành công!",
        icon: "success",
      });
    } catch (error) {
      console.error("Đổi mật khẩu thất bại:", error);
    }
  };

  return (
    <div>
      <div className="breadcrumb-bar-two"> <div className="container">
        <div className="row align-items-center inner-banner">
          <div className="col-md-12 col-12 text-center">
            <h2 className="breadcrumb-title">Thay đổi mật khẩu</h2>
            <nav aria-label="breadcrumb" className="page-breadcrumb">
              <ol className="breadcrumb">
                <li className="breadcrumb-item"><Link to={`/`} >Trang chủ</Link></li>
                <li className="breadcrumb-item" aria-current="page">Thay đổi mật khẩu</li>
              </ol>
            </nav>
          </div>
        </div>
      </div></div>
      <div className="content">
        <div className="container">
          <div className="row">
            <Sidebar />
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="card">
                <div className="card-body">
                  <div className="row">
                    <div className="col-md-12 col-lg-6">
                      <form onSubmit={handleSubmit}>
                        <div className="mb-3">
                          <label className="mb-2">Mật khẩu cũ</label>
                          <div className="input-group">
                            <input
                              type={showPassword ? "text" : "password"}
                              className="form-control"
                              value={oldPassword}
                              onChange={(e) => setOldPassword(e.target.value)}
                              name="oldPassword"
                            />
                            <div
                              className="input-group-append"
                              style={{ display: "flex" }}
                            >
                              <span
                                onClick={() => setShowPassword(!showPassword)}
                                className="input-group-text cursor-pointer"
                              >
                                {showPassword ? <FaEye /> : <FaEyeSlash />}
                              </span>
                            </div>
                          </div>
                          <div className="text-danger">{oldPasswordError}</div>
                        </div>
                        <div className="mb-3">
                          <label className="mb-2">Mật khẩu mới</label>
                          <div className="input-group">
                            <input
                              type={showPasswordNew ? "text" : "password"}
                              className="form-control"
                              value={newPassword}
                              onChange={(e) => setNewPassword(e.target.value)}
                              name="newPassword"
                            />
                            <div
                              className="input-group-append"
                              style={{ display: "flex" }}
                            >
                              <span
                                onClick={() =>
                                  setShowPasswordNew(!showPasswordNew)
                                }
                                className="input-group-text cursor-pointer"
                              >
                                {showPasswordNew ? <FaEye /> : <FaEyeSlash />}
                              </span>
                            </div>
                          </div>
                          <div className="text-danger">{newPasswordError}</div>
                        </div>
                        <div className="mb-3">
                          <label className="mb-2">Nhập lại mật khẩu mới</label>
                          <div className="input-group">
                            <input
                              type={showPasswordConfirm ? "text" : "password"}
                              className="form-control"
                              value={confirmPassword}
                              onChange={(e) =>
                                setConfirmPassword(e.target.value)
                              }
                              name="confirmPassword"
                            />
                            <div
                              className="input-group-append"
                              style={{ display: "flex" }}
                            >
                              <span
                                onClick={() =>
                                  setShowPasswordConfirm(!showPasswordConfirm)
                                }
                                className="input-group-text cursor-pointer"
                              >
                                {showPasswordConfirm ? (
                                  <FaEye />
                                ) : (
                                  <FaEyeSlash />
                                )}
                              </span>
                            </div>
                          </div>
                          <div className="text-danger">
                            {confirmPasswordError}
                          </div>
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

export default ChangePasswordUser;
