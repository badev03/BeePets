import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import blogApi from "../../api/BlogApi";
import BlogSideBar from "./BlogSideBar";
import LoadingSkeleton from "../Loading";
import TopLink from "../../Link/TopLink";


const BlogDetails = () => {
  const { slug } = useParams();
  const [blog, setBlog] = useState(null);

  useEffect(() => {
    const fetchBlogDetails = async () => {
      try {
        const response = await blogApi.get(slug);
        setBlog(response.newDetail);
      } catch (error) {
        console.error("Error fetching blog details:", error);
      }
    };

    fetchBlogDetails();
  }, [slug]);

  if (!blog) {
    return <LoadingSkeleton/>;
  }

  return (
    <>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">CHI TIẾT TIN TỨC</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <TopLink to="/">Trang Chủ</TopLink>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Chi tiết tin tức
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
              <div className="blog-view">
                <div className="blog blog-single-post">
                  <h3 className="blog-title">{blog.name}</h3>
                  <div className="blog-image">
                    <a href="javascript:void(0);">
                      <img
                        alt="blog-image"
                        src={blog.image}
                        className="img-fluid"
                      />
                    </a>
                  </div>
                  <div className="blog-info clearfix">
                    <div className="post-left">
                      <ul>
                        <li>
                          <i className="far fa-clock" />
                          {blog.public_date}{" "}
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div className="blog-content">
                    <div dangerouslySetInnerHTML={{ __html: blog.content }} />
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

export default BlogDetails;
