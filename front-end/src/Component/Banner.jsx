import { useState } from "react";
import { Modal, Button, DatePicker, Form, Input, Row, Col, Radio, Select } from "antd";
const {TextArea} = Input

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

  const handleChange = (value) => {
    console.log(`selected ${value}`);
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
                  width={1000}
                  okText="Đặt Lịch"
                  cancelText="Hủy"
                >
                  <Form layout="vertical" >
                  <Row gutter={16}>
                    <Col span={12}>
                      <Form.Item label="Chọn Dịch Vụ">
                      <Select
                          defaultValue="Khám Bệnh"
                          onChange={handleChange}
                          options={[
                            { value: 'Khám Bệnh', label: 'Khám Bệnh' },
                            { value: 'Chữa Bệnh', label: 'Chữa Bệnh' },
                            { value: 'Spa', label: 'Spa' },
                          ]}
                        />
                      </Form.Item>
                    </Col>
                    <Col span={12}>
                      <Form.Item label="Chọn Bác Sĩ">
                      <Select
                          defaultValue="Thiều"
                          onChange={handleChange}
                          options={[
                            { value: 'Thiều', label: 'Thiều' },
                            { value: 'Anh Bá', label: 'Anh Bá' },
                            { value: 'Khánh', label: 'Khánh' },
                          ]}
                        />
                      </Form.Item>
                    </Col>
                  </Row>
                  <Row gutter={16}>
                    <Col span={12}>
                    <Form.Item label="Chọn Ngày">
                      <DatePicker />
                    </Form.Item>
                    </Col>
                    <Col span={12}>
                    <Form.Item label="Chọn Thời Gian">
                      <Radio.Group defaultValue="a" buttonStyle="solid">
                        <Radio.Button value="a">Ca 1 (08:00 - 12:00)</Radio.Button>
                        <Radio.Button value="b">Ca 2 (13:00 - 17:00)</Radio.Button>
                        <Radio.Button value="c">Ca 3 (08:00 - 20:00)</Radio.Button>
                      </Radio.Group>
                    </Form.Item>
                    </Col>
                    </Row>
                    <Row gutter={16}>
                    <Col span={12}>
                    <Form.Item label=" Họ và Tên">
                      <Input />
                    </Form.Item>
                    </Col>
                    <Col span={12}>
                    <Form.Item label=" Số Điện Thoại">
                      <Input type="" />
                    </Form.Item>
                    </Col>
                    </Row>
                    <Form.Item label="Chọn loại thú cưng">
                    <Select
                          defaultValue="Chim"
                          onChange={handleChange}
                          options={[
                            { value: 'Chim', label: 'Chim' },
                            { value: 'Chó', label: 'Chó' },
                            { value: 'Mèo', label: 'Mèo' },
                          ]}
                        />
                    </Form.Item>
                    <Form.Item label="Ghi Chú">
                    <TextArea rows={3} />
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
