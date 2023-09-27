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
import Dashboard from './Component/User/Dashboard'
import ChangePassword from './Component/User/ChangePassword'
import ProfileSetting from './Component/User/ProfileSetting'
import Information from './Component/User/Information'
import ServiceDetails from './Component/Servicer/ServiceDetails'
import Dashboarddoctors from './Component/doctors/Dashboard'
import Profile from './Component/doctors/Profile'
import Review from './Component/doctors/Review'
import Appointments from './Component/doctors/Appointments'
import Changepassword from './Component/doctors/Change-password'
import Mypatients from './Component/doctors/my-patients'
import Patientprofile from './Component/doctors/Patient-profile'
import Addprescription from './Component/doctors/Add-prescription'
import Editprescription from './Component/doctors/Edit-prescription'
import Addbill from './Component/doctors/Add-bill'
import Editbill from './Component/doctors/Edit-bill'
import Abouts from './Component/Abouts/Abouts'
import Register from './Component/Form-Auth/Register'
import Login from './Component/Form-Auth/Login'
import Login_Doctor from './Component/Form-Auth/Login_Doctor'
import Forgot_Password from './Component/Form-Auth/Forgot_Password'
import Confirm_OTP from './Component/Form-Auth/Confirm_OTP'
import Create_Password from './Component/Form-Auth/Create_Password'



function App() {

  return (
    <Router>
      <Routes>
        <Route path='/' element={<LayoutWebsite/>}>
          <Route path='' element={<Content/>}/>
          <Route path='abouts' element={<Abouts/>}/>
          <Route path='doctor' element={<Search/>}/>
          <Route path='booking' element={<Booking/>}/>
          <Route path='booking/success' element={<BookingSuccess/>}/>
          <Route path='doctor/profile' element={<DoctorProfile/>}/>
          <Route path='blog' element={<BlogList/>}/>
          <Route path='blogdetails' element={<BlogDetails/>}/>
          <Route path='servicerdetails' element={<ServiceDetails/>}/>
          <Route path='user/dashbroad' element={<Dashboard/>}/>
          <Route path='user/changepassword' element={<ChangePassword/>}/>
          <Route path='user/profilesetting' element={<ProfileSetting/>}/>
          <Route path='informationuser' element={<Information/>}/>
          
          <Route path='doctors' element={<Dashboarddoctors/>}/>
          <Route path='doctors/profile' element={<Profile/>}/>
          <Route path='doctors/review' element={<Review/>}/>
          <Route path='doctors/appointments' element={<Appointments/>}/>
          <Route path='doctors/change-password' element={<Changepassword/>}/>
          <Route path='doctors/patients' element={<Mypatients/>}/>
          <Route path='doctors/patient-profile' element={<Patientprofile/>}/>
          <Route path='doctors/add-prescription' element={<Addprescription/>}/>
          <Route path='doctors/edit-prescription' element={<Editprescription/>}/>
          <Route path='doctors/add-bill' element={<Addbill/>}/>
          <Route path='doctors/edit-bill' element={<Editbill/>}/>

          <Route path='register' element={<Register/>}/>
          <Route path='login' element={<Login/>}/>
          <Route path='logindoctor' element={<Login_Doctor/>}/>
          <Route path='forgetpassword' element={<Forgot_Password/>}/>
          <Route path='otp' element={<Confirm_OTP/>}/>
          <Route path='createpass' element={<Create_Password/>}/>

        </Route>          
      </Routes>
    </Router>
  )
}

export default App
