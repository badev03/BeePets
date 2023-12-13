import React from "react";
import { Link } from "react-router-dom";

const BreadcrumbBar = ({ title , lable}) => {
  return (
    <div className="breadcrumb-bar-two">
      <div className="container">
        <div className="row align-items-center inner-banner">
          <div className="col-md-12 col-12 text-center">
            <h2 className="breadcrumb-title">{title}</h2>
            <nav aria-label="breadcrumb" className="page-breadcrumb">
            <ol className="breadcrumb">
                <li className="breadcrumb-item"><Link to={`/`} >Trang chủ</Link></li>
                <li className="breadcrumb-item" aria-current="page">{lable}</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  );
};

export default BreadcrumbBar