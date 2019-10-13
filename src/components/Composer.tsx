import { Button, Checkbox, Col, Icon, PageHeader, Radio, Row, Select, Upload } from "antd";
import React, { Component, FormEvent } from "react";
import Form from "../antd/Form";
import { FileInfo } from "../interfaces/Composer";

interface IProps {
  form: any;
}

class Composer extends Component<IProps> {
  public handleSubmit = (e: FormEvent) => {
    e.preventDefault();
    this.props.form.validateFields((err: any, values: any) => {
      if (!err) {
        console.log("Received values of form: ", values);
      }
    });
  }

  public normFile = (e: FileInfo) => {
    console.log("Upload event:", e);
    if (Array.isArray(e)) {
      return e;
    }
    return e && e.fileList;
  }

  public render() {
    const { getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 6 },
      wrapperCol: { span: 14 },
    };
    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Composer" subTitle="Trình biên soạn chapter cho truyện" />
        <Form
          {...formItemLayout}
          labelAlign="left"
        >
          <Form.Item label="Cloud Storage">
            {getFieldDecorator("checkbox-group", {
              initialValue: ["A", "B"],
            })(
              <Checkbox.Group style={{ width: "100%" }}>
                <Row>
                  <Col span={8}>
                    <Checkbox value="A">A</Checkbox>
                  </Col>
                  <Col span={8}>
                    <Checkbox disabled value="B">
                      B
                    </Checkbox>
                  </Col>
                  <Col span={8}>
                    <Checkbox value="C">C</Checkbox>
                  </Col>
                  <Col span={8}>
                    <Checkbox value="D">D</Checkbox>
                  </Col>
                  <Col span={8}>
                    <Checkbox value="E">E</Checkbox>
                  </Col>
                </Row>
              </Checkbox.Group>,
            )}
          </Form.Item>

          <Form.Item
            label="Season"
          >
            <Select
              showSearch
              style={{ width: 200 }}
              placeholder="Select comic type"
              optionFilterProp="children"
              filterOption={(input: string, option: any) =>
                option.props.children.toLowerCase().indexOf(input.toLowerCase()) >= 0
              }
            >
              <Select.Option value="manga">Manga</Select.Option>
              <Select.Option value="manhua">Manhua</Select.Option>
              <Select.Option value="manhwa">Manhwa</Select.Option>
            </Select>
          </Form.Item>

          <Form.Item
            label="ZIP Mode"
          >
            {getFieldDecorator("radio-button")(
              <Radio.Group>
                <Radio.Button value="a">Auto</Radio.Button>
                <Radio.Button value="c">Single Chapter</Radio.Button>
                <Radio.Button value="b">Multi Chapter</Radio.Button>
              </Radio.Group>,
            )}
          </Form.Item>

          <Form.Item
            label="Upload"
          >
            {getFieldDecorator("dragger", {
              valuePropName: "fileList",
              getValueFromEvent: this.normFile,
            })(
              <Upload.Dragger name="files" action="/upload.do">
                <p className="ant-upload-drag-icon">
                  <Icon type="inbox" />
                </p>
                <p className="ant-upload-text">Click or drag file to this area to upload</p>
                <p className="ant-upload-hint">Support for a single or bulk upload.</p>
              </Upload.Dragger>,
            )}
          </Form.Item>

          <Form.Item wrapperCol={{ span: 12, offset: 6 }}>
            <Button type="primary" htmlType="submit">
              Compose
            </Button>
          </Form.Item>
        </Form>
      </div>
    );
  }
}

const WrappedComposer = Form.create({ name: "validate_other" })(Composer);

export default WrappedComposer;
