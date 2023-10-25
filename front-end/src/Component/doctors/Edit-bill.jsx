import React, { useEffect } from "react";
import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import { useState } from "react";
import { Select } from "antd";
import billApi from "../../api/bill";
import { useAuth } from "../../Context/ContextAuth";
import { useParams } from "react-router-dom";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);

const Editbill = () => {
  const { token } = useAuth();
  const [prescriptions, setPrescriptions] = useState([{ id: 1 }]);
  const [services, setServices] = useState([{ id: 1 }]);
  const [products, setProducts] = useState([]);
  const [selectedProductPrice, setSelectedProductPrice] = useState("");
  const [quantities, setQuantities] = useState({});
  const [productPrices, setProductPrices] = useState({});
  const [name, setName] = useState("");
  const [description, setDescription] = useState("");
  const [instructions, setInstructions] = useState({})

  const handleSave = async () => {
    const productsData = prescriptions.map((prescription) => {
      const productName = products[prescription.id - 1]?.name || "";
      const quantity = quantities[prescription.id] || 1;
      const selectedProduct = products.find(
        (product) => product.name === productName
      );
      const product_id = selectedProduct ? selectedProduct.id : null;
      const instruction = instructions[prescription.id] || "";

      return {
        product_id: product_id,
        quantity: quantity,
        price_product: productPrices[prescription.id] || 0,
        instructions: instruction,
      };
    });

    const data = {
      name: name,
      price: prescriptions
        .reduce(
          (total, prescription) =>
            total +
            parseFloat(
              calculateTotal(prescription, productPrices[prescription.id])
            ),
          0
        )
        .toFixed(2),
        bill_id: id,
      products: productsData,
      description: description,
    };

    try {
      const response = await billApi.updateBill(id, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      MySwal.fire({
        title: "Đặt lịch thành công!",
        icon: "success",
      });
    } catch (error) {
      console.error("Lỗi khi gửi hóa đơn:", error);
    }
  };

  const addPrescriptionRow = () => {
    setPrescriptions([...prescriptions, { id: prescriptions.length + 1 }]);
    setQuantities((prev) => ({ ...prev, [prescriptions.length + 1]: 1 }));
    setSelectedProductPrice("");
  };

  const addServiceRow = () => {
    setServices([...services, { id: services.length + 1 }]);
  };
  const deletePrescriptionRow = (id) => {
    const updatedPrescriptions = prescriptions.filter((item) => item.id !== id);
    setPrescriptions(updatedPrescriptions);
  };

  const deleteServiceRow = (id) => {
    const updatedServices = services.filter((item) => item.id !== id);
    setServices(updatedServices);
  };

  useEffect(() => {
    const fetchProduct = async () => {
      try {
        const response = await billApi.getProduct({
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setProducts(response.products);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchProduct();
  }, []);

  const handleQuantityChange = (prescriptionId, value) => {
    const newQuantities = {
      ...quantities,
      [prescriptionId]: parseInt(value, 10),
    };
    setQuantities(newQuantities);
  };

  const calculateTotal = (prescription, productPrice) => {
    const quantity = quantities[prescription.id] || 1;
    const price = productPrice || 0;
    return (quantity * price).toFixed(2);
  };

  const onChange = (value, prescriptionId) => {
    const selectedProduct = products.find((product) => product.name === value);
    const newPrices = {
      ...productPrices,
      [prescriptionId]: selectedProduct ? selectedProduct.price : "",
    };
    setProductPrices(newPrices);

    // Cập nhật hướng dẫn sử dụng cho dòng này
    setInstructions((prev) => ({
      ...prev,
      [prescriptionId]: instructions[prescriptionId] || "",
    }));
  };

  const onSearch = (value) => {
    console.log("search:", value);
  };

  const filterOption = (input, option) =>
    (option?.label ?? "").toLowerCase().includes(input.toLowerCase());

  const { id } = useParams();
  const [bill, setBill] = useState(null);

  const tokenn = localStorage.getItem("token");

  useEffect(() => {
    const fetchBill = async () => {
      try {
        const response = await billApi.getBillDetail(id, {
          headers: {
            Authorization: `Bearer ${tokenn}`,
          },
        });
        setBill(response.bill);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchBill();
  }, []);
  if (!bill) {
    return <div>Loading...</div>;
  }
  return (
    <div>
      <div className="breadcrumb-bar-two">
        <div className="container">
          <div className="row align-items-center inner-banner">
            <div className="col-md-12 col-12 text-center">
              <h2 className="breadcrumb-title">Sửa hóa đơn</h2>
              <nav aria-label="breadcrumb" className="page-breadcrumb">
                <ol className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/">Trang chủ</Link>
                  </li>
                  <li className="breadcrumb-item" aria-current="page">
                    Thêm hóa đơn
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
            <div className="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
              <div className="card widget-profile pat-widget-profile">
                <div className="card-body">
                  <Menudashboard />
                  {/* <div className="pro-widget-content">
                    <div className="profile-info-widget">
                      <Link to="#" className="booking-doc-img">
                        <img src="/img/patients/patient.jpg" alt="User Image" />
                      </Link>
                      <div className="profile-det-info">
                        <h3>Richard Wilson</h3>
                        <div className="patient-details">
                          <h5>
                            <b>Patient ID :</b> PT0016
                          </h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="patient-info">
                    <ul>
                      <li>
                        SĐT <span>+1 952 001 8563</span>
                      </li>
                    </ul>
                  </div> */}
                </div>
              </div>
            </div>
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="card">
                <div className="card-header">
                  <h4 className="card-title mb-0">Sửa hóa đơn</h4>
                </div>
                <div className="card-body">
                  <div className="row">
                    <div className="col-sm-6">
                      <div className="biller-info">
                        <h4 className="d-block">{bill.user_name}</h4>
                        <label htmlFor="">Tên hóa đơn:</label>
                        <input
                          className="form-control"
                          type="text"
                          value={name}
                          onChange={(e) => setName(e.target.value)}
                        />
                      </div>
                    </div>
                    <div className="col-sm-6 text-sm-end">
                      <div className="billing-info">
                        <h4 className="d-block">{bill.date}</h4>
                        <span className="d-block text-muted">{bill.code}</span>
                      </div>
                    </div>
                  </div>
                  <div className="add-more-item text-end">
                    <a
                      onClick={addPrescriptionRow}
                      className="add-prescription"
                    >
                      <i className="fas fa-plus-circle" /> Thêm đơn thuốc
                    </a>
                  </div>

                  <div className="card card-table">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center add-table-prescription">
                          <thead>
                            <tr>
                              <th className="table-name">Tên loại thuốc</th>
                              <th>Số lượng</th>
                              <th className="table-name">Giá tiền</th>
                              <th className="table-name">Tổng tiền</th>
                              <th className="table-name">Hướng dẫn sử dụng</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            {prescriptions.map((prescription) => (
                              <tr key={prescription.id} className="test">
                                <td>
                                  <Select
                                    showSearch
                                    placeholder="Chọn thuốc"
                                    optionFilterProp="children"
                                    style={{ width: 176, height: 43 }}
                                    onChange={(value) =>
                                      onChange(value, prescription.id)
                                    }
                                    onSearch={onSearch}
                                    filterOption={filterOption}
                                    options={products.map((product) => ({
                                      value: product.name,
                                      label: product.name,
                                    }))}
                                  />
                                </td>
                                <td>
                                  <input
                                    className="form-control"
                                    type="number"
                                    value={quantities[prescription.id] || 1}
                                    onChange={(e) =>
                                      handleQuantityChange(
                                        prescription.id,
                                        e.target.value
                                      )
                                    }
                                  />
                                </td>
                                <td>
                                  <input
                                    value={productPrices[prescription.id] || ""}
                                    readOnly
                                    className="form-control"
                                    type="text"
                                  />
                                </td>
                                <td>
                                  <input
                                    className="form-control"
                                    type="text"
                                    value={calculateTotal(
                                      prescription,
                                      productPrices[prescription.id]
                                    )}
                                    readOnly
                                  />
                                </td>
                                <td>
                                  <input
                                    className="form-control"
                                    type="text"
                                    value={instructions[prescription.id] || ""}
                                    onChange={(e) =>
                                      setInstructions((prev) => ({
                                        ...prev,
                                        [prescription.id]: e.target.value,
                                      }))
                                    }
                                  />
                                </td>
                                <td>
                                  <button
                                    onClick={() =>
                                      deletePrescriptionRow(prescription.id)
                                    }
                                    className="btn bg-danger-light trash"
                                  >
                                    <i className="far fa-trash-alt" />
                                  </button>
                                </td>
                              </tr>
                            ))}
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  {/* <div className="add-more-item text-end">
                    <a onClick={addServiceRow} className="add-prescription">
                      <i className="fas fa-plus-circle" /> Thêm dịch vụ
                    </a>
                  </div>
                  <div className="card card-table">
                    <div className="card-body">
                      <div className="table-responsive">
                        <table className="table table-hover table-center add-table-prescription">
                          <thead>
                            <tr>
                              <th className="table-name">Tên dịch vụ</th>
                              <th>Số lượng</th>
                              <th className="table-name">Giá tiền</th>
                              <th className="table-name">Mô tả</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            {services.map((service) => (
                              <tr key={service.id} className="test">
                                <td>
                                  <input className="form-control" type="text" />
                                </td>
                                <td>
                                  <input className="form-control" type="text" />
                                </td>
                                <td>
                                  <input className="form-control" type="text" />
                                </td>
                                <td>
                                  <input className="form-control" type="text" />
                                </td>
                                <td>
                                  <button
                                    onClick={() => deleteServiceRow(service.id)}
                                    className="btn bg-danger-light trash"
                                  >
                                    <i className="far fa-trash-alt" />
                                  </button>
                                </td>
                              </tr>
                            ))}
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> */}
                  <div className="row">
                    <div className="card">
                      <div className="card-body">
                        <h4 className="card-title">Kết quả</h4>
                        <div className="mb-0">
                          {/* <label className="mb-2">Tiểu sử</label> */}
                          <textarea
                            className="form-control"
                            rows={5}
                            value={description}
                            onChange={(e) => setDescription(e.target.value)}
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="row">
                    <div className="col-md-12">
                      <div className="submit-section">
                        <button
                          type="submit"
                          onClick={handleSave}
                          className="btn btn-primary submit-btn"
                        >
                          Lưu
                        </button>
                        <Link to="/doctors/patient-profile">
                          {" "}
                          <button
                            type="reset"
                            className="btn btn-secondary submit-btn"
                          >
                            Quay lại
                          </button>
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Editbill;
