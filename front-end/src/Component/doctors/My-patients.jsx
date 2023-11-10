import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import { useEffect, useState } from 'react'
import listCustomersApi from '../../api/listCustomers'
import LoadingSkeleton from '../Loading';


const Mypatients = () => {
  const [customers, setCustomers] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [loading, setLoading] = useState(true);

  const token = localStorage.getItem('token');
  if(token){
    useEffect(() => {
     const fetchDoctor = async () => {
       try {
        const response = await listCustomersApi.getlistCustomers(
         {
           headers: {
             Authorization: `Bearer ${token}`,
           },
         }
       );
       setCustomers(response.customers);
       console.log(response);
          setLoading(false);
              
       } catch (error) {
         console.error("Không có dữ liệu:", error);
       }
     };
 
     fetchDoctor();
   }, []); 
  }
    const handleSearch = (event) => {
      setSearchTerm(event.target.value);
    };
  
    const filteredCustomers = customers.filter((customer) =>
      customer.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
  return (
    <div>
  <div className="breadcrumb-bar-two">
    <div className="container">
      <div className="row align-items-center inner-banner">
        <div className="col-md-12 col-12 text-center">
          <h2 className="breadcrumb-title">Khách hàng của tôi</h2>
          <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><Link to="/">Trang chủ</Link></li>
              <li className="breadcrumb-item" aria-current="page">Khách hàng của tôi</li>
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
          <Menudashboard/>
        </div>
        <div className="col-md-7 col-lg-8 col-xl-9">
        <div className="search-container">
                    <div className="input-group">
                      <input
                        type="text"
                        id="searchName"
                        placeholder="Lọc theo tên"
                        onChange={handleSearch}
                        className="input-group-item"
                      />
                    </div>

                  </div>
        
          <div className="row row-grid">
          {loading ? (
                             
                             <LoadingSkeleton />
   
                             ) : (
                              filteredCustomers.map(customers => (
                                <div key={customers.id} className="col-md-6 col-lg-4 col-xl-3">
                                  <div className="card widget-profile pat-widget-profile">
                                  <div className="card-body">
                                    <div className="pro-widget-content">
                                      <div className="profile-info-widget">
                                        <Link to={`/doctors/patient-profile/${customers.id}`} className="booking-doc-img">
                                          <img src={customers.avatar} alt="User Image" />
                                        </Link>
                                        <div className="profile-det-info">
                                          <h3><Link to={`/doctors/patient-profile/${customers.id}`}>{customers.name}</Link></h3>
                                          <div className="patient-details">
                                            <h5><b>Mã bệnh nhân :</b> {customers.id}</h5>
                          
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div className="patient-info">
                                      <ul>
                                        <li>SĐT <span>{customers.phone}</span></li>
                                        
                                      
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                  
                                </div>
                                ))
                             )}
        
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  )
}

export default Mypatients