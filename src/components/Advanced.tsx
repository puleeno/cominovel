import { Checkbox, Col, PageHeader, Row } from "antd";
import React, { Component } from "react";
import Form from "./antd/Form";

interface IProps {
  form: any;
}

class Advanced extends Component {
  public render() {
    const formItemLayout = {
      labelCol: { span: 6 },
      wrapperCol: { span: 14 },
    };

    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Advanced" subTitle="Các thông tin nâng cao" />
        <Form
          {...formItemLayout}
          labelAlign="left"
        >
          <Form.Item label="Adult content">
            <Checkbox.Group style={{ width: "100%" }} name="rating_system">
              <Row>
                <Col span={8}>
                  <Checkbox value="X">Include</Checkbox>
                </Col>
              </Row>
            </Checkbox.Group>,
          </Form.Item>
        </Form>
      </div>
    );
  }
}

export default Advanced;
