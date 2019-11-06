import { Checkbox, Col, PageHeader, Row, Select } from "antd";
import React, { Component } from "react";
import Form from "../antd/Form";

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
          <Form.Item label="Badge">
            <Select
              showSearch
              style={{ width: 200 }}
              placeholder="Select a person"
              optionFilterProp="children"
            >
              <Select.Option value="jack">Jack</Select.Option>
              <Select.Option value="lucy">Lucy</Select.Option>
              <Select.Option value="tom">Tom</Select.Option>
            </Select>
          </Form.Item>
        </Form>
      </div>
    );
  }
}

export default Advanced;
