import { useEffect, useState } from "react";
import blogApi from "../../api/BlogApi";
import { Link } from "react-router-dom";

const BlogTopList = ({ onSearchSubmit }) => {
  const [originalBlogs, setOriginalBlogs] = useState([]); // Thêm state mới
  const [blogs, setBlogs] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");

  const handleSearchChange = (event) => {
    setSearchTerm(event.target.value);
  };

  const handleSearchSubmit = async (event) => {
    event.preventDefault();
    try {
      const searchString = String(searchTerm);
      const response = await blogApi.search(searchString);
      setBlogs(response.new.data);
      onSearchSubmit(response.new); 
    } catch (error) {
      console.error("Không có dữ liệu:", error);
    }
  };

  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await blogApi.getAll();
        const newTop = response.new.data;
        const randomItems = displayRandomItems(newTop, 5);
        setBlogs(randomItems);
        setOriginalBlogs([...randomItems]); // Cập nhật danh sách bài viết nổi bật gốc
        randomItems.forEach((item) => {
          // console.log(item);
        });
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchBlog();
  }, []);

  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
  }

  // Function to display only the first n items of an array
  function displayRandomItems(array, n) {
    const shuffledArray = shuffleArray(array);
    const slicedArray = shuffledArray.slice(0, n);
    return slicedArray;
  }

  return (
    <>
      <div className="card post-widget">
        <div className="card search-widget">
          <div className="card-body">
            <form className="search-form" onSubmit={handleSearchSubmit}>
              <div className="input-group">
                <input
                  type="text"
                  placeholder="Search..."
                  className="form-control"
                  value={searchTerm}
                  onChange={handleSearchChange}
                />
                <button type="submit" className="btn btn-primary">
                  <i className="fa fa-search" />
                </button>
              </div>
            </form>
          </div>
        </div>
        <div className="card-header">
          <h4 className="card-title">Bài viết nổi bật</h4>
        </div>
        <div className="card-body">
          <ul className="latest-posts">
            {originalBlogs.map((blog) => (
              <li key={blog.id}>
                <div className="post-thumb">
                  <Link to={`/blog/${blog.slug}`}>
                    <img
                      className="img-fluid"
                      src={blog.image}
                      alt="blog-image"
                    />
                  </Link>
                </div>
                <div className="post-info">
                  <h4>
                    <Link to={`/blog/${blog.slug}`}>{blog.name}</Link>
                  </h4>
                  <p>{blog.public_date}</p>
                </div>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </>
  );
};

export default BlogTopList;

