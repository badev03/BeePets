import './App.css'
import {BrowserRouter as Router, Route, Routes} from "react-router-dom"
import LayoutWebsite from './Component/LayoutWebsite'
import Content from './Component/Content'
import BlogList from './Component/Blog/BlogList'
import BlogDetails from './Component/Blog/BlogDetails'
import ServiceDetails from './Component/Servicer/ServiceDetails'


function App() {

  return (
    <Router>
      <Routes>
        <Route path='/' element={<LayoutWebsite/>}>
          <Route path='' element={<Content/>}/>
          <Route path='blog' element={<BlogList/>}/>
          <Route path='blogdetails' element={<BlogDetails/>}/>
          <Route path='servicerdetails' element={<ServiceDetails/>}/>
        </Route>          
      </Routes>
    </Router>
  )
}

export default App
