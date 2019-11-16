import { AutoComplete } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../../actions";
import Form from "../antd/Form";
import { ITermType } from "../../interfaces/WordPressProps";
import { IRootState} from "../../reducers";

const { Item } = Form;

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispatchToProps>;

class Artists extends Component<IProps> {
  public componentDidMount() {
    this.props.fetchTaxonomyTerms("cm_artist");
  }

  public renderCominovelArtists() {
    if (typeof this.props.artists === "object") {
      return this.props.artists.map((artist: ITermType, index: number) => {
        return (
          <AutoComplete.Option key={artist.id.toString()}>{artist.name}</AutoComplete.Option>
        );
      });
    }
    return null;
  }

  public render() {
    return (
      <Item label="Artists">
          <AutoComplete style={{ width: "100%" }} placeholder="Tiểu Tôn Tuyết Đăng">
            {this.renderCominovelArtists()}
          </AutoComplete>
          </Item>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  artists: state.terms.cm_artist || [],
});

const mapDispatchToProps = (dispatch: Dispatch) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(Artists);
