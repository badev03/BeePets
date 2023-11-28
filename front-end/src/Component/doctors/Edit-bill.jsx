import { useEffect } from "react";
import Menudashboard from "./Menu-dashboard";
import { Link } from "react-router-dom";
import { useState } from "react";
import { Select } from "antd";
import billApi from "../../api/bill";
import BookingApi from "../../api/bookingApi";
import { useAuth } from "../../Context/ContextAuth";
import { FaSpinner } from "react-icons/fa";
import LoadingSkeleton from "../Loading";
import { useParams } from "react-router-dom";
import Swal from "sweetalert2";
import withReactContent from "sweetalert2-react-content";
const MySwal = withReactContent(Swal);

const Editbill = () => {
  const { token } = useAuth();
  const [loading, setLoading] = useState(true);
  const [isloading, setIsloading] = useState(false);
  const { id } = useParams();
  const [bills, setBills] = useState(null);
  const [services, setServices] = useState([]);
  const tokenn = localStorage.getItem("token");
  const [userId, setUserId] = useState("");
  const [doctorId, setDoctorId] = useState("");
  const [description, setDescription] = useState("");
  const [editedName, setEditedName] = useState("");
  const [products, setProducts] = useState([]);
  const [serviceBill, setServiceBill] = useState([]);

  const [selectedProducts, setSelectedProducts] = useState([]);
  const [selectedServices, setSelectedServices] = useState([]);
  const [selectedProductDefault, setSelectedProductDefault] = useState([]);
  const [billDefault, setBillDefault] = useState(null);
  const [selectedTotalPrice, setSelectedTotalPrice] = useState([]);
  const [nameError, setNameError] = useState("");
  const [descriptionError, setDescriptionError] = useState("");

  useEffect(() => {
    const fetchBill = async () => {
      setLoading(true);
      try {
        const response = await billApi.getBillDetail(id, {
          headers: {
            Authorization: `Bearer ${tokenn}`,
          },
        });
        console.log(response);
        if (response.bill.prescriptions.length === 0) {
          console.log("ko có dữ liệu");
          setBillDefault(response.bill);
        } else {
          setBills(response.bill);
          setServices(response.services);
          setUserId(response.bill.user_id);
          setDoctorId(response.bill.doctor_id);
          const productdefault = response.bill.prescriptions
            .map((prescription) => {
              return prescription.productss.map((product) => {
                return {
                  label: product.name,
                  value: product.id,
                  price: product.price,
                  quantity: product.pivot.quantity,
                  instructions: product.pivot.instructions,
                };
              });
            })
            .flat();
          console.log(productdefault);
          setSelectedProductDefault(productdefault);
          setSelectedProducts(productdefault);
          setEditedName(response.bill.prescriptions[0].name);
          setDescription(response.bill.description);
        }
        const servicedefault = response.services.map((service) => {
          return {
            label: service.name,
            value: service.id,
            price: service.price,
          };
        });
        setSelectedServices(servicedefault);
        console.log(servicedefault);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      } finally {
        setLoading(false);
      }
    };

    if (id) {
      fetchBill();
    }
  }, [id, tokenn, token]);

  useEffect(() => {
    const fetchProduct = async () => {
      try {
        const response = await billApi.getProduct({
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setProducts(response.products);
        console.log(1111);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchProduct();
  }, []);

  const handleSelectChange = (selectedValues) => {
    const selectedProductsInfo = selectedValues.map((value) => {
      const selectedProduct = products.find((product) => product.id === value);

      const existingProduct = selectedProductDefault.find(
        (product) => product.value === selectedProduct.id
      );

      const defaultQuantity = existingProduct ? existingProduct.quantity : 1;

      const defaultInstruction = existingProduct
        ? existingProduct.instructions
        : "";

      return {
        label: selectedProduct.name,
        value: selectedProduct.id,
        price: selectedProduct.price,
        quantity: defaultQuantity,
        instructions: defaultInstruction,
      };
    });
    console.log(selectedProductsInfo);
    setSelectedProductDefault(selectedProductsInfo);

    setSelectedProducts([...selectedProductsInfo]);

    setSelectedTotalPrice([...selectedProductsInfo]);
  };

  const handleServiceSelectChange = (selectedValues) => {
    console.log(selectedValues);
    const selectedServicesInfo = selectedValues.map((value) => {
      const selectedService = serviceBill.find(
        (service) => service.id === value
      );
      return {
        label: selectedService.name,
        value: selectedService.id,
        price: selectedService.price,
      };
    });

    const servicedefault = services.map((service) => {
      return {
        label: service.name,
        value: service.id,
        price: service.price,
      };
    });

    setSelectedServices(selectedServicesInfo);
  };

  const handleInstructionChange = (e, productIndex) => {
    console.log(billDefault);
    if (bills != null) {
      if (bills.prescriptions.productss) {
        const updatedPrescriptions = [...bills.prescriptions];
        updatedPrescriptions[0].productss[productIndex].pivot.instructions =
          e.target.value;
        setBills((prevBills) => ({
          ...prevBills,
          prescriptions: updatedPrescriptions,
        }));
      }
    }
    const newSelectedProducts = selectedProducts.map((product, index) => {
      if (index === productIndex) {
        return {
          ...product,
          instructions: e.target.value,
        };
      }
      return product;
    });

    console.log(newSelectedProducts);
    setSelectedProducts([...newSelectedProducts]);
  };

  const handleQuantityChange = (e, productIndex) => {
    const newQuantity = +e.target.value;

    if (newQuantity >= 1) {
      const updatedSelectedProducts = selectedProducts.map((product, index) => {
        if (index === productIndex) {
          return {
            ...product,
            quantity: newQuantity,
          };
        }
        return product;
      });

      setSelectedProducts([...updatedSelectedProducts]);
      setSelectedProductDefault(updatedSelectedProducts);
      setSelectedTotalPrice([...updatedSelectedProducts]);
    }
  };

  const handleSave = async () => {
    const trimmedName = editedName.trim();
    if (!trimmedName) {
      setNameError("Vui lòng nhập tên đơn thuốc");
      return;
    } else {
      setNameError("");
    }

    const trimmedDescription = description.trim();
    if (!trimmedDescription) {
      setDescriptionError("Vui lòng nhập kết quả");
      return;
    } else {
      setDescriptionError("");
    }

    console.log(selectedProducts);
    const products = selectedProducts.map((selectedProduct) => ({
      product_id: selectedProduct.value,
      quantity: selectedProduct.quantity || 1,
      price_product: selectedProduct.price,
      instructions: selectedProduct.instructions || "default",
    }));

    const totalPrice = bills?.prescriptions?.reduce((acc, prescription) => {
      const productsTotal = prescription.productss.reduce(
        (productAcc, product) => {
          const quantity = product.pivot.quantity;
          const price = product.price;
          return productAcc + quantity * price;
        },
        0
      );
      return acc + productsTotal;
    }, 0);
    let totalPriceDefault = 0;
    if (isNaN(totalPrice) || totalPrice === undefined || totalPrice === null) {
      totalPriceDefault = selectedTotalPrice.reduce((acc, product) => {
        const quantity = product.quantity || 0;
        const price = product.price || 0;
        return acc + quantity * price;
      }, 0);
    }
    const services = selectedServices.map((selectedService) => ({
      service_id: selectedService.value,
    }));
    const data = {
      name: editedName,
      price: totalPrice || totalPriceDefault,
      bill_id: id,
      user_id: userId,
      doctor_id: doctorId,
      products: products,
      services: services,
      description: description,
    };
    console.log(data);

    try {
      await billApi.updateBill(id, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      MySwal.fire({
        icon: "success",
        title: "Cập nhật thành công!",
      });
    } catch (error) {
      console.error("Lỗi cập nhật hóa đơn:", error);
      MySwal.fire({
        icon: "error",
        title: "Lỗi cập nhật hóa đơn",
        text: error.errors,
      });
      console.log(error);
    } finally {
      setIsloading(false);
    }
  };

  useEffect(() => {
    const fetchService = async () => {
      setLoading(true);
      try {
        const response = await BookingApi.getServiceDoctor();
        setServiceBill(response.data);
      } catch (error) {
        console.error("Không có dữ liệu:", error);
      }
    };

    fetchService();
    setLoading(false);
  }, []);

  if (loading) {
    return (
      <div>
        {" "}
        <LoadingSkeleton />
      </div>
    );
  }

  const defaultSelectedValues = selectedProductDefault.map((product) => ({
    label: product.label,
    value: product.value,
  }));

  const defaultSelectedService = selectedServices.map((service) => ({
    label: service.label,
    value: service.value,
  }));

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
                </div>
              </div>
            </div>
            <div className="col-md-7 col-lg-8 col-xl-9">
              <div className="card">
                <div className="card-header">
                  <h4 className="card-title mb-0">Sửa hóa đơn</h4>
                </div>
                {bills?.prescriptions?.map(
                  (prescription, prescriptionIndex) => (
                    <div key={prescriptionIndex} className="card-body">
                      <div className="row">
                        <div className="col-sm-6">
                          <div className="biller-info">
                            <h4 className="d-block">
                              Tên khách hàng: {bills?.appointment.user.name}
                            </h4>
                            <label htmlFor="">Tên đơn thuốc:</label>
                            <input
                              className={`form-control ${
                                nameError ? "is-invalid" : ""
                              }`}
                              type="text"
                              value={editedName}
                              onChange={(e) => {
                                setEditedName(e.target.value);
                                setNameError("");
                              }}
                            />
                            {nameError && (
                              <div className="invalid-feedback">
                                {nameError}
                              </div>
                            )}
                          </div>
                        </div>
                        <div className="col-sm-6 text-sm-end">
                          <div className="billing-info">
                            <h4 className="d-block">
                              Ngày: {bills?.created_at}
                            </h4>
                            <span className="d-block text-muted">
                              Mã hóa đơn: {bills?.code}
                            </span>
                          </div>
                        </div>
                      </div>
                      <div className="card card-table">
                        <div className="card-body">
                          <div className="table-responsive">
                            <Select
                              mode="multiple"
                              size="large"
                              allowClear
                              style={{
                                width: "100%",
                                marginBottom: "24px",
                              }}
                              placeholder="Vui lòng chọn thuốc"
                              options={products.map((product) => ({
                                label: product.name,
                                value: product.id,
                              }))}
                              value={defaultSelectedValues}
                              onChange={handleSelectChange}
                            />
                            <table className="table table-hover table-center add-table-prescription">
                              <thead>
                                <tr>
                                  <th className="table-name1">
                                    Tên loại thuốc
                                  </th>
                                  <th style={{ width: 50 }}>Số lượng</th>
                                  <th className="table-name1">Giá tiền</th>
                                  <th className="table-name1">Tổng tiền</th>
                                  <th className="table-name1">
                                    Hướng dẫn sử dụng
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                {selectedProducts.map(
                                  (selectedProduct, productIndex) => (
                                    <tr key={productIndex} className="test">
                                      <td>
                                        <input
                                          className="form-control"
                                          placeholder="Chọn thuốc"
                                          style={{ width: 176, height: 43 }}
                                          value={selectedProduct.label}
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="number"
                                          value={selectedProduct.quantity}
                                          onChange={(e) =>
                                            handleQuantityChange(
                                              e,
                                              productIndex
                                            )
                                          }
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          value={selectedProduct.price}
                                          disabled
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          value={
                                            selectedProduct.price *
                                            (selectedProduct.quantity || 1)
                                          }
                                          disabled
                                        />
                                      </td>
                                      <td>
                                        <input
                                          className="form-control"
                                          type="text"
                                          value={selectedProduct.instructions}
                                          onChange={(e) =>
                                            handleInstructionChange(
                                              e,
                                              productIndex
                                            )
                                          }
                                        />
                                      </td>
                                    </tr>
                                  )
                                )}
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div className="card card-table">
                        <div className="card-body">
                          <div className="table-responsive">
                            <Select
                              mode="multiple"
                              size="large"
                              allowClear
                              style={{
                                width: "100%",
                                marginBottom: "24px",
                              }}
                              placeholder="Vui lòng chọn dịch vụ"
                              value={defaultSelectedService}
                              options={serviceBill.map((service) => ({
                                label: service.name,
                                value: service.id,
                              }))}
                              onChange={handleServiceSelectChange}
                            />
                            <table className="table table-hover table-center add-table-prescription">
                              <thead>
                                <tr>
                                  <th className="table-name">Tên dịch vụ</th>
                                  <th className="table-name">Giá tiền</th>
                                  <th className="table-name">Giảm giá</th>
                                </tr>
                              </thead>
                              <tbody>
                                {selectedServices.map((selectedService) => (
                                  <tr
                                    key={selectedService.value}
                                    className="test"
                                  >
                                    <td>{selectedService.label}</td>
                                    <td>{selectedService.price}</td>
                                    <input
                                      className="form-control"
                                      type="text"
                                    />
                                  </tr>
                                ))}
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div className="row">
                        <div className="card">
                          <div className="card-body">
                            <h4 className="card-title">Kết quả</h4>
                            <div className="mb-0">
                              <textarea
                                className={`form-control ${
                                  descriptionError ? "is-invalid" : ""
                                }`}
                                rows={5}
                                value={description}
                                onChange={(e) => {
                                  setDescription(e.target.value);
                                  setDescriptionError("");
                                }}
                              />
                              {descriptionError && (
                                <div className="invalid-feedback">
                                  {descriptionError}
                                </div>
                              )}
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
                              {isloading ? (
                                <div className="loading-spinner">
                                  <FaSpinner className="spinner" />
                                </div>
                              ) : (
                                "Lưu"
                              )}
                            </button>
                            <Link to={`/doctors/detail-bill/${id}`}>
                              {" "}
                              <button
                                type="reset"
                                className="btn btn-secondary submit-btn"
                              >
                                Xem chi tiết
                              </button>
                            </Link>

                            <Link to={`/doctors/appointments`}>
                              {" "}
                              <button
                                type="reset"
                                className="btn btn-danger submit-btn"
                              >
                                Quay lại
                              </button>
                            </Link>
                          </div>
                        </div>
                      </div>
                    </div>
                  )
                ) || (
                  <div className="card-body">
                    <div className="row">
                      <div className="col-sm-6">
                        <div className="biller-info">
                          <h4 className="d-block">
                            Tên khách hàng: {billDefault?.appointment.user.name}
                          </h4>
                          <label htmlFor="">Tên đơn thuốc:</label>
                          <input
                            className={`form-control ${
                              nameError ? "is-invalid" : ""
                            }`}
                            type="text"
                            value={editedName}
                            onChange={(e) => {
                              setEditedName(e.target.value);
                              setNameError("");
                            }}
                          />
                          {nameError && (
                            <div className="invalid-feedback">{nameError}</div>
                          )}
                        </div>
                      </div>
                      <div className="col-sm-6 text-sm-end">
                        <div className="billing-info">
                          <h4 className="d-block">
                            Ngày: {billDefault?.created_at}
                          </h4>
                          <span className="d-block text-muted">
                            Mã hóa đơn: {billDefault?.code}
                          </span>
                        </div>
                      </div>
                    </div>
                    <div className="card card-table">
                      <div className="card-body">
                        <div className="table-responsive">
                          <Select
                            mode="multiple"
                            size="large"
                            allowClear
                            style={{
                              width: "100%",
                              marginBottom: "24px",
                            }}
                            placeholder="Vui lòng chọn thuốc"
                            options={products.map((product) => ({
                              label: product.name,
                              value: product.id,
                            }))}
                            value={defaultSelectedValues}
                            onChange={handleSelectChange}
                          />
                          <table className="table table-hover table-center add-table-prescription">
                            <thead>
                              <tr>
                                <th className="table-name1">Tên loại thuốc</th>
                                <th style={{ width: 50 }}>Số lượng</th>
                                <th className="table-name1">Giá tiền</th>
                                <th className="table-name1">Tổng tiền</th>
                                <th className="table-name1">
                                  Hướng dẫn sử dụng
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              {selectedProducts.map(
                                (selectedProduct, productIndex) => (
                                  <tr key={productIndex} className="test">
                                    <td>
                                      <input
                                        className="form-control"
                                        placeholder="Chọn thuốc"
                                        style={{ width: 176, height: 43 }}
                                        value={selectedProduct.label}
                                      />
                                    </td>
                                    <td>
                                      <input
                                        className="form-control"
                                        type="number"
                                        value={selectedProduct.quantity || 1}
                                        onChange={(e) =>
                                          handleQuantityChange(e, productIndex)
                                        }
                                      />
                                    </td>
                                    <td>
                                      <input
                                        className="form-control"
                                        type="text"
                                        value={selectedProduct.price}
                                        disabled
                                      />
                                    </td>
                                    <td>
                                      <input
                                        className="form-control"
                                        type="text"
                                        value={
                                          selectedProduct.price *
                                          (selectedProduct.quantity || 1)
                                        }
                                        disabled
                                      />
                                    </td>
                                    <td>
                                      <input
                                        className="form-control"
                                        type="text"
                                        value={selectedProduct.instructions}
                                        onChange={(e) =>
                                          handleInstructionChange(
                                            e,
                                            productIndex
                                          )
                                        }
                                      />
                                    </td>
                                  </tr>
                                )
                              )}
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div className="card card-table">
                      <div className="card-body">
                        <div className="table-responsive">
                          <Select
                            mode="multiple"
                            size="large"
                            allowClear
                            style={{
                              width: "100%",
                              marginBottom: "24px",
                            }}
                            placeholder="Vui lòng chọn dịch vụ"
                            value={defaultSelectedService}
                            options={serviceBill.map((service) => ({
                              label: service.name,
                              value: service.id,
                            }))}
                            onChange={handleServiceSelectChange}
                          />
                          <table className="table table-hover table-center add-table-prescription">
                            <thead>
                              <tr>
                                <th className="table-name">Tên dịch vụ</th>
                                <th className="table-name">Giá tiền</th>
                                <th className="table-name">Giảm giá</th>
                              </tr>
                            </thead>
                            <tbody>
                              {selectedServices.map((selectedService) => (
                                <tr
                                  key={selectedService.value}
                                  className="test"
                                >
                                  <td>{selectedService.label}</td>
                                  <td>{selectedService.price}</td>
                                  <td>
                                    <input
                                      className="form-control"
                                      type="text"
                                    />
                                  </td>
                                </tr>
                              ))}
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div className="row">
                      <div className="card">
                        <div className="card-body">
                          <h4 className="card-title">Kết quả</h4>
                          <div className="mb-0">
                            <textarea
                              className={`form-control ${
                                descriptionError ? "is-invalid" : ""
                              }`}
                              rows={5}
                              value={description}
                              onChange={(e) => {
                                setDescription(e.target.value);
                                setDescriptionError("");
                              }}
                            />
                            {descriptionError && (
                              <div className="invalid-feedback">
                                {descriptionError}
                              </div>
                            )}
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
                            {isloading ? (
                              <div className="loading-spinner">
                                <FaSpinner className="spinner" />
                              </div>
                            ) : (
                              "Lưu"
                            )}
                          </button>
                          <Link to={`/doctors/detail-bill/${id}`}>
                            {" "}
                            <button
                              type="reset"
                              className="btn btn-secondary submit-btn"
                            >
                              Xem chi tiết
                            </button>
                          </Link>
                          <Link to={`/doctors/appointments`}>
                            {" "}
                            <button
                              type="reset"
                              className="btn btn-danger submit-btn"
                            >
                              Quay lại
                            </button>
                          </Link>
                        </div>
                      </div>
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
export default Editbill;
