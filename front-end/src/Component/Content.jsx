import Banner from "./Banner";
import HomepageDoctors from "./Homepage/HomepageDoctors";
import Homepage_Blog from "./Homepage/Homepage_blog";
import Homepage_service from "./Homepage/Homepage_service";


const Content = () => {
  return (
    <div>
      <Banner />
      <Homepage_service />

      <HomepageDoctors />

      <Homepage_Blog />
    </div>

  )
}

export default Content