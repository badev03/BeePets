import React from 'react'
import { useEffect, useState } from 'react'
import serviceApi from '../../api/serviceApi';
import Search from './Search';
const FilterService = () => {
  const [services, setServices] = useState([]);
  const [selectedServices, setSelectedServices] = useState([]);
  useEffect(() => {
    const fetchService = async () => {
      try {
        const response = await serviceApi.getAll();
        setServices(response.service);
        console.log(response);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchService();
  }, []); 
  const handleCheckboxChange = (event) => {
    const { value, checked } = event.target;

    if (checked) {
      // Nếu checkbox được chọn, thêm vào mảng selectedServices
      setSelectedServices((prevSelectedServices) => [
        ...prevSelectedServices,
        value,
      ]);
    } else {
      // Nếu checkbox bị bỏ chọn, loại bỏ khỏi mảng selectedServices
      setSelectedServices((prevSelectedServices) =>
        prevSelectedServices.filter((serviceId) => serviceId !== value)
      );
    }
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    // Mảng selectedServices chứa các dịch vụ đã chọn
    console.log(selectedServices);
  
  };

  return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">BÁC SĨ</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
              <li className="breadcrumb-item" aria-current="page"> Bác Sĩ</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div className="content">
    <div className="container">
      <div className="row">
        <div className="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
    <div className="card search-filter">
      <div className="card-header">
        <h4 className="card-title mb-0">Bộ lọc tìm kiếm</h4>
      </div>
      <form className="card-body" onSubmit={handleSubmit} method="post">
        <div className="filter-widget">
          <h4>Dịch vụ</h4>
          {services.map((service) => (
            <div key={service.id}>
              <label className="custom_check">
                <input
                  type="checkbox"
                  name="select_specialist"
                  value={service.id}
                  onChange={handleCheckboxChange}
                  checked={selectedServices.includes(String(service.id))}
                />
                <span className="checkmark" /> {service.name}
              </label>
            </div>
          ))}
        </div>
        <div className="btn-search">
          <button type="submit" className="btn w-100">
            Tìm kiếm
          </button>
        </div>
      </form>
    </div>
    </div>
    <div className="col-md-12 col-lg-8 col-xl-9">
    <Search data={selectedServices}/>
    </div>
    </div>
  </div>
</div>

    
    </div>
  );
};

export default FilterService