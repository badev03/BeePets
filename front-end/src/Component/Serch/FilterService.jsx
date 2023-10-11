import React from 'react'
import { useEffect, useState } from 'react'
import serviceApi from '../../api/serviceApi';
const FilterService = () => {
  const [services, setServices] = useState([]);

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
  return (
    <div className="card search-filter">
    <div className="card-header">
      <h4 className="card-title mb-0">Bộ lọc tìm kiếm</h4>
    </div>
    <div className="card-body">
    

      <div className="filter-widget">
        <h4>Dịch vụ</h4>
        {services.map(service=>(
          <div>
          <label className="custom_check">
            <input type="checkbox" name="select_specialist"  />
            <span className="checkmark" /> {service.name}
          </label>
        </div>
        ))}
        

      </div>
      <div className="btn-search">
        <button type="button" className="btn w-100">Tìm kiếm</button>
      </div>
    </div>
  </div>
  )
}

export default FilterService