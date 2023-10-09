import { useState } from "react";
import { Modal, Button, DatePicker, Form, Input, TreeSelect } from "antd";

const Banner = () => {
  const [isModalOpen, setIsModalOpen] = useState(false);
  const showModal = () => {
    setIsModalOpen(true);
  };
  const handleOk = () => {
    setIsModalOpen(false);
  };
  const handleCancel = () => {
    setIsModalOpen(false);
  };

  return (
    <div>
      <div>
        <section className="banner-section-fourteen banner-section-twelve">
          <div className="banner-section-twelve-bg">
            <img
              src="../src/assets/img/bg/home-12-banner-bg-1.png"
              alt="design-image"
            />
            <img
              src="../src/assets/img/bg/home-12-banner-bg-2.png"
              alt="design-image"
            />
          </div>
          <div className="container">
            <div className="row">
              <div className="col-lg-6">
                <div className="banner-img banner-img-twelve aos">
                  <img
                    src="../src/assets/img/bg/home-12-banner-1.png"
                    className="img-fluid"
                    alt="dog-image"
                  />
                  <img
                    src="../src/assets/img/bg/home-12-banner-2.png"
                    className="img-fluid"
                    alt="cat-image"
                  />
                  <div className="banner-banner-img-twelve-bg">
                    <img src="../src/assets/img/bg/dot-1.png" alt="dot-icon" />
                    <img src="../src/assets/img/bg/dot-2.png" alt="dot-icon" />
                    <img
                      src="../src/assets/img/bg/ring-1.png"
                      alt="ring-icon"
                    />
                    <img
                      src="../src/assets/img/bg/ring-2.png"
                      alt="ring-icon"
                    />
                  </div>
                </div>
              </div>
              <div className="col-lg-6">
                <div className="banner-content banner-content-fourteen aos">
                  <h1>
                    Hãy để chúng tôi <span>chăm sóc thú cưng của bạn</span>
                  </h1>
                </div>
                <Button size="large" type="primary" style={{ width: 250, height: 60, fontSize: 28}} onClick={showModal}>
                  Đặt Lịch Nhanh
                </Button>
                <Modal
                  title="Hãy Điền Thông Tin"
                  open={isModalOpen}
                  onOk={handleOk}
                  onCancel={handleCancel}
                >
                  <Form layout="vertical">
                    <Form.Item label="Chọn Dịch Vụ">
                      <TreeSelect
                        treeData={[
                          {
                            title: "Khám Bệnh",
                            value: "Khám Bệnh",
                          },
                          {
                            title: "Chữa Bệnh",
                            value: "Chữa Bệnh",
                          },
                          {
                            title: "Spa",
                            value: "Spa",
                          },
                        ]}
                      />
                    </Form.Item>
                    <Form.Item label="Chọn Bác Sĩ">
                      <TreeSelect
                        treeData={[
                          {
                            title: "Thiều",
                            value: "Thiều",
                          },
                          {
                            title: "Anh Bá",
                            value: "Anh Bá",
                          },
                          {
                            title: "Khánh",
                            value: "Khánh",
                          },
                        ]}
                      />
                    </Form.Item>
                    <Form.Item label="Chọn Ngày">
                      <DatePicker />
                    </Form.Item>
                    <Form.Item label="Chọn Thời Gian">
                      <Button>Ca 1 (08:00 - 12:00)</Button>
                      <Button>Ca 2 (13:00 - 17:00)</Button>
                      <Button>Ca 3 (08:00 - 20:00)</Button>
                    </Form.Item>
                    <Form.Item label=" Họ và Tên">
                      <Input />
                    </Form.Item>
                    <Form.Item label=" Số Điện Thoại">
                      <Input type="" />
                    </Form.Item>
                  </Form>
                </Modal>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  );
};

export default Banner;
