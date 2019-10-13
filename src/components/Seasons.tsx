import { Button,  Icon, Input, PageHeader } from "antd";
import React, { Component } from "react";
import Form from "../antd/Form";

let id = 0;

interface IProps {
  form: any;
}

const formItemLayout = {
  labelCol: {
    xs: { span: 24 },
    sm: { span: 5 },
  },
  wrapperCol: {
    xs: { span: 24 },
    sm: { span: 12 },
  },
};

class Seasons extends Component<IProps> {
  public remove = (k: string) => {
    const { form } = this.props;
    // can use data-binding to get
    const keys = form.getFieldValue("keys");
    // We need at least one passenger
    if (keys.length === 1) {
      return;
    }

    // can use data-binding to set
    form.setFieldsValue({
      keys: keys.filter((key: string) => key !== k),
    });
  }

  public add = () => {
    const { form } = this.props;
    // can use data-binding to get
    const keys = form.getFieldValue("keys");
    const nextKeys = keys.concat(id++);
    // can use data-binding to set
    // important! notify form to detect changes
    form.setFieldsValue({
      keys: nextKeys,
    });
  }

  public render() {
    const { getFieldDecorator, getFieldValue } = this.props.form;

    getFieldDecorator("keys", { initialValue: [] });
    const keys = getFieldValue("keys");
    const formItems = keys.map((k: string, index: number) => (
      <Form.Item
        label={`Season ${index + 1}`}
        required={false}
        key={k}
      >
        {getFieldDecorator(`names[${k}]`, {
          validateTrigger: ["onChange", "onBlur"],
          rules: [
            {
              required: true,
              whitespace: true,
              message: "Please input passenger's name or delete this field.",
            },
          ],
        })(<Input placeholder="Season name" style={{ width: "60%", marginRight: 8 }} />)}
        {keys.length > 1 ? (
          <Icon
            className="dynamic-delete-button"
            type="minus-circle-o"
            onClick={() => this.remove(k)}
          />
        ) : null}
      </Form.Item>
    ));

    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Seasons" subTitle="Biên soạn season cho truyện" />
        <Form
          {...formItemLayout}
          labelAlign="left"
        >
          {formItems}
          <Form.Item>
            <Button type="dashed" onClick={this.add} style={{ width: "60%" }}>
              <Icon type="plus" /> Add New Season
            </Button>
          </Form.Item>
          <Form.Item>
            <Button size="large" type="primary" htmlType="submit">
              Save
            </Button>
          </Form.Item>
        </Form>
      </div>
    );
  }
}

const WrappedDynamicFieldSet = Form.create({ name: "dynamic_form_item" })(Seasons);
export default WrappedDynamicFieldSet;
