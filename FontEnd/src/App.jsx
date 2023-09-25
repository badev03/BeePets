import './App.css'
import {BrowserRouter as Router, Route, Routes} from "react-router-dom"
import LayoutWebsite from './Component/LayoutWebsite'
import Banner from './Component/Banner'
import Content from './Component/Content'


function App() {

  return (
    <Router>
      <Routes>
        <Route path='/' element={<LayoutWebsite/>}>
          <Route path='' element={<Content/>}/>
        </Route>          
      </Routes>
    </Router>
  )
}

export default App
