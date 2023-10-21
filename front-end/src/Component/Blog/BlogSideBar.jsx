import { useEffect, useState } from "react";
import blogCategoryApi from "../../api/categoryBlogApi";
import BlogTopList from "./BlogTopList";
import { Link } from "react-router-dom";

const BlogSideBar = ({ onSearchChange, onSearchSubmit, searchTerm }) => {
  const [categoryBlogs, setCategoryBlogs] = useState([]);

  useEffect(() => {
    const fetchCategoryBlog = async () => {
      try {
        const response = await blogCategoryApi.getAll();
        setCategoryBlogs(response.categoriesNew);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchCategoryBlog();
  }, []);

  return (
    <div className="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">
      <BlogTopList
        searchTerm={searchTerm}
        onSearchChange={onSearchChange}
        onSearchSubmit={onSearchSubmit}
      />
      <div className="card category-widget">
        <div className="card-header">
          <h4 className="card-title">Danh mục</h4>
        </div>
        <div className="card-body">
          <ul className="categories">
            {categoryBlogs.map((category) => (
              <li key={category.id}>
                <Link to={`/blog/category/${category.id}`}>
                  {category.name}{" "}
                  <span>{category.new.length}</span>
                </Link>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </div>
  );
};

export default BlogSideBar;
