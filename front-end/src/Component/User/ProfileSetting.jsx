import React from "react";
import { Link } from "react-router-dom";
import Sidebar from "./Sidebar";
import usersApi from "../../api/usersApi";
import { useEffect, useState } from "react";
import axios from "axios";
import { FaSpinner } from "react-icons/fa";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
import BreadcrumbBar from "../BreadcrumbBar";
const MySwal = withReactContent(Swal);
const ProfileSetting = () => {
  const [previewImage, setPreviewImage] = useState("");
  const [reloadSidebar, setReloadSidebar] = useState(false);
  const [loading, setLoading] = useState(false);
  const [user, setUser] = useState({
    name: "",
    address: "",
    avatar: "",
    // birthday: "",
    phone: "",
    email: "",
    gender: "",
  });

  const token = localStorage.getItem("token");
  // const handleGenderChange = (event) => {
  //   setUser({ ...user, gender: event.target.value });
  // };

  if (token) {
    useEffect(() => {
      const fetchUser = async () => {
        try {
          const response = await usersApi.getUser({
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });
          setUser(response.user);
          // console.log(response.user);
        } catch (error) {
          console.error("Không có dữ liệu:", error);
        }
      };

      fetchUser();
    }, []);
  }

  const [errors, setErrors] = useState({});
  const validateForm = () => {
    let errors = {};
    let isValid = true;

    // Validate name
    if (!user.name) {
      isValid = false;
      errors["name"] = "Vui lòng nhập họ tên.";
    }

    // Validate address
    if (!user.address) {
      isValid = false;
      errors["address"] = "Vui lòng nhập địa chỉ.";
    }

    // Validate phone
    if (!user.phone) {
      isValid = false;
      errors["phone"] = "Vui lòng nhập số điện thoại.";
    } else if (!/^\d{10}$/.test(user.phone)) {
      isValid = false;
      errors["phone"] = "Số điện thoại phải chứa chính xác 10 chữ số.";
    }

    // Validate email
    if (!/\S+@\S+\.\S+/.test(user.email)) {
      isValid = false;
      errors["email"] = "Email không hợp lệ.";
    }

    setErrors(errors);
    return isValid;
  };
  const handleFormSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    // Call the API with user data to update the user information
    if (validateForm()) {
      // Call the API with user data to update the user information
      try {
        const response = await axios.post(
          `https://beepets.id.vn/api/save-infor-user`,
          {
            ...user,
            // formData
          },
          {
            headers: {
              Authorization: `Bearer ${token}`,
              "Content-Type": "multipart/form-data",
            },
          }
        );
        if (response.status === 200) {
          localStorage.removeItem("user");
          localStorage.setItem("user", JSON.stringify(response.data.user));
        }
        setLoading(false);
        MySwal.fire({
          title: "Lưu thông tin tài khoản thành công!",
          icon: "success",
        });
        setReloadSidebar(true);
      } catch (error) {
        if (error.response) {
          if (error.response.data.error) {
            let errorMsg = error.response.data.error;
            // console.log(errorMsg);
            let errorsCopy = { ...errors };
            if (errorMsg.includes("Số điện thoại")) {
              errorsCopy.phone = errorMsg;
            } else if (errorMsg.includes("email")) {
              errorsCopy.email = errorMsg;
              console.log(errorMsg);
            }
            setErrors(errorsCopy);
          }
        }
      }
    }
  };
  useEffect(() => {
    // Kiểm tra nếu đã tải lại Sidebar
    if (reloadSidebar) {
      // Đặt lại trạng thái tạm thời để ngăn chặn việc tải lại liên tục
      setReloadSidebar(false);
    }
  }, [reloadSidebar]);
  const handleFileUpload = (e) => {
    const file = e.target.files[0];
    setUser({ ...user, avatar: file });
    setPreviewImage(URL.createObjectURL(e.target.files[0]));
  };

  return (
    <div>
                   <BreadcrumbBar title="THÔNG TIN CÁ NHÂN" lable="Thông tin cá nhân" />

      <div className="content">
        <div className="container">
          <div className="row">
            <Sidebar key={reloadSidebar ? "reload" : "normal"} />

            <div className="col-md-7 col-lg-8 col-xl-9">
              {/* {Object.keys(errors).map((key, index) => (
        <Alert key={index} message={errors[key]} type="error" showIcon style={{marginBottom: "5px"}} />
      ))} */}
              <div className="card">
                <div className="card-body">
                  <form
                    onSubmit={handleFormSubmit}
                    enctype="multipart/form-data"
                  >
                    <div className="row">
                      <div className="col-12 col-md-12">
                        <div className="mb-3">
                          <div className="change-avatar">
                            <div className="profile-img">
                              <img
                                src={previewImage || user.avatar}
                                alt="User Image"
                              />
                            </div>
                            <div className="upload-img">
                              <div className="change-photo-btn">
                                <span>
                                  <i className="fa fa-upload" />
                                  Tải ảnh lên
                                </span>
                                <input
                                  type="file"
                                  className="upload"
                                  name="avatar"
                                  onChange={(e) => handleFileUpload(e)}
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Họ Tên</label>
                          <input
                            type="text"
                            className="form-control"
                            name="name"
                            value={user.name}
                            onChange={(e) =>
                              setUser({ ...user, name: e.target.value })
                            }
                          />
                          <p style={{ color: "red" }}>{errors["name"]}</p>
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Địa chỉ</label>
                          <input
                            type="text"
                            className="form-control"
                            name="address"
                            value={user.address}
                            onChange={(e) =>
                              setUser({ ...user, address: e.target.value })
                            }
                          />
                          <p style={{ color: "red" }}>{errors["address"]}</p>
                        </div>
                      </div>
                      {/* <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Ngày sinh</label>
                          <div className="cal-icon">
                            <input type="text" className="form-control datetimepicker" name="birthday" value={user.birthday} onChange={(e) => setUser({ ...user, birthday: e.target.value })} />
                          </div>
                        </div>
                      </div> */}
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Số điện thoại</label>
                          <input
                            type="text"
                            className="form-control"
                            name="phone"
                            value={user.phone}
                            onChange={(e) =>
                              setUser({ ...user, phone: e.target.value })
                            }
                          />
                          <p style={{ color: "red" }}>{errors["phone"]}</p>
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Email</label>
                          <input
                            type="text"
                            className="form-control"
                            name="email"
                            value={user.email}
                            onChange={(e) =>
                              setUser({ ...user, email: e.target.value })
                            }
                          />
                          <p style={{ color: "red" }}>{errors["email"]}</p>
                        </div>
                      </div>
                      <div className="col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Giới tính</label>
                          <select
                            className="form-select form-control"
                            value={user.gender}
                            onChange={(e) =>
                              setUser({ ...user, gender: e.target.value })
                            }
                            name="gender"
                          >
                            <option value="Nữ">Nữ</option>
                            <option value="Nam">Nam</option>
                          </select>
                          <p style={{ color: "red" }}>{errors["gender"]}</p>
                        </div>
                      </div>
                    </div>
                    <div className="submit-section">
                      <button
                        type="submit"
                        className="btn btn-primary submit-btn"
                        onClick={handleFormSubmit}
                      >
                        {loading ? (
                          <div className="loading-spinner">
                            <FaSpinner className="spinner" />
                          </div>
                        ) : (
                          "Lưu"
                        )}
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
  );
};

export default ProfileSetting;
