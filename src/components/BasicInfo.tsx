import { Input, PageHeader } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchTaxonomyTerms } from "../actions";
import { ICominovelData } from "../interfaces/CominovelProps";
import { IRootState } from "../reducers";
import Form from "./antd/Form";
import { Artists, Authors, Countries, Genres, Release } from "./nested";

const { Item } = Form;
const { TextArea } = Input;


type IProps = ReturnType<typeof mapStateToProps> & ReturnType <typeof mapDispatchToProps>;

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
    this.props.fetchTaxonomyTerms("cm_author");
    this.props.fetchTaxonomyTerms("cm_status");
    this.props.fetchTaxonomyTerms("cm_country");
  }

  public renderItemKey(index: number, prefix: string = "item") {
    return `${prefix}-${index}`;
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

          <Countries />
          <Release />
          <Authors />
          <Artists />
          <Genres />

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
