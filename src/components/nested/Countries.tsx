import { Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispatchToProps>;

class Countries extends Component<IProps> {
  public componentDidMount() {
    this.props.fetchTaxonomyTerms();
  }

  public renderItemKey(index: number, prefix: string = "item") {
    return `${prefix}-${index}`;
  }

  public renderCominovelCountries() {
    if (typeof this.props.countries === "object") {
      return this.props.countries.map((country: ITermType, index: number) => {
        return (
          <Select.Option key={this.renderItemKey(index)} value={country.id.toString()}>{country.name}</Select.Option>
        );
      });
    }
    return null;
  }

  public render() {
    return (
      <Form.Item
            label="Comic Type"
          >
            <Select
              placeholder="Country or comic types"
              style={{ width: 200 }}
            >
              {this.renderCominovelCountries()}
            </Select>
          </Form.Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  countries: state.terms.cm_country || [],
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Countries);