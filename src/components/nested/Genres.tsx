import { Input, Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { TAXONOMY_GENRE } from "../../common/constants";
import { TermHelpers } from "../../helpers";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

const { Item } = Form;

type IProps = ReturnType<typeof mapDispatchToProps> & ReturnType<typeof mapStateToProps>;
interface IState {
  selectedGenres: number[];
}

class Genres extends Component<IProps, IState> {
  public state: IState = {
    selectedGenres: this.props.selectedGenres,
  };

  public componentDidMount() {
    this.props.fetchTaxonomyTerms("genre", null, true);
  }

  public UNSAFE_componentWillReceiveProps(nextProps: IProps) {
    if (nextProps.selectedGenres !== this.props.selectedGenres) {
      this.setState({
        selectedGenres: nextProps.selectedGenres,
      });
    }
  }

  public handleChange = (value: number) => {
    this.setState({
      selectedGenres: [value],
    });
  }

  public renderItemKey(index: number, prefix: string = "genre") {
    return `${prefix}${index}`;
  }

  public renderSelectedGenres() {
    const taxName = "tax_input[" + TAXONOMY_GENRE + "][]";

    return this.state.selectedGenres.map((genre: number, index: number) => {
      return (
        <Input
          type="hidden"
          key={this.renderItemKey(index, "genre_option")}
          name={taxName}
          value={genre}
        />
      );
    });
  }

  public renderCominovelGenres() {
    if (typeof this.props.genres === "object") {
      return this.props.genres.map((genre: ITermType, index: number) => {
        return (
          <Select.Option
            key={this.renderItemKey(index)}
            value={genre.id}
          >
            {genre.name}
          </Select.Option>
        );
      });
    }
    return null;
  }

  public render() {
    return (
      <Item label="Genres" >
        <Select
          showSearch
          optionFilterProp="children"
          placeholder="The genre of comic"
          style={{ width: 200 }}
          onChange={this.handleChange}
          value={this.state.selectedGenres[0] || undefined}
        >
          {this.renderCominovelGenres()}
        </Select>
        {this.renderSelectedGenres()}
      </Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  genres: state.terms.genre || [],
  selectedGenres: TermHelpers.extractTermIds(state.cominovel.info.genre_terms) || [],
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Genres);
