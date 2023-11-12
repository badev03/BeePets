import React from 'react'
import { useEffect, useState } from 'react'
import serviceApi from '../../api/serviceApi';
import Search from './Search';
import LoadingSkeleton from '../Loading';
import { Link } from 'react-router-dom';
const FilterService = () => {
  const [services, setServices] = useState(null);
  const [selectedServices, setSelectedServices] = useState([]);
  const [searchData, setSearchData] = useState([]);

  useEffect(() => {
    const fetchService = async () => {
      try {
        const response = await serviceApi.getAll();
        setServices(response.service);
      } catch (error) {
        console.error('Không có dữ liệu:', error);
      }
    };

    fetchService();
  }, []);

  const handleCheckboxChange = (event) => {
    const { value, checked } = event.target;

    if (checked) {
      setSelectedServices((prevSelectedServices) => [...prevSelectedServices, value]);
    } else {
      setSelectedServices((prevSelectedServices) =>
        prevSelectedServices.filter((serviceId) => serviceId !== value)
      );
    }
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    setSearchData(selectedServices);
  };
  if (!services) {
    return <LoadingSkeleton/>
  }
  return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">BÁC SĨ</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
            <li className="breadcrumb-item"><Link to={`/`}>Trang chủ</Link></li>
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
      <form className="card-body" onSubmit={handleSubmit} >
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