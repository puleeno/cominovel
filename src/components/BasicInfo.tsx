import {
  AutoComplete, DatePicker, Input, PageHeader, Select, Tree,
} from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../actions";
import Form from "../antd/Form";
import { ICominovelData } from "../interfaces/CominovelProps";
import { ITermType } from "../interfaces/WordPressProps";
import { IRootState } from "../reducers";

const { Item } = Form;
const { Option } = Select;
const { TreeNode } = Tree;
const { Search } = Input;
const { TextArea } = Input;

interface ITermsProps {
  genre?: ITermType;
  cm_artist?: ITermType;
  cm_author?: ITermType;
  cm_status?: ITermType;
  cm_country?: ITermType;
}

type IProps = ITermsProps & ReturnType<typeof mapStateToProps> & ReturnType <typeof mapDispatchToProps>;

interface IState extends ICominovelData {
}

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

class BasicInfo extends Component<IProps, IState> {
  constructor(props: IProps) {
    super(props);
    this.state = props.info;
  }

  public UNSAFE_componentWillReceiveProps(nextProps: IProps) {
    if (this.props.info !== nextProps.info) {
      this.setState(nextProps.info);
    }
  }

  public componentDidMount() {
    this.props.fetchTaxonomyTerms("genre", null, true);
    this.props.fetchTaxonomyTerms("cm_artist");
    this.props.fetchTaxonomyTerms("cm_author");
    this.props.fetchTaxonomyTerms("cm_status");
    this.props.fetchTaxonomyTerms("cm_country");
  }

  public updateSelectedTaxonomyTerms = (e: any) => {
    console.log(e);
  }

  public renderItemKey(index: number, prefix: string = "item") {
    return `${prefix}-${index}`;
  }

  public renderCominovelCountries() {
    if (typeof this.props.cm_country === "object") {
      return this.props.cm_country.map((country: ITermType, index: number) => {
        return (
          <Option key={this.renderItemKey(index)} value={country.id.toString()}>{country.name}</Option>
        );
      });
    }
    return null;
  }

  public renderCominovelStatus() {
    if (typeof this.props.cm_status === "object") {
      return this.props.cm_status.map((status: ITermType, index: number) => {
        return (
          <Option key={this.renderItemKey(index)} value={status.id.toString()}>{status.name}</Option>
        );
      });
    }
    return null;
  }

  public renderCominovelAuthors() {
    if (typeof this.props.cm_author === "object") {
      return this.props.cm_author.map((author: ITermType, index: number) => {
        return (
          <Option key={this.renderItemKey(index)} value={author.id.toString()}>{author.name}</Option>
        );
      });
    }
    return null;
  }

  public renderCominovelArtists() {
    if (typeof this.props.cm_artist === "object") {
      return this.props.cm_artist.map((artist: ITermType, index: number) => {
        return (
          <AutoComplete.Option key={artist.id.toString()}>{artist.name}</AutoComplete.Option>
        );
      });
    }
    return null;
  }

  public renderCominovelGenres() {
    if (typeof this.props.genre === "object") {
      return this.props.genre.map((genre: ITermType, index: number) => {
        return (
          <Option key={genre.id.toString()}>{genre.name}</Option>
        );
      });
    }
    return null;
  }

  public render() {
    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Basic Info" subTitle="Đây là các thông tin cơ bản của truyện" />
        <Form
          {...formItemLayout}
          labelAlign="left"
        >
          <Input name="cominovel_loaded" hidden value="true" />
          <Item
          label="Alternatve Name"
          >
            <Input
              name="alternative_name"
              onChange={(e) => this.setState({alternative_name: e.target.value})}
              value={this.state.alternative_name}
            />
          </Item>

          <Item
            label="Comic Type"
          >
            <Select
              placeholder="Country or comic types"
              style={{ width: 200 }}
              onChange={this.updateSelectedTaxonomyTerms}
            >
              {this.renderCominovelCountries()}
            </Select>
          </Item>
          <Item
            label="Status"
          >
            <Select
              placeholder="The status of the comic"
              style={{ width: 200 }}
            >
              {this.renderCominovelStatus()}
            </Select>
          </Item>

          <Item
            label="Publish Date"
          >
            <DatePicker
              placeholder="Select publish date"
              style={{width: 200}}
            />
          </Item>

          <Item
            label="Authors"
          >
            <Select
              placeholder="Choose or add author"
              style={{ width: "100%" }}
            >
              {this.renderCominovelAuthors()}
            </Select>
          </Item>

          <Item label="Artists">
          <AutoComplete style={{ width: "100%" }} placeholder="Tiểu Tôn Tuyết Đăng">
            {this.renderCominovelArtists()}
          </AutoComplete>
          </Item>

          <Item
            label="Genres"
          >
            <Select
              showSearch
              placeholder="The genre of comic"
              style={{ width: 200 }}
            >
            {this.renderCominovelGenres()}
            </Select>
          </Item>

          <Item
            label="Short Description"
          >
            <TextArea
              name="post_excerpt"
              onChange={(e) => this.setState({post_excerpt: e.target.value})}
              rows={4}
              value={this.state.post_excerpt}
            />
          </Item>
        </Form>
      </div>
    );
  }
}

const mapStateToProps = (state: IRootState) => {
  return {
    ...state.terms,
    info: state.cominovel.info,
  };
};

const mapDispatchToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchTaxonomyTerms,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(BasicInfo);
