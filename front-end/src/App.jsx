import './App.css'
import { BrowserRouter as Router, Route, Routes } from "react-router-dom"
import LayoutWebsite from './Component/LayoutWebsite'
import Content from './Component/Content'
// import Search from './Component/Serch/Search'
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
import Mypatients from './Component/doctors/My-patients'
import Patientprofile from './Component/doctors/Patient-profile'
import Addprescription from './Component/doctors/Add-prescription'
import Editprescription from './Component/doctors/Edit-prescription'
import Addbill from './Component/doctors/Add-bill'
import Editbill from './Component/doctors/Edit-bill'
import Abouts from './Component/Abouts/Abouts'
import DetailAppointment from './Component/doctors/Detail-appointments'
import Register from './Component/Form-Auth/Register'
import Login from './Component/Form-Auth/Login'
import LoginDoctor from './Component/Form-Auth/Login-Doctor'
import ForgotPasswordDoctor from './Component/Form-Auth/Forgot-Password-Doctor'
import ResetPassword from './Component/Form-Auth/Reset-Password'
import ResetPasswordDoctor from './Component/Form-Auth/Reset-Password-Doctor'
import CreatePassword from './Component/Form-Auth/Create-Password'
import ForgotPassword from './Component/Form-Auth/Forgot-Password'
import AppointmentDetail from './Component/User/AppointmentDetail'
import BillDetail from './Component/User/BillDetail'
import PrescriptionDetails from './Component/User/PrescriptionDetails'
import FilterService from './Component/Serch/FilterService'
import PrivateRouteDoctors from './PrivateRoute/PrivateRouteDoctors'
import AcceptDetailAppointment from './Component/doctors/AcceptDetailAppointment'


function App() {

  return (
    <Router>
      <Routes>
        <Route path='/' element={<LayoutWebsite />}>
          <Route path='' element={<Content />} />
          <Route path='abouts' element={<Abouts />} />
          <Route path='doctor' element={<FilterService />} />
          <Route path='booking' element={<Booking />} />
          <Route path='booking/success' element={<BookingSuccess />} />
          <Route path='doctor/profile' element={<DoctorProfile />} />

          <Route path='doctor/profile/:id' element={<DoctorProfile />} />
          <Route path='blog' element={<BlogList />} />
          <Route path='blog/:slug' element={<BlogDetails />} />
          <Route path="blogs/category/:categoryId" element={<BlogList />} />

          <Route path='service-detail/:slug' element={<ServiceDetails />} />
          <Route path='user/dashbroad' element={<Dashboard />} />
          <Route path='user/changepassword' element={<ChangePassword />} />
          <Route path='user/profilesetting' element={<ProfileSetting />} />
          <Route path='user/appointment' element={<AppointmentDetail />} />
          <Route path='user/prescription' element={<PrescriptionDetails />} />
          <Route path='user/billdetail' element={<BillDetail />} />
          <Route path='informationuser' element={<Information />} />

          <Route path="doctors" element={<PrivateRouteDoctors />}>
            <Route path="" element={<Dashboarddoctors />} />
            <Route path='profile' element={<Profile />} />
            <Route path='review' element={<Review />} />
            <Route path='appointments' element={<Appointments />} />
            <Route path='change-password' element={<Changepassword />} />
            <Route path='patients' element={<Mypatients />} />
            <Route path='patient-profile/:id' element={<Patientprofile />} />
            <Route path='add-prescription' element={<Addprescription />} />
            <Route path='edit-prescription' element={<Editprescription />} />
            <Route path='add-bill' element={<Addbill />} />
            <Route path='edit-bill' element={<Editbill />} />
            <Route path='detail-appointments/:id' element={<DetailAppointment />} /> 
            <Route path='accept-detail-appointments/:id' element={<AcceptDetailAppointment />} /> 
          </Route>


          <Route path='Register' element={<Register />} />
          <Route path='Login' element={<Login />} />
          <Route path='Forgot-Password' element={<ForgotPassword />} />
          <Route path='Reset-Password' element={<ResetPassword />} />
          <Route path='Login-Doctor' element={<LoginDoctor />} />
          <Route path='Forgot-Password-Doctor' element={<ForgotPasswordDoctor />} />
          <Route path='Reset-Password-Doctor' element={<ResetPasswordDoctor />} />
          <Route path='Create-Password' element={<CreatePassword />} />


        </Route>
      </Routes>
    </Router>
  )
}

export default App
