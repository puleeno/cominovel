import { Input, Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { TAXONOMY_AUTHOR } from "../../common/constants";
import { TermHelpers } from "../../helpers";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispatchToProps>;
interface IState {
  selectedAuthors: number[];
}

class Authors extends Component<IProps, IState> {
  public state: IState = {
    selectedAuthors: this.props.selectedAuthors,
  };

  public componentDidMount() {
    this.props.fetchTaxonomyTerms("cm_author");
  }

  public UNSAFE_componentWillReceiveProps(nextProps: IProps) {
    if (nextProps.selectedAuthors !== this.props.selectedAuthors) {
      this.setState({
        selectedAuthors: nextProps.selectedAuthors,
      });
    }
  }

  public handlerChange = (value: number) => {
    this.setState({
      selectedAuthors: [value],
    });
  }

  public renderItemKey(index: number, prefix: string = "author") {
    return `${prefix}${index}`;
  }

  public renderCominovelAuthors() {
    if (typeof this.props.authors === "object") {
      return this.props.authors.map((author: ITermType, index: number) => {
        return (
          <Select.Option
            key={this.renderItemKey(index)}
            value={author.id.toString()}
          >
            {author.name}
          </Select.Option>
        );
      });
    }
    return null;
  }

  public renderSelectedAuthors() {
    const taxName = "tax_input[" + TAXONOMY_AUTHOR + "][]";
    return this.state.selectedAuthors.map((author: number, index: number) => {
      return (
        <Input
          type="hidden"
          key={this.renderItemKey(index, "author_option")}
          name={taxName}
          value={author}
        />
      );
    });
  }

  public render() {
    return (
      <Form.Item
      label="Authors"
    >
      <Select
        placeholder="Choose or add author"
        style={{ width: "100%" }}
        value={this.state.selectedAuthors[0]}
        onChange={this.handlerChange}
      >
        {this.renderCominovelAuthors()}
      </Select>
      {this.renderSelectedAuthors()}
    </Form.Item>

    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  authors: state.terms.cm_author || [],
  selectedAuthors: TermHelpers.extractTermIds(state.cominovel.info.cm_author_terms || []),
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Authors);
