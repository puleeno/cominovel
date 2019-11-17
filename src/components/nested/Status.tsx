import { Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispatchToProps>;

class Status extends Component<IProps> {
  public componentDidMount() {
    this.props.fetchTaxonomyTerms("cm_status");
  }

  public renderItemKey(index: number) {
    return `status${index}`;
  }

  public renderCominovelStatus() {
    if (typeof this.props.statues === "object") {
      return this.props.statues.map((status: ITermType, index: number) => {
        return (
          <Select.Option key={this.renderItemKey(index)} value={status.id.toString()}>{status.name}</Select.Option>
        );
      });
    }
    return null;
  }

  public render() {
    return (
      <Form.Item
            label="Status"
          >
            <Select
              placeholder="The status of the comic"
              style={{ width: 200 }}
            >
              {this.renderCominovelStatus()}
            </Select>
          </Form.Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  statues: state.terms.cm_status,
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Status);
