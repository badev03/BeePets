import { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import ReactPaginate from "react-paginate";
import BlogSideBar from "./BlogSideBar";
import blogApi from "../../api/blogApi";

const BlogList = () => {
  const [blogs, setBlogs] = useState([]);
  const { categoryId } = useParams();
  const [currentPage, setCurrentPage] = useState(0);
  const [postsPerPage] = useState(2);
  useEffect(() => {
    const fetchBlog = async () => {
      try {
        const response = await blogApi.getAll({ new_categorie_id: categoryId });
        // console.log(response.new[0]);
        setBlogs(response.new);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchBlog();
  }, [categoryId]);

  function truncateText(text, lines) {
    const words = text.split(" ");
    const truncatedText = words.slice(0, lines * 11).join(" ");
    if (words.length > lines * 10) {
      return `${truncatedText} ...`;
    }
    return truncatedText;
  }

  const indexOfLastPost = (currentPage + 1) * postsPerPage;
  const indexOfFirstPost = currentPage * postsPerPage;
  const currentPosts = blogs.slice(indexOfFirstPost, indexOfLastPost);

  const handlePageClick = ({ selected }) => {
    setCurrentPage(selected);
  };


  return (
    <>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">TIN TỨC</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <a href="index.html">Trang Chủ</a>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Tin Tức
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div className="content">
        <div className="container">
          <div className="row">
            <div className="col-lg-8 col-md-12">
              <div className="row blog-grid-row">
                {blogs.map((blog) => (
                  <div key={blog.id} className="col-md-6 col-sm-12">
                    <div className="blog grid-blog">
                      <div className="blog-image">
                        <Link to={`/blog/${blog.id}`}>
                          <img
                            className="img-fluid"
                            src={blog.image}
                            alt="Post Image"
                          />
                        </Link>
                      </div>
                      <div className="blog-content">
                        <ul className="entry-meta meta-item">
                          <li>
                            <i className="far fa-clock" />
                            {blog.public_date}
                          </li>
                        </ul>
                        <h3 className="blog-title">
                          <Link to={`/blog/${blog.id}`}>{blog.name}</Link>
                        </h3>
                        <div dangerouslySetInnerHTML={{ __html: truncateText(blog.content, 2) }} />
                      </div>
                    </div>
                  </div>
                ))}
              </div>
              <div className="row">
                <div className="col-md-12">
                  <div className="blog-pagination">
                    <ReactPaginate
                      pageCount={Math.ceil(blogs.length / postsPerPage)}
                      pageRangeDisplayed={3}
                      marginPagesDisplayed={1}
                      onPageChange={handlePageClick}
                      containerClassName={"pagination"}
                      activeClassName={"active"}
                    />
                  </div>
                </div>
              </div>
            </div>
            <BlogSideBar />
          </div>
        </div>
      </div>
    </>
  );
};

export default BlogList;

{
  /* <nav>
                      <ul className="pagination justify-content-center">
                        <li className="page-item disabled">
                          <a className="page-link" href="#" tabIndex={-1}>
                            <i className="fas fa-angle-double-left" />
                          </a>
                        </li>
                        <li className="page-item">
                          <a className="page-link" href="#">
                            1
                          </a>
                        </li>
                        <li className="page-item active">
                          <a className="page-link" href="#">
                            2 <span className="visually-hidden">(current)</span>
                          </a>
                        </li>
                        <li className="page-item">
                          <a className="page-link" href="#">
                            3
                          </a>
                        </li>
                        <li className="page-item">
                          <a className="page-link" href="#">
                            <i className="fas fa-angle-double-right" />
                          </a>
                        </li>
                      </ul>
                    </nav> */
}
