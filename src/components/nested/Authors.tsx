import { Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispatchToProps>;

class Authors extends Component<IProps> {
  public componentDidMount() {
    this.props.fetchTaxonomyTerms();
  }

  public renderItemKey(index: number, prefix: string = "item") {
    return `${prefix}-${index}`;
  }

  public renderCominovelAuthors() {
    if (typeof this.props.authors === "object") {
      return this.props.authors.map((author: ITermType, index: number) => {
        return (
          <Select.Option key={this.renderItemKey(index)} value={author.id.toString()}>{author.name}</Select.Option>
        );
      });
    }
    return null;
  }

  public render() {
    return (
      <Form.Item
      label="Authors"
    >
      <Select
        placeholder="Choose or add author"
        style={{ width: "100%" }}
      >
        {this.renderCominovelAuthors()}
      </Select>
    </Form.Item>

    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  authors: state.terms.cm_author || [],
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Authors);
