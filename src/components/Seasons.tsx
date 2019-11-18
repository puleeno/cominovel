import { Button,  Icon, Input, PageHeader } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import {  AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchSeasons } from "../actions";
import { IRootState } from "../reducers";
import Form from "./antd/Form";

let id = 0;
interface IFormProps {
  form: any;
}

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispacthToProps> & IFormProps;

const formItemLayout = {
  labelCol: {
    sm: { span: 5 },
    xs: { span: 24 },
  },
  wrapperCol: {
    sm: { span: 12 },
    xs: { span: 24 },
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

  public componentDidMount() {
    this.props.fetchSeasons(window.Cominovel.currentID);
  }

  public renderSeasons() {
    const { getFieldDecorator, getFieldValue } = this.props.form;
    getFieldDecorator("keys", { initialValue: [] });
    const keys = getFieldValue("keys");

    return keys.map((k: string, index: number) => (
      <Form.Item
        {...formItemLayout}
        label={`Seasons ${index + 1}`}
        required={false}
        key={k}
      >
        {getFieldDecorator(`names[${k}]`, {
          rules: [
            {
              message: "Please input season name or delete this field.",
              required: true,
              whitespace: true,
            },
          ],
          validateTrigger: ["onChange", "onBlur"],
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
  }

  public saveSeason = () => {
  }

  public render() {

    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Seasons" subTitle="Biên soạn season cho truyện" />
        <Form
          {...formItemLayout}
          labelAlign="left"
        >
          {this.renderSeasons()}
          <Form.Item>
            <Button type="dashed" onClick={this.add} style={{ width: "60%" }}>
              <Icon type="plus" /> Add New Season
            </Button>
          </Form.Item>
          <Form.Item>
            <Button size="large" type="primary" htmlType="submit" onClick={this.saveSeason}>
              Save
            </Button>
          </Form.Item>
        </Form>
      </div>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  seasons: state.seasons,
});

const mapDispacthToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchSeasons,
}, dispatch);

const WrappedDynamicFieldSet = Form.create({ name: "dynamic_form_item" })(Seasons);

export default connect(mapStateToProps, mapDispacthToProps)(WrappedDynamicFieldSet);
