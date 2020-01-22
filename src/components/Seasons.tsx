import { Button,  Icon, Input, PageHeader } from "antd";
import serialize from "form-serialize";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchSeasons, updateSeasons } from "../actions";
import { ISeason } from "../interfaces/CominovelProps";
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
  public remove = (season: ISeason, k: number) => {
    const { form } = this.props;
    // can use data-binding to get
    const keys = form.getFieldValue("keys");
    if (keys.length === 1) {
      return;
    }

    form.setFieldsValue({
      // tslint:disable-next-line: no-shadowed-variable
      keys: keys.filter((season: ISeason, key: number) => key !== k),
    });
  }

  public add = () => {
    const { form } = this.props;
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

  public saveSeason = (e: any) => {
    const seasonForm = document.getElementById("cominovel-seasons") as any;
    seasonForm.elements = seasonForm.querySelectorAll("input") as HTMLFormControlsCollection;

    const data = serialize(seasonForm as HTMLFormElement, { hash: true });
    this.props.updateSeasons(data.cominovel_seasons, window.Cominovel.currentID);
  }

  public renderFieldName(name: string, index: number) {
    return `cominovel_seasons[${index}][${name}]`;
  }

  public renderSeasons() {
    const { getFieldDecorator, getFieldValue } = this.props.form;
    getFieldDecorator("keys", { initialValue: this.props.seasons });
    const keys = getFieldValue("keys");

    return keys.map((season: ISeason, index: number) => {
      const mapItemKey = `meta_${index}_${season.meta_id}`;
      return (
      <Form.Item
        {...formItemLayout}
        label={`Seasons ${index + 1}`}
        required={false}
        key={mapItemKey}
      >
        {getFieldDecorator(this.renderFieldName("meta_id", index), {
          initialValue: season.meta_id || "",
          rules: [
            {
              message: "Please input season name or delete this field.",
              whitespace: false,
            },
          ],
        })(
          <Input type="hidden" name={this.renderFieldName("meta_id", index)} />,
        )}
        {
          getFieldDecorator(this.renderFieldName("meta_value", index),
          {
            initialValue: season.meta_value,
            rules: [
              {
                message: "Please input season name or delete this field.",
                required: true,
                whitespace: true,
              },
            ],
            validateTrigger: ["onChange", "onBlur"],
          })(<Input
            placeholder="Season name"
            name={this.renderFieldName("meta_value", index)}
            style={{ width: "60%", marginRight: 8 }}
          />)
        }

        {
          keys.length > 1 ? (
            <Icon
              className="dynamic-delete-button"
              type="minus-circle-o"
              onClick={() => this.remove(season, index)}
            />
          ) : null
        }
      </Form.Item>
    );
  },
    );
  }

  public render() {

    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Seasons" subTitle="Biên soạn season cho truyện" />
        <Form
          {...formItemLayout}
          labelAlign="left"
          id="cominovel-seasons"
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
  updateSeasons,
}, dispatch);

const WrappedDynamicFieldSet = Form.create({ name: "dynamic_form_item" })(Seasons);

export default connect(mapStateToProps, mapDispacthToProps)(WrappedDynamicFieldSet);
