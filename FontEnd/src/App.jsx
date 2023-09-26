import './App.css'
import {BrowserRouter as Router, Route, Routes} from "react-router-dom"
import LayoutWebsite from './Component/LayoutWebsite'
import Content from './Component/Content'
import Search from './Component/Serch/Search'
import Booking from './Component/Booking/Booking'
import DoctorProfile from './Component/DoctorProfile/DoctorProfile'
import BookingSuccess from './Component/Booking/BookingSuccess'
import BlogList from './Component/Blog/BlogList'
import BlogDetails from './Component/Blog/BlogDetails'
import ServiceDetails from './Component/Servicer/ServiceDetails'


function App() {

  return (
    <Router>
      <Routes>
        <Route path='/' element={<LayoutWebsite/>}>
          <Route path='' element={<Content/>}/>
          <Route path='doctor' element={<Search/>}/>
          <Route path='booking' element={<Booking/>}/>
          <Route path='booking/success' element={<BookingSuccess/>}/>
          <Route path='doctor/profile' element={<DoctorProfile/>}/>
          <Route path='blog' element={<BlogList/>}/>
          <Route path='blogdetails' element={<BlogDetails/>}/>
          <Route path='servicerdetails' element={<ServiceDetails/>}/>
        </Route>          
      </Routes>
    </Router>
  )
}

export default App
