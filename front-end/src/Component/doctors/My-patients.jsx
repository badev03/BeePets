import React from 'react'
import Menudashboard from './Menu-dashboard'
import {Link} from 'react-router-dom'
import { useEffect, useState } from 'react'
import listCustomersApi from '../../api/listCustomers'
import LoadingSkeleton from '../Loading';
import BreadcrumbBar from '../BreadcrumbBar'


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
               <BreadcrumbBar title="KHÁCH HÀNG CỦA TÔI" lable="Khách hàng của tôi" />

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
                                        {customers.avatar? (
                                          <img src={customers.avatar} alt="User Image" />                 
                                        ) : (
                                          <div className="profile-img d-flex justify-content-center align-items-center">
                                                    <img src="https://i.pinimg.com/736x/c6/e5/65/c6e56503cfdd87da299f72dc416023d4.jpg" alt="User Image" className="rounded-0"
                                            />
                                                  </div>                                      
                                        )}
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