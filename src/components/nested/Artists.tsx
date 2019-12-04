import { Input, Select } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import { TAXONOMY_ARTIST } from "../../common/constants";
import { TermHelpers } from "../../helpers";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState} from "../../reducers";
import Form from "../antd/Form";

const { Item } = Form;

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispatchToProps>;
interface IState {
  selectedArtists: number[];
}

class Artists extends Component<IProps, IState> {
  public state: IState = {
    selectedArtists: this.props.selectedArtists,
  };

  public componentDidMount() {
    this.props.fetchTaxonomyTerms("cmn_artist");
  }

  public UNSAFE_componentWillReceiveProps(nextProps: IProps) {
    if (nextProps.selectedArtists !== this.props.selectedArtists) {
      this.setState({
        selectedArtists: nextProps.selectedArtists,
      });
    }
  }

  public handleChange = (value: any) => {
    this.setState({
      selectedArtists: [value],
    });
  }

  public renderItemKey(index: number, prefix: string = "artist") {
    return `${prefix}${index}`;
  }

  public renderCominovelArtists() {
    if (typeof this.props.artists === "object") {
      return this.props.artists.map((artist: ITermType, index: number) => {
        return (
          <Select.Option
            key={this.renderItemKey(index, "artist_option")}
            value={artist.id}
          >
            {artist.name}
          </Select.Option>
        );
      });
    }
    return null;
  }

  public renderSelectedArtist() {
    const taxName = "tax_input[" + TAXONOMY_ARTIST + "][]";
    return this.state.selectedArtists.map((artistId: number, index: number) => {
      return(
        <Input
          key={this.renderItemKey(index, "artist_option")}
          type="hidden"
          name={taxName}
          value={artistId}
        />
      );
    });
  }

  public render() {
    return (
      <Item label="Artists">
        <Select
          showSearch
          optionFilterProp="children"
          placeholder="Tiểu Tôn Tuyết Đăng"
          style={{ width: "100%" }}
          onChange={this.handleChange}
          value={this.state.selectedArtists[0] || undefined}
        >
        {this.renderCominovelArtists()}
        </Select>
        {this.renderSelectedArtist()}
      </Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  artists: state.terms.cmn_artist || [],
  selectedArtists: TermHelpers.extractTermIds(state.cominovel.info.cmn_artist_terms || []),
});

const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Artists);
