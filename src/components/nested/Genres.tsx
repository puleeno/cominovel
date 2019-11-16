import { Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState } from "../../reducers";
import Form from "../antd/Form";

const { Item } = Form;

type IProps = ReturnType<typeof mapDispatchToProps> & ReturnType<typeof mapStateToProps>;

class Genres extends Component<IProps> {
  public componentDidMount() {
    this.props.fetchTaxonomyTerms("genre", null, true);
  }

  public renderCominovelGenres() {
    if (typeof this.props.genres === "object") {
      return this.props.genres.map((genre: ITermType, index: number) => {
        return (
          <Select.Option key={genre.id.toString()}>{genre.name}</Select.Option>
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
          placeholder="The genre of comic"
          style={{ width: 200 }}
        >
          {this.renderCominovelGenres()}
        </Select>
      </Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  genres: state.terms.genre || [],
});

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Genres);
