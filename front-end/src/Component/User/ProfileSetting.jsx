import React from 'react'
import { Link } from 'react-router-dom'
import Sidebar from './Sidebar'
import usersApi from '../../api/usersApi';
import { useEffect, useState } from "react";
import axios from 'axios';
import { Alert } from 'antd';
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);
const ProfileSetting = () => {
 
  
  const [user, setUser] = useState(
    {
      name: "",
      address: "",
      avatar:"",
      // birthday: "",
      phone: "",
      email: "",
      gender: "",
    }
  );

  const token = localStorage.getItem('token');
  // const handleGenderChange = (event) => {
  //   setUser({ ...user, gender: event.target.value });
  // };

  if (token) {
    useEffect(() => {
      const fetchUser = async () => {
        try {
          const response = await usersApi.getUser(
            {
              headers: {
                Authorization: `Bearer ${token}`,
              },
            }
          );
          setUser(response.user);
          console.log(response.user);
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
    if (!user.email) {
      isValid = false;
      errors["email"] = "Vui lòng nhập email.";
    } else if (!/\S+@\S+\.\S+/.test(user.email)) {
      isValid = false;
      errors["email"] = "Email không hợp lệ.";
    }
  
    setErrors(errors);
    return isValid;
  };
  const handleFormSubmit = async (e) => {
    e.preventDefault();
    // Call the API with user data to update the user information
    if (validateForm()) {
      // Call the API with user data to update the user information
      try {
       
        const response = await axios.post(
          `http://127.0.0.1:8000/api/save-infor-user`,
          {
            ...user,
          },
          {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          }
        );
        console.log(response.data);
      
        // setSuccess(true);
        // setTimeout(() => {
        //   setSuccess(false);
        // }, 3000);
        MySwal.fire({
          title: "Lưu thông tin tài khoản thành công!",
          icon: "success",
        });
      } catch (error) {
        console.log(error);
        
      }
    }
  };
  const handleFileUpload = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        // Perform the upload to Cloudinary
        // console.log(reader.result)
        uploadToCloudinary(reader.result);
      };
      reader.readAsDataURL(file);
    }
  };
  
  const uploadToCloudinary = (fileContent) => {
    // Perform the upload to Cloudinary here
    // Update the user state with the Cloudinary image URL
    console.log(fileContent)
    setUser({ ...user, avatar: fileContent });
    
  };
  return (
    <div><div className="breadcrumb-bar-two">
      <div className="container">
        <div className="row align-items-center inner-banner">
          <div className="col-md-12 col-12 text-center">
            <h2 className="breadcrumb-title">Thông tin cá nhân</h2>
            <nav aria-label="breadcrumb" className="page-breadcrumb">
              <ol className="breadcrumb">
                <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                <li className="breadcrumb-item" aria-current="page">Thông tin cá nhân</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
      <div className="content">
        <div className="container">
          <div className="row">
            <Sidebar />
            <div className="col-md-7 col-lg-8 col-xl-9">
       
        {/* {Object.keys(errors).map((key, index) => (
        <Alert key={index} message={errors[key]} type="error" showIcon style={{marginBottom: "5px"}} />
      ))} */}
              <div className="card" >
                <div className="card-body">
                  <form onSubmit={handleFormSubmit} >
                    <div className="row">
                      <div className="col-12 col-md-12">
                        <div className="mb-3">
                          <div className="change-avatar">
                            <div className="profile-img">
                              <img src={user.avatar} alt="User Image" />
                            </div>
                            <div className="upload-img">
                              <div className="change-photo-btn">
                                <span><i className="fa fa-upload" />Tải ảnh lên</span>
                                <input type="file" className="upload"  name="avatar"   onChange={(e) => handleFileUpload(e)}/>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Họ Tên</label>
                          <input type="text" className="form-control" name="name" value={user.name}   onChange={(e) => setUser({ ...user, name: e.target.value })}/>
                          <p style={{color:"red"}}>{errors["name"]}</p>
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Địa chỉ</label>
                          <input type="text" className="form-control" name="address" value={user.address}   onChange={(e) => setUser({ ...user, address: e.target.value })} />
                          <p style={{color:"red"}}>{errors["address"]}</p>
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
                          <input type="text" className="form-control" name="phone" value={user.phone} onChange={(e) => setUser({ ...user, phone: e.target.value })} />
                          <p style={{color:"red"}}>{errors["phone"]}</p>

                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="mb-3">
                          <label className="mb-2">Email</label>
                          <input type="text" className="form-control" name="email" value={user.email} onChange={(e) => setUser({ ...user, email: e.target.value })} />
                          <p style={{color:"red"}}>{errors["email"]}</p>
                        
                        </div>
                      </div>
                      <div className="col-md-6">
                  <div className="mb-3">
                    <label className="mb-2">Giới tính</label>
                    <select
                      className="form-select form-control"
                      value={user.gender}
                      onChange={(e) => setUser({ ...user, gender: e.target.value })}
                      name="gender"
                    >
                        <option value="Nữ">Nữ</option>                   
                        <option value="Nam">Nam</option>                 
                    </select>
                    <p style={{color:"red"}}>{errors["gender"]}</p>

                  </div>
                  </div> 
                  </div>
                    <div className="submit-section">
                      <button type="submit" className="btn btn-primary submit-btn">Lưu</button>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div></div>

  )
}

export default ProfileSetting