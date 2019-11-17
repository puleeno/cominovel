import { Input, Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { TAXONOMY_COUNTRY } from "../../common/constants";
import { TermHelpers } from "../../helpers";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispatchToProps>;
interface IState {
  selectedCountries: number[];
}

class Countries extends Component<IProps, IState> {
  public state: IState = {
    selectedCountries: this.props.selectedCountries,
  };

  public componentDidMount() {
    this.props.fetchTaxonomyTerms("cm_country");
  }

  public UNSAFE_componentWillReceiveProps(nextProps: IProps) {
    if (nextProps.selectedCountries !== this.props.selectedCountries) {
      this.setState({
        selectedCountries: nextProps.selectedCountries,
      });
    }
  }

  public handleChange = (value: number) => {
    this.setState({
      selectedCountries: [value],
    });
  }

  public renderItemKey(index: number, prefix: string = "country") {
    return `${prefix}${index}`;
  }

  public renderCominovelCountries() {
    if (typeof this.props.countries === "object") {
      return this.props.countries.map((country: ITermType, index: number) => {
        return (
          <Select.Option
            key={this.renderItemKey(index)}
            value={country.id}
          >
            {country.name}
          </Select.Option>
        );
      });
    }
    return null;
  }

  public renderSelectedCountries() {
    const taxName = "tax_input[" + TAXONOMY_COUNTRY + "][]";
    return this.state.selectedCountries.map((value: number, index: number) =>  {
      return (
        <Input
          key={this.renderItemKey(index, "country_value")}
          type="hidden" name={ taxName }
          value={value}
        />
      );
    });
  }

  public render() {
    const selectedMustBeNumber = this.state.selectedCountries[0];
    return (
      <Form.Item
            label="Comic Type"
          >
            <Select
              placeholder="Country or comic types"
              style={{ width: 200 }}
              value={selectedMustBeNumber}
              onChange={this.handleChange}
            >
              {this.renderCominovelCountries()}
            </Select>
            {this.renderSelectedCountries()}
          </Form.Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  countries: state.terms.cm_country || [],
  selectedCountries: TermHelpers.extractTermIds(state.cominovel.info.cm_country_terms || []),
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Countries);
