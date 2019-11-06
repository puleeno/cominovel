import { Button,  Icon, PageHeader } from "antd";
import React, { Component } from "react";
import { connect } from "react-redux";
import { AnyAction, bindActionCreators, Dispatch } from "redux";
import { fetchSeasons } from "../actions";
import Form from "../antd/Form";
import { IRootState } from "../reducers";

type IProps = ReturnType<typeof mapStateToProps> & ReturnType<typeof mapDispacthToProps>;

const formItemLayout = {
  labelCol: {
    xs: { span: 24 },
    sm: { span: 5 },
  },
  wrapperCol: {
    xs: { span: 24 },
    sm: { span: 12 },
  },
};

class Seasons extends Component<IProps> {
  public componentDidMount() {
    this.props.fetchSeasons(window.Cominovel.currentID);
  }
  public add() {
  }

  public saveSeason(e: any) {
    // console.log(e.);
  }

  public renderSeasons() {
  }

  public render() {
    return (
      <div className="cominovel-tab-content">
        <PageHeader title="Seasons" subTitle="Biên soạn season cho truyện" />
        <Form
          {...formItemLayout}
          labelAlign="left"
        >
          {this.renderSeasons()}
          <Form.Item>
            <Button type="dashed" onClick={this.add} style={{ width: "60%" }}>
              <Icon type="plus" /> Add New Season
            </Button>
          </Form.Item>
          <Form.Item>
            <Button size="large" type="primary" htmlType="submit" onClick={this.saveSeason}>
              Save
            </Button>
          </Form.Item>
        </Form>
      </div>
    );
  }
}

const mapStateToProps = (state: IRootState) => ({
  seasons: state.seasons,
});

const mapDispacthToProps = (dispatch: Dispatch<AnyAction>) => bindActionCreators({
  fetchSeasons,
}, dispatch);

export default connect(mapStateToProps, mapDispacthToProps)(Seasons);
